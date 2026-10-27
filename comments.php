<?php
function mytheme_comment( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }

    $classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
    ?>

    <<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">

    <div class="comment-author vcard bio">
        <?php
        if ( $args['avatar_size'] != 0 ) {
            echo get_avatar( $comment, $args['avatar_size'] );
        }
        ?>
    </div>

    <div class="comment-body">
			<?php echo '<h3>' . get_comment_author() . '</h3>'; ?>

        <?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation">
                <?php _e( 'Your comment is awaiting moderation.' ); ?>
            </em><br/>
        <?php } ?>
    
        <div class="meta">
					<?php
          	printf(
          	    __( '%1$s at %2$s' ),
          	    get_comment_date('F jS, Y'),
          	    get_comment_time()
          	); ?>
        </div>
    
        <?php comment_text(); ?>

        <div class="reply">
            <?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); ?>
        </div>
        
    </div>

    <?php
}
?>

<h3 class="mb-5">
    <?php 
    	$count = get_comments_number();
    	echo $count . ' ' . ($count == 1 ? 'Comment' : 'Comments'); 
    ?>
</h3>

<ul class="comment-list">
	  <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
</ul>
