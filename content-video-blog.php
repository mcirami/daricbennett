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

		        if ($image = get_field('course_image')) {
		    ?>
				    <a href="<?php the_permalink(); ?>">
					    <!--<img class="og_img" src="<?php /*echo $ogImage[0];*/?>" />-->
                        <img src="<?php echo $image['url']; ?>" alt="">
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