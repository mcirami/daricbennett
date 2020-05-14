<div class="video full_width">

	<div class="column">

		<?php
				if (pmpro_hasMembershipLevel()) {
					$videoLink = get_field('video_link');
				} else {
					$videoLink = get_field('free_video_link');
				}

			?>

		<?php if ($videoLink != "") : ?>

			<div class="video_wrapper">
				<iframe src="<?php echo $videoLink; ?>?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=0&scroll_type=2&narrow_video_height=48p&enable_waveform=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
			</div>

		<?php else : ?>

				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-video-placeholder.jpg"/>

		<?php endif; ?>

	</div>
	<div class="column">
		<h3><?php the_title(); ?></h3>
		<h4 class="sub_title"><?php the_field('sub_title'); ?></h4>
		<p><?php the_field('description'); ?></p>
		<?php $file = get_field('audio_file'); ?>

		<?php if (!pmpro_hasMembershipLevel()) : ?>

			<?php if ($file) : ?>
					<h5>Podcast</h5>
					<a class="button red members_only_video_pop" href="#members_only_video_pop">Listen To Podcast</a>
			<?php endif; ?>

		<?php else :?>

			<h5>Listen To Podcast</h5>
			<?php if ($file) :
					$url = wp_get_attachment_url( $file );
				?>
				<audio controls>
					<source src="<?php echo $url; ?>" type="audio/mpeg">
					Your browser does not support the audio element.
				</audio>
			<?php endif; ?>


		<?php endif; ?>

	</div>

</div>