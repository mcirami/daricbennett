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
        } else {
            $controls = '0';
        }

        $str = explode("scores/", $videoLink);
        $str = explode("/embed", $str[1]);
        $embedCode = $videoLink . "?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";

        if ($displayKeyboard) {
            $embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
        }

        $type = "soundslice";
    }
    ?>

        <div class="column">

            <?php /*if ($type == "soundslice" && $displayKeyboard) : */?><!--
                                    <div class="keyboard_popup">
                                        <a href="#">Want to watch this bass line played on a keyboard?</a>
                                    </div>
                                --><?php /*endif; */?>

            <?php if ($type == 'youtube') : ?>

                    <a data-fancybox data-src="<?php echo $videoLink; ?>/?rel=0&showinfo=0&autoplay=1" href="javascript:;">

            <?php elseif ($type == 'vimeo') : ?>

                    <a data-fancybox data-src="<?php echo $videoLink; ?>/?autoplay=1" href="javascript:;">

            <?php elseif ($type == 'soundslice') : ?>

                    <a data-fancybox data-src="<?php echo $embedCode; ?>" href="javascript:;">

            <?php endif; ?><!-- type -->

                        <?php  if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) : ?>

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
        </div><!-- column -->

    <?php if(is_page(7)) :
            $videoOnly = get_field('no_video');
    ?>


            <div class="video_wrapper <?php if ($type == 'youtube' && $videoOnly == false) { echo "youtube_video";} elseif ($type == 'vimeo' && $videoOnly == false) {echo "vimeo_video"; } elseif ($type == 'soundslice' && $videoOnly == false) {echo "soundslice_video";}?> full_width" data-embed="<?php echo $embedCode;?>">
                <?php if ($videoOnly) { ?>
                    <a class="fancybox3" href="#fancybox3">
                <?php } ?>

                    <?php

                        if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) :

                            echo '<img src="' . $video_thumbnail . '" />';

                        elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) :

                            echo $video_thumbnail;

                        else : ?>

                            <?php if ($type == 'youtube') { ?>

                                <img src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />

                            <?php } else  { ?>

                                    <img class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />

                            <?php } ?>

                        <?php endif; ?>

                    <div class="button_wrap full_width">
                        <img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
                    </div>

                <?php if ($videoOnly) { ?>
                    </a>
                <?php } ?>

            </div><!-- video_wrapper -->


    <?php endif; ?><!-- page 7 -->

