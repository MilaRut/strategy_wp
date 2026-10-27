<?php

# Отключение панели администратора
show_admin_bar(false);

# Удалeние лишних тегов из шапки
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

function mywptheme_child_deregister_styles() {
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20 );

function wps_deregister_styles() {
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

# Подключение стилей и скриптов
function strategy_theme_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', [], '');
	wp_enqueue_style('aos', get_template_directory_uri() . '/assets/css/aos.min.css', [], '');
	wp_enqueue_style('hamburgers', get_template_directory_uri() . '/assets/css/hamburgers/hamburgers.min.css', [], '');
	wp_enqueue_style('owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', [], '');
	wp_enqueue_style('icomoon', get_template_directory_uri() . '/assets/fonts/icomoon/style.css', [], '');
	wp_enqueue_style('animsition', get_template_directory_uri() . '/assets/css/animsition.min.css', [], '');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css', [], '');

	wp_enqueue_script('scripts-all', get_template_directory_uri() . '/assets/js/scripts-all.js', [], '', false);
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], '', true);

 	wp_localize_script('main', 'WPJS', array(
			'siteUrl' => get_template_directory_uri(),
	));
}

add_action('wp_enqueue_scripts', 'strategy_theme_scripts');

add_theme_support( 'post-thumbnails');

add_theme_support( 'post-thumbnails', array(  'portfolio' ));

add_theme_support( 'menus' );

class Custom_Nav_Walker extends Walker_Nav_Menu {
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		// Проверяем, является ли текущий пункт меню активным
		$is_active = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes);
		
		// Добавляем класс active для текущей страницы
		if ($is_active) {
				$classes[] = 'active';
		}
		
		// Формируем классы для li
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		// Добавляем d-md-none d-block для первого элемента меню
		static $first_item = true;
		if ($first_item) {
				$class_names = ' class="d-md-none d-block' . ($is_active ? ' active' : '') . '"';
				$first_item = false;
		}
		
		$output .= '<li' . $class_names . '>';
		
		// Атрибуты ссылки
		$attributes = '';
		$attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		
		// Добавляем класс animsition-link ко всем ссылкам
		$attributes .= ' class="animsition-link"';
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

// ============================================================
// ПОРТФОЛИО
// ============================================================

// Регистрация типа записей
add_action('init', 'check_portfolio_post_type');
function check_portfolio_post_type() {
    if (!post_type_exists('portfolio')) {
        register_post_type('portfolio', array(
            'labels' => array(
                'name' => 'Портфолио',
                'singular_name' => 'Кейс'
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'portfolio'),
            'supports' => array('title', 'editor', 'thumbnail')
        ));
    }
}

// Шаблон для отдельного кейса
add_action('template_include', 'custom_portfolio_template', 99);
function custom_portfolio_template($template) {
    if (is_singular('portfolio')) {
        $custom_template = get_template_directory() . '/single-portfolio.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

// Перенаправление с /portfolio/ на страницу Portfolio
add_action('template_redirect', 'redirect_portfolio_archive_to_page');
function redirect_portfolio_archive_to_page() {
    if (is_post_type_archive('portfolio')) {
        $page_id = 10; // ЗАМЕНИТЕ НА ВАШ ID
        $page_url = get_permalink($page_id);
        if ($page_url) {
            wp_redirect($page_url, 301);
            exit;
        }
    }
}

// ============================================================
// ФОРМА ОБРАТНОЙ СВЯЗИ
// ============================================================

add_action('wp_ajax_callback_mail', 'callback_mail');
add_action('wp_ajax_nopriv_callback_mail', 'callback_mail');
function callback_mail() {
	$name = $POST['name'];
	$email = $POST['email'];
	$phone = $POST['phone'];
	$time_zone = $POST['time_zone'];
	$budget = $POST['budget'];
	$type_of_work = $POST['type_of_work'];
	$comment = $POST['comment'];

	$to = 'arumi@inbox.ru';
	$subject = 'Сообщение с сайта Strategy';
	$message = "Имя: $name\nEmail: $email\nТелефон: $phone\nЧасовой пояс: $time_zone\nБюджет: $budget\nТип работы: $type_of_work\nКомментарий: $comment";
	
	remove_all_filters('wp_mail_from');
	remove_all_filters('wp_mail_from_name');

	$headers = array(
		'From: ' . $name . ' <' . $email . '>',
		'Content-Type: text/html; charset=UTF-8',
		'Cc: ' . $email
	);

	wp_mail($to, $subject, nl2br($message), $headers);
	wp_send_json_success(array('message' => 'Сообщение успешно отправлено!'));
	wp_die(); // Завершаем выполнение скрипта после отправки письма
}

?>