<?php
/**
 * @package boiler
 */
	$postType = esc_html(get_post_type());

    $videoLink = get_field('video_link');

    if ($postType == "videos") {

	    if (strpos($videoLink, "embed") !== false) {
		    $str = explode("embed/", $videoLink);
		    $embedCode = preg_replace('/\s+/', '', $str[1]);
	    } elseif (strpos($videoLink, "v=") !== false) {
		    $str = explode("v=", $videoLink);
		    $embedCode = preg_replace('/\s+/', '', $str[1]);
	    } elseif (strpos($videoLink, "youtu.be") !== false) {
		    $str = explode(".be/", $videoLink);
		    $embedCode = preg_replace('/\s+/', '', $str[1]);
	    } else {
		    $embedCode = null;
	    }

    }

?>


<div class="row full_width">

    <div class="column">

	    <?php if ($postType == "videos") : ?>

	        <?php if ($embedCode !== null) : ?>
	            <a href="<?php the_permalink(); ?>">
	                <img class="youtube_img" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
	            </a>
	        <?php else:  ?>
	            <a href="<?php the_permalink(); ?>">
	                <img class="default" src="<?php echo bloginfo('template_url'); ?>/images/no-video-placeholder.jpg" />
	            </a>
	        <?php endif; ?>

	    <?php else :

		        if (get_field('og_image')) {
				    $attachment_id = get_field('og_image');
				    $size = "large";
				    $ogImage = wp_get_attachment_image_src( $attachment_id, $size );
		    ?>
				    <a href="<?php the_permalink(); ?>">
					    <img class="og_img" src="<?php echo $ogImage[0];?>" />
				    </a>
		        <?php } else { ?>
				        <a href="<?php the_permalink(); ?>">
			                <img class="default" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
			            </a>
		        <?php } ?>

	    <?php endif; ?>


    </div>
    <div class="column">
        <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	    <?php if ($postType == "videos") : ?>

	        <?php $author = get_the_author_meta('user_login'); ?>
	        <h4>Submitted by <a href="/membership-account/member-profile/?pu=<?php echo $author; ?>"><?php echo $author; ?></a></h4>

	    <?php else : ?>

	        <h4 class="sub_title"><?php the_field('sub_title'); ?></h4>

	    <?php endif; ?>


	    <?php
            $post_id = get_the_ID();
            $commentCount = wp_count_comments( $post_id );
	    if($postType != "courses") :
            ?>
	        <h4><?php  if ($postType == "videos") { echo "Thread Replies: "; } else { echo  "Episode Inquiries: "; } ?>

		                <?php echo $commentCount->total_comments; ?>
	        </h4>

	        <p><?php the_field('description'); ?></p>
	    <?php endif; ?>
	    <div class="button_wrap">
            <a class="button red" href="<?php the_permalink(); ?>"><?php if ($postType == "videos") { echo "Open Thread"; } elseif ($postType == "courses"){ echo "Open Course"; } else {  the_field('button_text'); } ?></a>
        </div>
    </div>


</div>
<!--
<?php /*if ( is_search() ) : // Only display Excerpts for Search */?>

    <?php /*the_excerpt(); */?>

<?php /*else : */?>
    <div>
        <?php /*the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boiler' ) ); */?>
        <?php
/*        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'boiler' ),
            'after'  => '</div>',
        ) );
        */?>
    </div>
--><?php /*endif; */?>


<!--<footer>-->
    <?php //if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
        <?php
        /* translators: used between list items, there is a space after the comma */
       /* $categories_list = get_the_category_list( __( ', ', 'boiler' ) );
        if ( $categories_list && boiler_categorized_blog() ) :
            ?>
            <span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'boiler' ), $categories_list ); ?>
			</span>
        <?php endif; // End if categories ?>

        <?php
      */
        /* translators: used between list items, there is a space after the comma */
     /*   $tags_list = get_the_tag_list( '', __( ', ', 'boiler' ) );
        if ( $tags_list ) :
            ?>
            <span class="sep"> | </span>
            <span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'boiler' ), $tags_list ); ?>
			</span>
        <?php endif; // End if $tags_list ?>
    <?php endif; // End if 'post' == get_post_type() ?>

    <?php /*if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : */?><!--
        <span class="sep"> | </span>
        <span class="comments-link"><?php /*comments_popup_link( __( 'Leave a comment', 'boiler' ), __( '1 Comment', 'boiler' ), __( '% Comments', 'boiler' ) ); */?></span>
    --><?php /*endif; */?>

    <?php //edit_post_link( __( 'Edit', 'boiler' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>

<!-- </footer> -->
