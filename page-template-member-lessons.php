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

$title = get_the_title();

if (pmpro_hasMembershipLevel()) {

    $favorites = get_user_favorites();

    global $post;

    if ($title == "Lessons") {

    	//$ourCurrentPage = get_query_var('pages');

        $args = array(
            'post_type' => 'lessons',
            'order_by' => 'post_date',
            'order' => 'DESC',
            'posts_per_page' => -1
	        //'paged' => $ourCurrentPage
        );

	    $catTerms = get_terms('category');
	    $levelTerms = get_terms('level', array(
	    		'orderby' => 'description'
	    ));

    } else {
        $args = array(
            'post_type' => 'lessons',
            'order_by' => 'post_date',
            'order' => 'DESC',
            'post__in' => $favorites,
            //'posts_per_page' => -1,
        );
    }

    $lessons = new WP_Query($args);

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
}


?>

<div class="lessons_page full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">

    <header class="sub_header full_width">
        <div class="container">
            <h1><?php echo $title; //the_field('page_header'); ?></h1>
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

                    <?php if ($title == "Lessons") : ?>

                        <div class="filter_controls full_width">
                            <div class="search_box">
                                <input type="text" name="search" placeholder="Search Lesson By Keyword" data-search>
                            </div>

                            <div class="filters">
                                <h3>Filter Lessons By<span>:</span></h3>
                                <p>(select as many as you like)</p>

                                <ul class="filter_list full_width">
                                    <li data-multifilter="all" class="active all">All</li>

	                                <?php foreach ($levelTerms as $levelTerm) : ?>

			                               <li data-multifilter="<?php echo $levelTerm->term_id;?>"><?php echo $levelTerm->name;?></li>

	                                <?php endforeach; ?>

                                    <?php foreach ($catTerms as $catTerm) :

	                                        if($catTerm->slug !== "members-only" && $catTerm->slug !== "uncategorized" && $catTerm->slug !== "free-lessons" && $catTerm->slug !== "ultra-beginner-series") :
	                                    ?>
                                                    <li data-multifilter="<?php echo $catTerm->term_id;?>"><?php echo $catTerm->name;?></li>

	                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        </div><!-- filter_controls -->
                    <?php else : ?>

                        <div class="top_content full_width">
                            <?php if ($favorites != null) :
                                    $favCount = get_user_favorites_count();
                                ?>
                                <h3><?php echo $favCount; ?> <?php if( $favCount == 1) { echo "Favorite"; } else {echo "Favorites";}?></h3>
                            <?php endif; ?>

                            <?php the_clear_favorites_button(); ?>
                        </div>

                    <?php endif; ?>

	                <div id="easyPaginate" class="full_width">

	                    <div id="filter_images" class="filtr-container full_width">

	                        <?php if ($favorites == null && $title == "Favorite Lessons") : ?>

	                            <div class="text_wrap full_width">
	                                <h2>You have no Favorite Lessons</h2>
	                                <div class="button_wrap full_width">
	                                    <a class="button red" href="/lessons">Go To Lesson page Now!</a>
	                                </div>

	                            </div>

	                        <?php else : ?>

	                            <?php if ( $lessons->have_posts() ) : while( $lessons->have_posts() ) : $lessons->the_post();

	                                    $hide = get_field('hide_lesson');

	                                    if (!$hide) : ?>

	                                        <?php get_template_part('content', 'member-lesson'); ?>

	                                    <?php endif; ?> <!-- hide -->

	                                <?php endwhile; //query loop


						                /*previous_posts_link();
						                next_posts_link('Next Page', $lessons->max_num_pages);*/
	                                else :

	                                    echo 'no posts found';

	                                endif; // if has posts

	                                wp_reset_query();
	                            ?>

	                        <?php endif; ?>

	                    </div><!-- filtr-container -->

	                </div><!-- filter_images -->
                </div>



            </div><!-- container -->
        </div><!-- full_width -->

<?php else :

    get_template_part( 'content', 'not-member' );  ?>

<?php endif; ?>

</div><!-- lessons_page -->


<?php get_footer(); ?>
