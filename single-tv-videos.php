<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<section class="single_video page_content full_width<?php if (is_user_logged_in()){ echo " member";} ?>">

		<?php if (!pmpro_hasMembershipLevel()) : ?>
			<header class="sub_header full_width">
				<div class="container">
					<h1>FREE BASS NATION TV SEGMENT</h1>
				</div><!-- .container -->
			</header>
		<?php endif; ?>

		<div class="container">

			<div class="wrap full_width">
				<div id="primary" class="content-area full_width">
					<main id="main" class="site-main full_width" role="main">

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); ?>

							<?php if (pmpro_hasMembershipLevel()) : ?>

								<a class="back_link" href="/bass-nation-tv">back to submissions</a>

							<?php endif; ?>

							<?php
							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text button black">' . __( 'Previous Submission', 'boiler' ) . '</span>',
								'next_text' => '<span class="screen-reader-text button black">' . __( 'Next Submission', 'boiler' ) . '</span>'
							) );

							get_template_part( 'content', 'single-tv-video' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
				<?php //get_sidebar(); ?>
			</div><!-- .wrap -->

		</div>
	</section>
	<div id="members_only_video_pop">
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="Daric Bennett Logo"/>
		<h2>You must be a member to listen<br> to the full version of the podcast audio</h2>
		<div class="button_wrap">
			<a class="button red" href="<?php echo home_url(); ?>/membership-account/membership-levels/">Start My Free Trial For Full Access!</a>
		</div>
	</div>
<?php get_footer();
