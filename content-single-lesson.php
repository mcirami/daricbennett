<?php
/**
 * @package boiler
 */
?>
	<?php if (!is_user_logged_in()) { ?>
		<header>
			 <h2> <?php the_title(); ?></h2>
		</header>
	<?php } ?>

    <div class="social_buttons full_width">
        <a class="instagram" target="_blank" href="https://www.instagram.com/daric_bennett"><span class="icon"><span class="text">Follow On Instagram</span></span></a>
        <a class="facebook" target="_blank" href="https://www.facebook.com/daricbennettlessons"><span class="icon"><span class="text">Like On Facebook</span></span></a>
        <a class="youtube" target="_blank" href="https://www.youtube.com/c/DaricBennett"><span class="icon"><span class="text">Subscribe on You Tube</span></span></a>
    </div>
		
		<div class="videos full_width">
            <?php if(pmpro_hasMembershipLevel()) { echo do_shortcode('[favorite_button]'); }?>
			
			<?php
				
				if (!pmpro_hasMembershipLevel() && get_field('free_lesson_link')) : ?>

                    <?php
                        $type = null;
                        $str = get_field('free_lesson_link');

                        if (strpos($str, "youtube") !== false) {
                            $str = explode("embed/", $str);
                            $embedCode = preg_replace('/\s+/', '',$str[1]);
                            $type = "youtube";
                        } elseif (strpos($str, "vimeo") !== false) {
                            $str = explode("video/", $str);
                            $embedCode = preg_replace('/\s+/', '', $str[1]);
                            $type = "vimeo";
                        }

                        $videoOnly = get_field('no_video');
                    ?>

					<div class="video_wrapper full_width">

                        <?php if ($videoOnly) : ?>

                            <a class="members_only_video_pop" href="#members_only_video_pop">
                                <?php
                                $attachment_id = get_field('og_image');
                                $size = "video-thumb";
                                $ogImage = wp_get_attachment_image_src( $attachment_id, $size );
                                //$video_thumbnail = get_video_thumbnail();

                                if (!empty($ogImage)) : ?>

                                    <img class="og_image" src="<?php echo $ogImage[0]; ?>" alt="">

                                <?php //elseif ( !is_wp_error($video_thumbnail)) : ?>

                                   <!-- <img class="get_video_thumbnail" src="<?php /*echo $video_thumbnail; */?>" alt="">-->

                                <?php elseif ($video_thumbnail = get_the_post_thumbnail() != null ) :

                                    echo $video_thumbnail;

                                else : ?>

                                <?php if ($type == 'youtube') { ?>

                                    <img class="youtube_img" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />

                                <?php } else { ?>

                                    <img class="screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/lessons-screenshot.jpg" />

                                <?php } ?>

                                <?php endif; ?><!-- video thumbnail -->

                                <div class="button_wrap full_width">
                                    <img class="play_button" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/play-button.png" />
                                </div>
                            </a>
                        <?php else : ?>
						    <iframe src="<?php echo the_field('free_lesson_link'); ?>?rel=0&showinfo=0"></iframe>
                        <?php endif; ?>

					</div><!-- video_wrapper -->

                    <?php if (get_field('lesson_description')) : ?>

                        <div class="quote_section full_width">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon-quote-left.png" />
	                        <?php
	                            $postId = get_the_ID();
	                            if ($postId == 3699) : ?>
	                                <p>#BASSNATION check out this metronome on steriods!! It's an awesome practice tool that will really help get you grooving and improving. Check out all the details of the
		                                <a target="_blank" href="http://bit.ly/beatbuddypedal">BeatBuddy Right Here Right Now</a>!</p>
	                                <br>
			                        <br>
			                        <p>For full access to all my exclusive lessons, start your free trial today!</p>

                            <?php else :
	                                echo apply_filters( 'acf_the_content', the_field('lesson_description') );

                                    endif; ?>

                        </div>

                    <?php endif;
				
				elseif (pmpro_hasMembershipLevel() && is_user_logged_in()) : ?>
					
					<div class="video_wrapper full_width">
						<iframe src="<?php echo the_field('member_lesson_link');?>?rel=0&showinfo=0"></iframe>
					</div>
                    <?php if (get_field('lesson_description')) : ?>
                        <div class="quote_section full_width">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon-quote-left.png" />
                            <p><?php echo the_field('lesson_description'); ?></p>
                        </div>
                    <?php endif; ?>

                <?php else :
			  
					get_template_part( 'content', 'not-member' );
			
		  endif; ?>
													

		</div>
		
		
		
		<?php
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'boiler' ),
				'after'  => '</div>',
			) );
		?>
<!--
	<footer>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'boiler' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'boiler' ) );

			if ( ! boiler_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'boiler' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'boiler' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'boiler' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'boiler' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'boiler' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
-->