<!-- wp:social-links --><ul class="wp-block-social-links"><!-- wp:social-link {"url":"https://gravatar.com/milabalashova2312","service":"gravatar","rel":"me"} /--></ul><!-- /wp:social-links -->

<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>

  <!-- END templateux-navbar -->
  <section class="templateux-hero" data-scrollax-parent="true">
    <div class="container">
      <div class="row align-items-center justify-content-center intro">
        <div class="col-md-12" data-aos="fade-up">
          <div class="post-meta">
            <span>Posted in 
              <?php 
              $original_locale = get_locale();
              switch_to_locale('en_US');
              echo get_the_date('F j, Y');
              switch_to_locale($original_locale);
              ?>
            </span>
            <span class="sep">&bullet;</span>
            <span>Posted by 
              <?php 
                $post_object = get_post(get_the_ID());
                if ($post_object) {
                    $author_id = $post_object->post_author;
                    echo get_the_author_meta('display_name', $author_id);
                }
                ?>
            </span>
          </div>
          <h1><?php the_title(); ?></h1>
          <a href="#next" class="go-down js-smoothscroll"></a>
        </div>
      </div>
    </div>
  </section>
  <!-- END templateux-hero -->


  <section class="templateux-portfolio-overlap mb-5" id="next">
    <div id="blog" class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8">

            <?php the_content(); ?>

            <div class="pt-5 mt-5">

              <?php comments_template( '/comments.php' ); ?>
              
              <div class="comment-form-wrap pt-5">
                <?php comment_form(); ?>
              </div>
            </div>

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar pl-md-5">
            <div class="sidebar-box">
              <?php
              global $post;
              $url = get_avatar_url( $post, "size=317&default=monsterid");
              $img = '<img class="img-fluid mb-4 rounded" alt="" src="'. $url .'">';
              echo $img;             
              ?>
              <h3>About The Author</h3>
              <p>
                <?php
                $post_object = get_post(get_the_ID());
                if ($post_object) {
                    $author_id = $post_object->post_author;
                    echo get_the_author_meta('description', $author_id);
                }
                ?>
              </p>
            </div>

            <div class="sidebar-box">
              <h3>Tags</h3>
              <div class="tagcloud">
                <?php 
                $post_tags = get_the_tags();
                if ($post_tags) {
                  foreach ($post_tags as $tag) {
                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-cloud-link">' . $tag->name . '</a>';
                  }
                } else {
                  echo '<p>Тегов нет</p>';
                }
                ?>
              </div>
            </div>

            <?php if (has_excerpt()) : ?>
              <div class="sidebar-box">
                <h3>Paragraph</h3>
                <p><?php the_excerpt(); ?></p>
              </div>
            <?php endif; ?>
      </div>
    </div>
  </section>
    
<?php endwhile;
  else :
  echo '<p>Пост не найден.</p>';
  endif;
?>

<?php get_footer(); ?>
