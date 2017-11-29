<?php
/**
 * @package boiler
 */
?>

	<header>
		<h2><?php the_title(); ?></h2>
<!--
		<div class="entry-meta">
			<?php boiler_posted_on(); ?>
		</div>
-->
	</header>

		<?php //the_content(); ?>

        <div class="social_buttons full_width">
            <a class="instagram" target="_blank" href="https://www.instagram.com/daric_bennett"><span>Follow On Instagram</span></a>
            <a class="facebook" target="_blank" href="https://www.facebook.com/daricbennettlessons"><span>Like On Facebook</span></a>
            <a class="youtube" target="_blank" href="https://www.youtube.com/c/DaricBennett"><span>Subscribe on You Tube</span></a>
        </div>
		
		<section class="videos full_width">
			
			<?php
				
				if (get_field('free_lesson_link')) : ?>
				
					<div class="video_wrapper full_width">
						<iframe src="<?php echo the_field('free_lesson_link'); ?>?rel=0&showinfo=0"></iframe>
					</div>

                    <?php if (get_field('lesson_description')) : ?>

                        <div class="quote_section full_width">
                            <img src="<?php echo bloginfo('template_url'); ?>/images/icon-quote-left.png" />
                            <p><?php echo the_field('lesson_description'); ?></p>
                        </div>

                    <?php endif; ?>


                    <?php
				/*		$str = get_field('free_lesson_link');
					if (strpos($str, "youtube") !== false) {
						$str = explode("embed/", $str);
						$embedCode = preg_replace('/\s+/', '',$str[1]);
						$type = "youtube";
					} else {
						$str = explode("video/", $str);
						$embedCode = preg_replace('/\s+/', '',$str[1]);
						$type = "vimeo";
					}
				?>
					
					<div class="video_wrapper <?php if ($type == 'youtube') { echo "youtube_video";} else {echo "vimeo_video"; }?> full_width" data-embed="<?php echo $embedCode;?>">
					
					<?php if ($type == 'youtube') : ?>
						<img class="youtube_image" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
					<?php else : ?>
						<?php if( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
								echo "<img src='" . $video_thumbnail . "' />"; 
							  } else { ?>
							  	<img class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
							  <?php } ?>
					<?php endif; ?>
					
				</div>
				*/
				
				elseif (pmpro_hasMembershipLevel() && is_user_logged_in()) : ?>
					
					<div class="video_wrapper full_width">
						<iframe src="<?php echo the_field('member_lesson_link'); ?>?rel=0&showinfo=0"></iframe>
					</div>
					
					<div class="quote_section full_width">
						<img src="<?php echo bloginfo('template_url'); ?>/images/icon-quote-left.png" />
						<p><?php echo the_field('lesson_description'); ?></p>
					</div>
		  <?php else :
			  
					get_template_part( 'content', 'not-member' );
			
				endif; ?>
													

		</section>
		
		
		
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