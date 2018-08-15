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

	<div class="lessons_page courses full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">

		<header class="sub_header full_width">
			<div class="container">
				<h1><?php the_title(); ?></h1>
			</div><!-- .container -->
		</header>

		<?php if (pmpro_hasMembershipLevel()) : ?>

			<div class="full_width">

				<div class="video_list full_width">

					<?php while ( have_posts() ) : the_post();

						get_template_part( 'content-courses', get_post_format() );

						//boiler_content_nav( 'nav-below' );

					endwhile; // End of the loop.

					wp_reset_query();
					?>

				</div><!-- video_list -->


			</div><!-- full_width -->

		<?php else :

			get_template_part( 'content', 'not-member' );  ?>

		<?php endif; ?>

	</div><!-- lessons_page -->

<?php get_footer();