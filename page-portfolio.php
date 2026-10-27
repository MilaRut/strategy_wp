<?php 
// Template Name: Portfolio
?>

<?php get_header(); ?>

<!-- END templateux-navbar -->
<section class="templateux-hero"  data-scrollax-parent="true">

  <div class="container">
    <div class="row align-items-center justify-content-center intro">
      <div class="col-md-10" data-aos="fade-up">
        <h1><?php echo get_the_title(); ?></h1>
        <p class="lead"><?php echo get_post_meta(get_the_ID(), 'descr', true); ?></p>
        <a href="#next" class="go-down js-smoothscroll"></a>
      </div>
    </div>
  </div>
</section>
<!-- END templateux-hero -->


<section class="templateux-portfolio-overlap mb-5" id="next">
  <div class="container-fluid">
    <div class="row">

      <?php 
        $my_posts = get_posts( array(
          'numberposts' => -1,
          'category'    => 0,
          'orderby'     => 'date',
          'order'       => 'ASC',
          'include'     => array(),
          'exclude'     => array(),
          'meta_key'    => '',
          'meta_value'  =>'',
          'post_type'   => 'portfolio',
          'suppress_filters' => true,
        ) );

        global $post;

        foreach( $my_posts as $post ){
          setup_postdata( $post );
        
      ?>

      <article class="proj-article" data-aos="fade-up">
        <a class="project animsition-link" href="<?php echo get_permalink(); ?>">
          <figure>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Free Template" class="img-fluid">
          </figure>
          <div class="project-hover">
            <div class="project-hover-inner">
              <h2><?php the_title(); ?></h2>
              <span>View Case Study</span>
            </div>
          </div>
        </a>
      </article>

      <?php
        }

        wp_reset_postdata();      
      ?>

    </div>
  </div>
</section>

<a class="templateux-section templateux-cta animsition-link mt-5" href="/contact" data-aos="fade-up">
  <div class="container-fluid">
    <div class="cta-inner">
      <h2><span class="words-1">Start a Project.</span> <span class="words-2">Let's chat we are good people.</span></h2>
    </div>
  </div>
</a>
<!-- END call to action -->

<?php get_footer(); ?>
