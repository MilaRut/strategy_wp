<?php 
// Template Name: Contacts
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


<section class="templateux-portfolio-overlap mb-5" data-aos="fade-up" id="next">
  <div class="container">
    <!-- <div class="row"> -->
      <form class="contact-form" action="<?php echo admin_url('admin-ajax.php?action=callback_mail') ?>" method="post">
        <div class="row">
          <div class="col-md-4  mb-4">
            <input type="text" name="name" class="form-control" placeholder="Name" required>
          </div>
          <div class="col-md-4  mb-4">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="col-md-4  mb-4">
            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4  mb-4">
            <input type="text" name="time_zone" class="form-control" placeholder="Time Zone">
          </div>
          <div class="col-md-4  mb-4">
            <input type="text" name="budget" class="form-control" placeholder="Budget">
          </div>
          <div class="col-md-4  mb-4">
            <input type="text" name="type_of_work" class="form-control" placeholder="Type of Work">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12  mb-4">
            <textarea name="comment" class="form-control" id="" cols="30" rows="10" placeholder="Write your message"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4  mb-4">
            <input type="submit" class="button button--red" value="Send your message">
          </div>
        </div>
      </form>
    <!-- </div> -->
  </div>
</section>

<section id="map">
  <?php echo do_shortcode('[wpgmza id="1"]'); ?>
</section>

<?php get_footer(); ?>
