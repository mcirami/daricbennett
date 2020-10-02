<?php

/**
 * Template Name: Video Blog
 *
 * The template for displaying Videos Submitted.
 *
 *
 * @package boiler
 */

get_header();

$pageTitle = esc_html(get_the_title());

if($pageTitle == "Video Q &#038; A") {

	acf_form_head();

	$args = array(
		'post_type' => 'videos',
		'order_by' => 'post_date',
		'order' => 'DESC',
		'posts_per_page' => -1,
	);

} elseif ($pageTitle == "Bass Nation TV") {

	$args = array (
	    'post_type' => 'tv-videos',
	    'order_by' => 'post_date',
	    'order' => 'DESC',
	    'posts_per_page' => -1,
	);
} elseif ($pageTitle == "Beginners Course") {
	$args = array (
		'post_type' => 'lessons',
		'tax_query' => array(
			array(
				'taxonomy' => 'level',
				'field' => 'slug',
				'terms' => 'beginner'
			),
		),
		'order_by' => 'post_date',
		'order' => 'ASC',
		'posts_per_page' => -1,
	);
} elseif ($pageTitle == "Slap Course") {
	$args = array (
		'post_type' => 'lessons',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'slap-series'
			),
		),
		'order_by' => 'post_date',
		'order' => 'ASC',
		'posts_per_page' => -1,
	);
}

$posts = new WP_Query($args);

?>
    <section class="video_submit page_content full_width<?php if (is_user_logged_in()){ echo " member";} ?>">
        <header class="sub_header full_width">
            <div class="container">
                <h2><?php the_field('page_title'); ?></h2>
            </div><!-- .container -->
        </header>

        <?php if (pmpro_hasMembershipLevel()) : ?>

            <div class="full_width">
                <div class="container">
                    <div class="top_section">
	                    <?php if (get_field('sub_heading')) {?>
                                <h3><?php the_field('sub_heading'); ?></h3>
	                    <?php } ?>
	                    <?php if (get_field('description')) {?>
                                <p><?php the_field('description'); ?></p>
	                        <?php } ?>
	                    <?php if($pageTitle == "Video Q &#038; A") : ?>
                            <button id="post_video_btn" class="button yellow"><?php the_field('button_text'); ?></button>
	                    <?php endif; ?>

                    </div><!-- top_section -->
	                    <?php if($pageTitle == "Video Q &#038; A") : ?>
	                        <div id="post_submit_form" class="full_width">

	                            <div class="form_wrap full_width">

	                                <h3>Upload A YouTube Video & Question</h3>
	                                <?php

	                                acf_form(array(
	                                    'post_id'		=> 'new_post',
	                                    'post_title'	=> true,
	                                    'post_content'	=> false,
	                                    'new_post'		=> array(
	                                        'post_type'		=> 'videos',
	                                        'post_status'	=> 'publish'
	                                    ),
	                                    'return'		=> home_url('/video-q-and-a/'),
	                                    'submit_value'	=> 'Submit Post',
	                                    'html_after_fields' => '<a class="cancel_post button yellow" href="#">Cancel</a>'
	                                ));

	                                ?>
	                            </div>

	                        </div>
	                    <?php endif; ?>


	                <article class="content">

                        <?php if ( $posts->have_posts() ) : ?>

                            <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                    get_template_part( 'content-video-blog', get_post_format() );
                                ?>

                            <?php endwhile; ?>

                            <?php //boiler_content_nav( 'nav-below' ); ?>

                        <?php else : ?>

		                    <?php if($pageTitle == "Video Q &#038; A") : ?>
                                <h3>No Submissions Yet</h3>
                                <p>Click on the button above to post a video and question.</p>
		                    <?php  elseif($pageTitle == "Bass Nation TV") : ?>
			                    <h3>Bass Nation TV Coming Soon...</h3>
		                        <h3>Stay Tuned</h3>
	                        <?php endif; ?>

	                        <?php //get_template_part( 'no-results', 'index' ); ?>

                        <?php endif; ?>
                    </article>
                </div><!-- container -->

                <?php //get_sidebar(); ?>

            </div><!-- full_width -->

        <?php else :

            get_template_part( 'content', 'not-member' );  ?>

        <?php endif; ?>

    </section>

<?php get_footer(); ?>
<form action=""></form>