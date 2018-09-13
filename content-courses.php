<?php
/**
 * @package boiler
 */

$posts = get_field('lesson_links');
$id = get_the_ID();

if ($posts) : ?>

	<?php foreach($posts as $post) : ?>

		<?php setup_postdata($post); ?>

		<?php

		$type = null;
		$videoLink = get_field('member_lesson_link');

		if (strpos($videoLink, "youtube") !== false) {
			$str = explode("embed/", $videoLink);
			$embedCode = preg_replace('/\s+/', '',$str[1]);
			$type = "youtube";
		} elseif (strpos($videoLink, "vimeo") !== false) {
			$str = explode("video/", $videoLink);
			$embedCode = preg_replace('/\s+/', '',$str[1]);
			$type = "vimeo";
		} elseif (strpos($videoLink, "soundslice") !== false) {

			$displayKeyboard = get_field('display_keyboard_video');
			$notation = get_field('has_notation');

			if($notation) {
				$controls = '1';
				$display = 'yes';
			} else {
				$controls = '0';
				$display = 'no';
			}

			$str = explode("scores/", $videoLink);
			$str = explode("/embed", $str[1]);
			$embedCode = $videoLink . "?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0";

			if (get_field('display_keyboard_video')) {
				$embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
			}

			$type = "soundslice";
		}

		$hash = $post->post_name;
		?>

	<div class="row full_width">
		<div class="full_width columns_wrap">
			<div class="container">
				<div class="column">

					<?php if ($type == "soundslice" && get_field('display_keyboard_video')) : ?>

						<input class="keyboard_embed" hidden data-embed="<?php echo $embedKeyboard;?>">

					<?php endif; ?>

					<div class="vid_image_wrap">


						<?php
						$attachment_id = get_field('og_image');
						$size = "video-thumb";
						$ogImage = wp_get_attachment_image_src( $attachment_id, $size );

						/*if (!is_wp_error(video_thumbnail())) {
							$video_thumbnail = get_video_thumbnail();
						}*/

						if (!empty(get_the_post_thumbnail())) {
							$postThumbnail = get_the_post_thumbnail();
						}


						if (!empty($ogImage)) :
							?>
							<img class="og_image" src="<?php echo $ogImage[0]; ?>" alt="">

							<?php  //elseif ( !empty($video_thumbnail) ) : ?>

							<!--<img class="get_video_thumbnail" src="<?php /*echo $video_thumbnail; */?>" alt="">-->

						<?php elseif (!empty($postThumbnail)) :

							echo $postThumbnail;

						else : ?>

						<?php if ($type == 'youtube') { ?>

							<img src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />

						<?php } else { ?>

							<img src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />

						<?php } ?>


						<?php endif; ?><!-- video thumbnail -->

					</div><!-- vid_image_wrap -->
				</div><!-- column -->

				<div class="column">
                    <?php
                    $addFile = get_field('add_file');

                    if (have_rows('files')) : ?>

                        <?php while (have_rows('files')) : the_row();?>

                            <a class="video_files" href="#" data-file="<?php the_sub_field('file'); ?>" data-text="<?php the_sub_field('file_text'); ?>"></a>

                        <?php endwhile; ?>

                    <?php endif; ?>
					<div class="lesson_content full_width">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="button_wrap full_width">
						<?php the_favorites_button();?>
					</div>
					<div class="button_wrap">
						<?php if ($type == 'youtube') : ?>

						<a id="<?php echo $hash; ?>" class="play_video button red" data-type="<?php echo "youtube";?>" data-src="<?php echo $videoLink; ?>/?rel=0&showinfo=0&autoplay=1" data-title="<?php echo the_title();?>" data-postid="<?php echo $id; ?>" href="#<?php echo $hash;?>">

							<?php elseif ($type == 'vimeo') : ?>

							<a id="<?php echo $hash; ?>" class="play_video button red" data-type="<?php echo "vimeo";?>" data-src="<?php echo $videoLink; ?>/?autoplay=1" data-title="<?php echo the_title();?>" data-postid="<?php echo $id; ?>" href="#<?php echo $hash;?>">

								<?php elseif ($type == 'soundslice') : ?>

								<a id="<?php echo $hash; ?>" class="play_video button red"
								   data-replace="<?php the_field('vimeo_link'); ?>"
								   data-type="<?php echo "soundslice_video";?>"
								   data-src="<?php echo $embedCode; ?>"
								   data-title="<?php echo the_title();?>"
								   data-notation="<?php echo $display; ?>"
								   data-postid="<?php echo $id; ?>"
								   href="#<?php echo $hash;?>">

									<?php endif; ?><!-- type -->


									Watch Now</a>
					</div>
					<!--<div class="comment_wrap">
						<?php /*if ((is_single() || is_page()) && is_user_logged_in()) { comments_template(); }*/?>
					</div>-->

				</div><!-- column -->
			</div><!-- columns_wrap -->
		</div><!-- container -->

		<div class="full_width course_video_player" id="<?php echo $hash;?>-video">
			<div id="video_iframe_wrap"></div>
			<div id="video_content_wrap"></div>
		</div>

	</div><!-- row -->

		<?php endforeach; ?>

<?php endif; ?>

