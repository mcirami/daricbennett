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

	<section class="page_content full_width<?php if (is_user_logged_in()){ echo " member";} ?>">

		<div class="container">

	        <div class="wrap">
	            <div id="primary" class="content-area">
	                <main id="main" class="site-main" role="main">

	                    <?php
	                    /* Start the Loop */
	                    while ( have_posts() ) : the_post();

	                        get_template_part( 'content', get_post_format() );

	                        // If comments are open or we have at least one comment, load up the comment template.
	                        if ( comments_open() || get_comments_number() ) :
	                            comments_template();
	                        endif;

	                        the_post_navigation( array(
	                            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'boiler' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'boiler' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' /*. twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) )*/ . '</span>%title</span>',
	                            'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'boiler' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'boiler' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' /*. twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) )*/ . '</span></span>',
	                        ) );

	                    endwhile; // End of the loop.
	                    ?>

	                </main><!-- #main -->
	            </div><!-- #primary -->
	            <?php //get_sidebar(); ?>
	        </div><!-- .wrap -->
        </div>
	</section>

<?php get_footer();
