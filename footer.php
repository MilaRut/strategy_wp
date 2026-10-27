    <footer class="templateux-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 text-md-left text-center">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
          </div>
          <div class="col-md-6 text-md-right text-center footer-social">
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
                'post_type'   => 'social',
                'suppress_filters' => true,
              ) );

              global $post;

              foreach( $my_posts as $post ){
                setup_postdata( $post );
              
            ?>

              <a href="<?php echo get_post_meta(get_the_ID(), 'link', true); ?>" target="_blank" class="p-3">
                <span class="icon-<?php echo the_title() ?>"></span>
              </a>

            <?php
              }

              wp_reset_postdata();      
            ?>
          </div>
        </div>
      </div>
    </footer>

  </div>
  
  <?php wp_footer(); ?>

  </body>
</html>