<?php
/**
 * Archive Portfolio
 * Этот файл перенаправляет на страницу Portfolio
 */

// Получаем ID страницы Portfolio
$portfolio_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-portfolio.php',
    'number' => 1
));

if (!empty($portfolio_page)) {
    $page_id = $portfolio_page[0]->ID;
    $page_url = get_permalink($page_id);
    
    // Перенаправляем
    header('Location: ' . $page_url);
    exit;
} else {
    // Если страница не найдена, показываем 404
    status_header(404);
    get_template_part('404');
}