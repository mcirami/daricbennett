<?php
/**
 * Template Name: Live Stream
 *
 * The template for displaying free lessons page.
 *
 *
 * @package boiler
 */


get_header();

$domain = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);


?>

<div class="full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
	<header class="sub_header full_width">
		<div class="container">
			<h1><?php the_title();?></h1>
		</div><!-- .container -->
	</header>

	<div class="full_width live_stream">
		<div class="container">
			<div class="columns_wrap">
				<div class="column one">
					<div class="video_wrapper">
						<iframe src="<?php the_field('video_embed_link'); ?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="column two">
					<iframe src="<?php the_field('chat_embed_link'); ?>&embed_domain=<?php echo $domain; ?>" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>