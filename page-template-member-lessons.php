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

if (pmpro_hasMembershipLevel()) {
    global $post;

        $args = array(
            'post_type' => 'lessons',
            'order_by' => 'post_date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        );
        $lessons = new WP_Query($args);

        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
}
?>

<div class="lessons_page full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">

    <header class="sub_header full_width">
        <div class="container">
            <h1><?php echo the_title(); //the_field('page_header'); ?></h1>
        </div><!-- .container -->
    </header>

<?php if (pmpro_hasMembershipLevel()) : ?>

        <div id="video_player" class="full_width">
            <div id="video_iframe_wrap"></div>
            <div id="video_content_wrap"></div>
        </div>

        <div class="full_width">


            <div class="container">

                <div class="video_list full_width">

                    <div class="filter_controls full_width">
                        <div class="search_box">
                            <input type="text" name="search" placeholder="Search Lesson By Keyword" data-search>
                        </div>
                        <div class="filters">
                            <h3>Filter Lessons By<span>:</span></h3>
                            <p>(select as many as you like)</p>

                            <?php if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') : ?>

                                <ul class="filter_list full_width">
                                    <li data-multifilter="all" class="active all">All</li>
                                    <li data-multifilter="42">Ultra Beginner</li>
                                    <li data-multifilter="12">Beginner</li>
                                    <li data-multifilter="13">Intermediate</li>
                                    <li data-multifilter="14">Advanced</li>
                                    <li data-multifilter="7">Exercises</li>
                                    <li data-multifilter="9">Grooves</li>
                                    <li data-multifilter="39">Modes</li>
                                    <li data-multifilter="40">Slap Series</li>
                                    <li data-multifilter="38">Funk Challenges</li>
                                    <li data-multifilter="10">Live Sessions</li>
                                    <li data-multifilter="6">Covers</li>
                                    <li data-multifilter="37">Ask Daric</li>
                                </ul>

                            <?php elseif (strpos($actual_link, "staging") != false) : ?>

                                <ul class="filter_list full_width">
                                    <li data-multifilter="all" class="active all">All</li>
                                    <li data-multifilter="41">Ultra Beginner</li>
                                    <li data-multifilter="12">Beginner</li>
                                    <li data-multifilter="13">Intermediate</li>
                                    <li data-multifilter="14">Advanced</li>
                                    <li data-multifilter="7">Exercises</li>
                                    <li data-multifilter="9">Grooves</li>
                                    <li data-multifilter="37">Modes</li>
                                    <li data-multifilter="11">Navigation, Scales & Intervals</li>
                                    <li data-multifilter="40">Slap Series</li>
                                    <li data-multifilter="39">Funk Challenges</li>
                                    <li data-multifilter="10">Live Sessions</li>
                                    <li data-multifilter="6">Covers</li>
                                    <li data-multifilter="38">Ask Daric</li>
                                </ul>

                            <?php else : ?>

                                <ul class="filter_list full_width">
                                    <li data-multifilter="all" class="active all">All</li>
                                    <li data-multifilter="34">Ultra Beginner</li>
                                    <li data-multifilter="12">Beginner</li>
                                    <li data-multifilter="13">Intermediate</li>
                                    <li data-multifilter="14">Advanced</li>
                                    <li data-multifilter="7">Exercises</li>
                                    <li data-multifilter="9">Grooves</li>
                                    <li data-multifilter="17">Modes</li>
                                    <li data-multifilter="11">Navigation, Scales & Intervals</li>
                                    <li data-multifilter="29">Slap Series</li>
                                    <li data-multifilter="16">Funk Challenges</li>
                                    <li data-multifilter="10">Live Sessions</li>
                                    <li data-multifilter="6">Covers</li>
                                    <li data-multifilter="15">Ask Daric</li>
                                </ul>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div id="filter_images" class="filtr-container full_width">

                        <?php if ( $lessons->have_posts() ) : while( $lessons->have_posts() ) : $lessons->the_post();

                                $hide = get_field('hide_lesson');

                                if (!$hide) : ?>

                                    <?php get_template_part('content', 'member-lesson'); ?>

                                <?php endif; ?> <!-- hide -->

                            <?php endwhile; //query loop

                            else :

                                echo 'no posts found';

                            endif; // if has posts

                            wp_reset_query();
                        ?>

                    </div><!-- filtr-container -->

                </div><!-- video_list -->


            </div><!-- container -->
        </div><!-- full_width -->

<?php else :

    get_template_part( 'content', 'not-member' );  ?>

<?php endif; ?>

</div><!-- lessons_page -->



<?php get_footer(); ?>
