<?php
/**
 * Created by PhpStorm.
 * User: matteocirami
 * Date: 11/21/17
 * Time: 9:31 AM
 */

    $type = null;
    $videoLink = get_field('member_lesson_link');

    if (strpos($videoLink, "youtube") !== false) {
        $str = explode("embed/", $videoLink);
        $embedCode = preg_replace('/\s+/', '',$str[1]);
        $type = "youtube";
    } elseif (strpos($videoLink, "vimeo") !== false) {
        $str = explode("video/", $videoLink);
        $embedCode = preg_replace('/\s+/', '',$str[1]);
        $type = "vimeo";
    } elseif (strpos($videoLink, "soundslice") !== false) {

        $displayKeyboard = get_field('display_keyboard_video');
        $notation = get_field('has_notation');

        if($notation) {
            $controls = '1';
            $display = 'yes';
        } else {
            $controls = '0';
            $display = 'no';
        }

        $str = explode("scores/", $videoLink);
        $str = explode("/embed", $str[1]);
        $embedCode = $videoLink . "?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";

        if (get_field('display_keyboard_video')) {
            $embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
        }

        $type = "soundslice";
    }

    $count = 0;
    $taxonomies = [];
    $index = 0;

    $categories = get_the_category();

    foreach ($categories as $category) {
        $taxonomies[$index] = intval($category->term_id);
        $index++;
    }

    $levels = get_the_terms($post->ID, 'level');

    if (is_array($levels) || is_object($levels)) {
        foreach ($levels as $level) {
            $taxonomies[$index] = intval($level->term_id);
            $index++;
        }
    }

    $totalCount = count($taxonomies);
    $hash = $post->post_name;
    ?>

        <div class="column filtr-item" data-sort="value" data-category="<?php
            foreach ($taxonomies as $taxonomy) {
                echo $taxonomy;
                $count++;
                if ($count < $totalCount) {
                    echo ", ";
                }

            } ?>" >

            <?php if ($type == "soundslice" && get_field('display_keyboard_video')) : ?>

                    <input class="keyboard_embed" hidden data-embed="<?php echo $embedKeyboard;?>">

            <?php endif; ?>

            <?php
                $addFile = get_field('add_file');

                if (have_rows('files')) : ?>

                    <?php while (have_rows('files')) : the_row();?>

                        <a class="video_files" hidden href="#" data-file="<?php the_sub_field('file'); ?>" data-text="<?php the_sub_field('file_text'); ?>"></a>

                    <?php endwhile; ?>

                <?php endif; ?>

            <?php if ($type == 'youtube') : ?>

                    <a id="<?php echo $hash; ?>" class="play_video" data-type="<?php echo "youtube";?>" data-src="<?php echo $videoLink; ?>/?rel=0&showinfo=0&autoplay=1" data-title="<?php echo the_title();?>" href="#<?php echo $hash;?>">

            <?php elseif ($type == 'vimeo') : ?>

                    <a id="<?php echo $hash; ?>" class="play_video" data-type="<?php echo "vimeo";?>" data-src="<?php echo $videoLink; ?>/?autoplay=1" data-title="<?php echo the_title();?>" href="#<?php echo $hash;?>">

            <?php elseif ($type == 'soundslice') : ?>

                    <a id="<?php echo $hash; ?>" class="play_video"
                       data-replace="<?php the_field('vimeo_link'); ?>"
                       data-type="<?php echo "soundslice_video";?>"
                       data-src="<?php echo $embedCode; ?>"
                       data-title="<?php echo the_title();?>"
                       data-notation="<?php echo $display; ?>"
                       href="#<?php echo $hash;?>">

            <?php endif; ?><!-- type -->

                        <?php
                                $attachment_id = get_field('og_image');
                                $size = "video-thumb";
                                $ogImage = wp_get_attachment_image_src( $attachment_id, $size );
                                $video_thumbnail = get_video_thumbnail();

                               if (!empty($ogImage)) :
                        ?>
                            <img class="og_image" src="<?php echo $ogImage[0]; ?>" alt="">

                        <?php  elseif ( !is_wp_error($video_thumbnail) ) : ?>

                            <img class="get_video_thumbnail" src="<?php echo $video_thumbnail; ?>" alt="">

                        <?php elseif (($video_thumbnail = get_the_post_thumbnail()) != null ) :

                            echo $video_thumbnail;

                        else : ?>

                            <?php if ($type == 'youtube') { ?>

                                <img src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />

                            <?php } else { ?>

                                <img src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />

                            <?php } ?>


                        <?php endif; ?><!-- video thumbnail -->

                    </a>

                    <div class="lesson_content full_width">
                        <h4><?php the_title(); ?></h4>
                        <p>Date Added <?php echo get_the_date('n/j/Y'); ?></p>
                    </div>

                        <div class="comment_wrap">
                            <?php if ((is_single() || is_page()) && is_user_logged_in()) { comments_template(); }?>
                        </div>



        </div><!-- column -->