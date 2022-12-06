<?php
/**
 * Template Name: BN Live Stream
 *
 * The template for displaying past Live Streams.
 *
 *
 * @package boiler
 */


get_header();
?>

<div class="full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
	<header class="sub_header full_width">
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div><!-- .container -->
	</header>

	<div class="full_width live_stream">
		<div class="container">

            <?php if (pmpro_hasMembershipLevel()) : ?>

                <section class="columns_wrap">
	                <?php the_content(); ?>
                </section>

                <div class="full_width button_row">
	                <a class="button red" href="">
		                View Past Streams
	                </a>
                </div>

            <?php else :

                get_template_part( 'content', 'not-member' );  ?>

            <?php endif; ?>

        </div>
	</div>
</div>

<?php
get_footer();
?>