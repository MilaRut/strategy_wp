<?php
/**
 * Шаблон для отдельного кейса портфолио
 */

get_header(); 
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

// Получаем данные из Pods
$pods = pods('portfolio', get_the_id());
$role = $pods ? $pods->field('role') : '';
$team = $pods ? $pods->field('team') : '';
$company = $pods ? $pods->field('company') : '';
$website_url = $pods ? $pods->field('website_url') : '';
$testimonial = $pods ? $pods->field('testimonial') : '';
$testimonial_name = $pods ? $pods->field('testimonial_name') : '';

?>

<section class="templateux-hero" data-scrollax-parent="true">
  <div class="container">
    <div class="row align-items-center justify-content-center intro">
      <div class="col-md-10" data-aos="fade-up">
        <h1><?php the_title(); ?></h1>
        <a href="#next" class="go-down js-smoothscroll"></a>               
      </div>
    </div>
  </div>
</section>

<section class="templateux-portfolio-overlap mb-5" id="next">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="row work-detail">
          <?php if (!empty($role)) : ?>
            <div class="col-md-4 ">
              <span class="caption">Role</span>
              <strong><?php echo esc_html($role); ?></strong>
            </div>
          <?php endif; ?> 
          <?php if (!empty($team)) : ?>
            <div class="col-md-4">
                <span class="caption">Team</span>
                <strong><?php echo esc_html($team); ?></strong>
            </div>
          <?php endif; ?> 
          <?php if (!empty($company)) : ?>
            <div class="col-md-4">
              <span class="caption">Company</span>
              <strong><?php echo esc_html($company); ?></strong>
            </div>
          <?php endif; ?> 
        </div>

        <div class="portfolio-case-wrapper">
          <?php the_content(); ?>        
        </div>

        <?php if (!empty($website_url)) : ?>
          <p class="text-center">
            <a href="<?php echo esc_url($website_url); ?>" class="button button--red" target="_blank">Visit Website</a>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($testimonial)) : ?>
<section class="testimony">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <blockquote class="mb-5">
          <p>&ldquo;<?php echo esc_html($testimonial); ?>&rdquo;</p>
        </blockquote>
        <p class="author">&mdash; 
          <span><?php echo !empty($testimonial_name) ? esc_html($testimonial_name) : ''; ?></span>
        </p>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php 
    endwhile; 
endif; 

get_footer(); 