<?php

/**
 * Template Name: Free Lessons
 *
 * The template for displaying free lessons page.
 *
 *
 * @package boiler
 */

get_header();
global $post;

?>


    <div class="lessons_page full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">

        <?php /*if (pmpro_hasMembershipLevel() || is_page(7)): */?>

            <header class="sub_header full_width">
                <div class="container">
                    <h1><?php the_field('page_header'); ?></h1>
                </div><!-- .container -->
            </header>

            <div class="videos full_width">
                <div class="container">
                    <div class="intro_text full_width">

                        <?php $heading = get_field('heading_text');

                        if ($heading != '') : ?>
                            <h3><?php the_field('heading_text'); ?></h3>
                        <?php endif; ?>

                        <?php $desc = get_field('description');

                        if ($desc != '') : ?>
                            <p><?php the_field('description' , false, false); ?></p>
                        <?php endif; ?>
                    </div><!-- intro_text -->

                    <?php $videoLink = get_field('intro_video_link');

                    if ($videoLink != '') : ?>

                        <div class="top_video_section full_width">
                            <div class="video_wrap">
                                <div class="button_wrap">
                                    <a class="button yellow" href="/membership-account/membership-levels/">Start My Full Access Free Trial Now!</a>
                                </div>
                                <div class="video_wrapper full_width">
                                    <iframe src="<?php echo the_field('intro_video_link'); ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="social_media_column">

                                <?php get_template_part( 'content', 'social-media' ); ?>

                            </div>
                        </div>

                    <?php endif; ?>

                    <?php
                        $lessonsHeading = get_field('lessons_heading');
                        if ($lessonsHeading != '') : ?>

                            <div class="full_width">
                                <h2><?php echo $lessonsHeading; ?></h2>
                            </div>

                    <?php endif; ?>

                    <div class="video_list full_width <?php if($videoLink == '') { echo 'adjust';} ?>">

                        <?php $subHeadingField = get_field_object('display_lesson_sub_heading');
                        //$sectionsField = get_field_object('sections');

                        $subHeading = $subHeadingField['value'];
                        //$sectionsField = $sectionsField['value'];

                        /*if ($sectionsField == "By Level") :

                            $taxonomy = "level";
                            //if (is_page(434)) :
                            $terms = get_terms( array(
                                'taxonomy' => 'level',
                                'orderby' => 'description',
                            ));
                        elseif ($sectionsField == "By Category") :
                            $taxonomy = "category";

                            $terms = get_terms( array(
                                'taxonomy' => 'category',
                                'orderby' => 'description',
                                'exclude' => array(8, 10, 3, 1),
                                //'exclude' => array(14, 15, 16, 1), //for local
                            ));
                        endif;*/

                        /*if 	($sectionsField != "None") :

                            foreach ( $terms as $term ) {

                                $currentTerm = $term->slug;

                                $lessonsQuery = new WP_Query(array (
                                    'post_type' => 'lessons',
                                    'tax_query' => array (
                                        array (
                                            'taxonomy' => $taxonomy,
                                            'field' => 'slug',
                                            'terms' => array($currentTerm),
                                            'operator' => 'IN',
                                            'order_by' => 'post_date',
                                            'order' => 'DESC',
                                            'posts_per_page' => -1,
                                        )
                                    )
                                ));


                                */?><!--
                                <div class="section_title full_width">
                                    <h2><?php /*echo $term->name; */?></h2>
                                </div>
                                <?php
/*                                if ( $lessonsQuery->have_posts() ) : while( $lessonsQuery->have_posts() ) : $lessonsQuery->the_post();

                                    $hide = get_field('hide_lesson');

                                    if (!$hide) : */?>

                                           <?php /*get_template_part('content', 'lesson'); */?>

                                    <?php /*endif; */?> <!-- hide -->

                                <?php /*endwhile; //query loop

                                else :

                                    echo 'no posts found';

                                endif; // if has posts

                                $lessonsQuery = null;
                                wp_reset_postdata();

                            } /* foreach */

                        //else :  //no sections



                            $args = array (
                                'post_type' => 'lessons',
                                'tax_query' => array (
                                    array (
                                        'taxonomy' => 'category',
                                        'field' => 'slug',
                                        'terms' => 'free-lessons',
                                        'order_by' => 'post_date',
                                        'order' => 'DESC',
                                        'posts_per_page' => -1,
                                    )
                                ),

                            );

                            $lessons = new WP_Query($args);

                            if ( $lessons->have_posts() ) : while( $lessons->have_posts() ) : $lessons->the_post();

                                $hide = get_field('hide_lesson');

                                if (!$hide) : ?>

                                    <div class="row full_width">
                                        <div class="left_column">

                                            <p><?php the_title(); ?></p>
                                            <?php if ($subHeading != 'None'):

                                                $terms = wp_get_post_terms( $post->ID, 'level' );

                                                ?>
                                                <p class="level">
                                                    <span>
                                                        <?php if($subHeading == "Show Lesson Date"){
                                                            echo get_the_date('n/j/Y');
                                                        }elseif ($subHeading == "Show Lesson Description"){
                                                            echo the_field('title_bar_description');
                                                        } else {
                                                            foreach ($terms as $term) {
                                                                echo $term->name;
                                                            }
                                                        } ?>
                                                    </span>
                                                </p>

                                            <?php endif; ?>

                                        </div><!-- left_column -->

                                        <?php $hash = $post->post_name; ?>

                                        <div class="accordion right_column" id="<?php echo $hash ?>">
                                            <div class="watch" ><?php the_field('button_text'); ?></div>
                                            <a href="#<?php echo $hash ?>" class="arrow"><img src="<?php echo bloginfo('template_url'); ?>/images/up-arrow.png" /></a>
                                        </div>

                                        <?php get_template_part('content', 'free-lesson'); ?>


                                    </div><!-- row -->

                                <?php endif; ?> <!-- hide -->

                            <?php endwhile; //query loop

                            else :

                                echo 'no posts found';

                            endif; // if has posts

                            wp_reset_query();

                        //endif; ?> <!-- $sectionsField -->

                    </div><!-- video_list -->
                </div><!-- .container -->
            </div>
        <?php /*else :

            get_template_part( 'content', 'not-member' );

        endif; */?>
    </div>

    <div id="members_only_video_pop">
        <img src="<?php echo bloginfo('template_url'); ?>/images/logo.png"/>
        <h2>This Lesson Is For Members Only</h2>
        <div class="button_wrap">
            <a class="button red" href="/membership-account/membership-levels/">Start My Free Trial For Full Access!</a>
        </div>
    </div>

<?php get_footer(); ?>