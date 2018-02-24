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
        <div class="container">

        <?php if (pmpro_hasMembershipLevel()) : ?>
            <div class="wrap full_width">
                <div id="primary" class="content-area full_width">
                    <main id="main" class="site-main full_width" role="main">

                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post(); ?>

                            <a class="back_link" href="/video-q-and-a">back to submissions</a>
                            <?php
                            the_post_navigation( array(
                                'prev_text' => '<span class="screen-reader-text button black">' . __( 'Previous Submission', 'boiler' ) . '</span>',
                                'next_text' => '<span class="screen-reader-text button black">' . __( 'Next Submission', 'boiler' ) . '</span>'
                            ) );

                            get_template_part( 'content', 'single-video' );

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

        <?php else :

            get_template_part( 'content', 'not-member' );  ?>

        <?php endif; ?>

        </div>
    </section>

<?php get_footer();
