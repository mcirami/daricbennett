<?php

/**
 * Template Name: Member Lessons
 *
 * The template for displaying lessons page.
 *
 *
 * @package boiler
 */

get_header();
global $post;

    $args = array('post_type' => 'lessons');
    $args['search_filter_id'] = 1460;
    $lessons = new WP_Query($args);

?>

<div class="lessons_page full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
    <div class="container">

        <div class="filter_box full_width">
            <?php echo do_shortcode('[searchandfilter id="1460"]'); ?>
        </div>

        <div class="video_list full_width">

            <?php if ( $lessons->have_posts() ) : while( $lessons->have_posts() ) : $lessons->the_post();

                    $hide = get_field('hide_lesson');

                    if (!$hide) : ?>

                        <?php get_template_part('content', 'lesson'); ?>

                    <?php endif; ?> <!-- hide -->

                <?php endwhile; //query loop

                else :

                    echo 'no posts found';

                endif; // if has posts

                wp_reset_query();
            ?>

        </div><!-- video_list -->


    </div><!-- container -->

</div><!-- lessons_page -->





<?php get_footer(); ?>
