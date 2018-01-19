

    <?php $shareLink = get_field('share_link'); ?>

    <div class="panel <?php if(!$shareLink || !is_page(7)) { echo 'adjust';} ?>">
        <?php $upgrade = get_field('add_upgrade_link');

        if ($upgrade && is_page(7)) : ?>

            <div class="upgrade full_width">

                <a href="<?php the_field('upgrade_link'); ?>"><?php the_field('upgrade_link_text'); ?></a>

            </div>

        <?php endif;

        $addFile = get_field('add_file');

        if ($addFile && !is_page(7)) :

            $count = count(get_field('files'));
            ?>

            <?php if (have_rows('files')) : ?>

            <div class="file full_width">

                <?php while (have_rows('files')) : count(the_row());?>

                    <div class="link_wrap <?php if ($count == 2) { echo "two_files"; } ?>">
                        <a target="_blank" download href="<?php the_sub_field('file'); ?>"><?php the_sub_field('file_text'); ?></a>
                    </div>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

        <?php endif; ?>

        <?php
            $type = null;
            $str = get_field('free_lesson_link');

            if (strpos($str, "youtube") !== false) {
                $str = explode("embed/", $str);
                $embedCode = preg_replace('/\s+/', '',$str[1]);
                $type = "youtube";
            } elseif (strpos($str, "vimeo") !== false) {
                $str = explode("video/", $str);
                $embedCode = preg_replace('/\s+/', '',$str[1]);
                $type = "vimeo";
            } elseif (strpos($str, "soundslice") !== false) {

                $displayKeyboard = get_field('display_keyboard_video');
                $notation = get_field('has_notation');

                if($notation) {
                    $controls = '1';
                } else {
                    $controls = '0';
                }

                $str = explode("scores/", $str);
                $str = explode("/embed", $str[1]);
                $embedCode = preg_replace('/\s+/', '',$str[0]) . "/embed/?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";
                if ($displayKeyboard) {
                    $embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
                }
                $type = "soundslice";
            }

            $videoOnly = get_field('no_video');

            if ($type == "soundslice" && $displayKeyboard) :
                ?>
                <div class="keyboard_popup">
                    <a href="#">Want to watch this bass line played on a keyboard?</a>
                </div>
            <?php endif; ?>


            <div class="video_wrapper <?php if ($type == 'youtube' && $videoOnly == false) { echo "youtube_video";} elseif ($type == 'vimeo' && $videoOnly == false) {echo "vimeo_video"; } elseif ($type == 'soundslice' && $videoOnly == false) {echo "soundslice_video";}?> full_width" data-embed="<?php echo $embedCode;?>">
                <?php if ($videoOnly) { ?>
                    <a class="members_only_video_pop" href="#members_only_video_pop">
                <?php } ?>

                    <?php
                        $attachment_id = get_field('og_image');
                        $size = "video-thumb";
                        $ogImage = wp_get_attachment_image_src( $attachment_id, $size );
                        $video_thumbnail = get_video_thumbnail();

                        if (!empty($ogImage)) : ?>

                            <img class="og_image" src="<?php echo $ogImage[0]; ?>" alt="">

                    <?php elseif ( !is_wp_error($video_thumbnail)) : ?>

                            <img class="get_video_thumbnail" src="<?php echo $video_thumbnail; ?>" alt="">

                    <?php elseif ($video_thumbnail = get_the_post_thumbnail() != null ) :

                            echo $video_thumbnail;

                        else : ?>

                            <?php if ($type == 'youtube') { ?>

                                <img class="youtube_img" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />

                            <?php } else { ?>

                                <img class="screenshot" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />

                            <?php } ?>


                    <?php endif; ?><!-- video thumbnail -->

                    <div class="button_wrap full_width">
                        <img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
                    </div>

                <?php if ($videoOnly) { ?>
                    </a>
                <?php } ?>

            </div><!-- video_wrapper -->

            <?php if ((is_single() || is_page()) && is_user_logged_in()) { comments_template(); }?>

            <?php if ($shareLink && is_page(7)) :

                $lessonLink = get_post_permalink();
                ?>

                <div class="share_buttons full_width">
                    <div class="social_button_wrap">
                        <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_field('share_link'); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/icon-facebook-f.png" />Share</a>
                    </div>
                    <div class="social_button_wrap">
                        <a class="email" href="mailto:?&subject=Awesome Bass Lesson!&body=Check%20out%20this%20bass%20lesson%20I%20found%20on%20http%3A//daricbennett.com...%0A%0A<?php echo the_field('share_link');?>"><img src="<?php echo bloginfo('template_url'); ?>/images/email-envelope.png" />Email</a>
                    </div>
                    <div class="social_button_wrap">
                        <a target="_blank" class="page" href="<?php echo $lessonLink;?>">Lesson Page</a>
                    </div>
                </div>

            <?php endif; ?>

    </div><!-- panel -->
