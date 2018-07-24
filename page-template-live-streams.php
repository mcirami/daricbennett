<?php
/**
 * Template Name: Live Streams
 *
 * The template for displaying past Live Streams.
 *
 *
 * @package boiler
 */


get_header();


global $post;

$args = array(
    'post_type' => 'live-streams',
    'order_by' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => -1
    //'paged' => $ourCurrentPage
);

$streams = new WP_Query($args);



?>

<div class="full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
	<header class="sub_header full_width">
		<div class="container">
			<h1>Past Live Streams</h1>
		</div><!-- .container -->
	</header>

	<div class="full_width live_stream blog">
		<div class="container">

            <?php if (pmpro_hasMembershipLevel()) : ?>

                    <article class="full_width">

                        <?php if ( $streams->have_posts() ) : ?>

                            <?php while ( $streams->have_posts() ) : $streams->the_post(); ?>

                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content-live-streams', get_post_format() );
                                ?>

                            <?php endwhile; ?>


                        <?php else : ?>

                                <h3>No Streams Yet</h3>

                        <?php endif; ?>
                    </article>

            <?php else :

                get_template_part( 'content', 'not-member' );  ?>

            <?php endif; ?>

        </div>
	</div>
</div>

<?php get_footer(); ?>