<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php if (get_post_type() == "courses") : ?>

	<section class="video_submit page_content full_width<?php if (is_user_logged_in()){ echo " member";} ?>">
		<header class="sub_header full_width">
			<div class="container">
				<h2>Courses</h2>
			</div><!-- .container -->
		</header>

		<?php if (pmpro_hasMembershipLevel()) : ?>

			<div class="full_width">
				<div class="container">
					<?php
						if ( have_posts() ) :

							while ( have_posts() ) : the_post();

								get_template_part( 'content-video-blog');

							endwhile;

						endif;
					?>
				</div>
			</div>
		<?php else :

			get_template_part( 'content', 'not-member' );  ?>

		<?php endif; ?>
	</section>
<?php else : ?>

	<div class="wrap">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<?php endif; ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php

			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' =>  array( 'icon' => 'arrow-left' )  . '<span class="screen-reader-text">' . __( 'Previous page', '' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', '' ) . '</span>' . array( 'icon' => 'arrow-right' ) ,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', '' ) . ' </span>',
				) );

			else :

				get_template_part( 'content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrap -->

<?php endif; ?>


<?php get_footer();
