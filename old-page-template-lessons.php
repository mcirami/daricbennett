<?php
	
	/**
	 * Template Name: Lessons
	 *
	 * The template for displaying lessons page.
	 *
	 *
	 * @package boiler
	 */
	 
    get_header();
 	global $post;

?>
  
 
 <section class="lessons_page full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
 	
 	<?php if (pmpro_hasMembershipLevel() || is_page(7)): ?>
 	
	 	<header class="sub_header full_width">
			<div class="container">
				<h1><?php the_field('page_header'); ?></h1>
			</div><!-- .container -->
		 </header>
	 	
		<section class="videos full_width">
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
                </div>

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
				
				<div class="video_list full_width <?php if($videoLink == '') { echo 'adjust';} ?>">
					
				<?php $subHeadingField = get_field_object('display_lesson_sub_heading');
					  $sectionsField = get_field_object('sections');
					  
					  $subHeading = $subHeadingField['value'];
					  $sectionsField = $sectionsField['value'];
						  
					if ($sectionsField == "By Level") :
							
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
					endif;
					
					if 	($sectionsField != "None") :
							
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
							
							
							?>
							<div class="section_title full_width">
								<h2><?php echo $term->name; ?></h2>
							</div>
							<?php
							if ( $lessonsQuery->have_posts() ) : while( $lessonsQuery->have_posts() ) : $lessonsQuery->the_post();
						
								$hide = get_field('hide_lesson');
								
								if (!$hide) : ?>
									
									<div class="row full_width">
										<div class="left_column">
												
											<p><?php the_title(); ?></p>
											<?php if ($subHeading != 'None'):
											
												$terms = wp_get_post_terms( $post->ID, 'level' );
												
											?>
												<p class="level"><span>
													<?php if($subHeading == "Show Lesson Date"){ 
															echo get_the_date('n/j/Y');
														   }elseif ($subHeading == "Show Lesson Description"){
															   echo the_field('title_bar_description');
														   } else { 
															   foreach ($terms as $term) {
																   echo $term->name;
																}
														   } ?></span></p>
												
											<?php endif; ?>
										</div>
										
										<?php $hash = $post->post_name; ?>
										
										<div class="accordion right_column" id="<?php echo $hash ?>">
											<div class="watch" ><?php the_field('button_text'); ?></div>
											<a href="#<?php echo $hash ?>" class="arrow"><img src="<?php echo bloginfo('template_url'); ?>/images/up-arrow.png" /></a>
										</div>
										
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
			
																<a  target="_blank" download href="<?php the_sub_field('file'); ?>"><?php the_sub_field('file_text'); ?></a>
															</div>
			
														<?php endwhile; ?>
													
													</div>
													
												<?php endif; ?>
												
											<?php endif; ?>

                                            <?php if(is_page(7)) :
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
                                                            <a class="fancybox3" href="#fancybox3">
                                                        <?php } ?>

                                                                <?php if ($type == 'youtube') :

                                                                        if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                            echo '<img class="youtube_image" src="' . $video_thumbnail . '" />';
                                                                        } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                            echo $video_thumbnail;
                                                                        } else { ?>
                                                                            <img class="youtube_image"  src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                                                                        <?php } ?>


                                                                <?php elseif ($type == 'vimeo') : ?>

                                                                        <?php if( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
                                                                                echo '<img class="vimeo_image" src="' . $video_thumbnail . '" />';
                                                                              } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                                    echo $video_thumbnail;
                                                                              } else { ?>
                                                                                <img class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                                        <?php } ?>

                                                                <?php elseif ($type == 'soundslice') :

                                                                            if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                                echo '<img class="soundslice_image" src="' . $video_thumbnail . '" />';
                                                                            } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                                echo $video_thumbnail;
                                                                            } else { ?>
                                                                                <img class="soundslice_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                                            <?php } ?>

                                                                <?php endif; ?>

                                                                <div class="button_wrap full_width">
                                                                    <img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
                                                                </div>

                                                        <?php if ($videoOnly) { ?>
                                                            </a>
                                                        <?php } ?>
														
													</div><!-- video_wrapper -->
													
											<?php else :
                                                    $embedKeyboard = null;
                                                    $type = null;
													$str = get_field('member_lesson_link');
												if (strpos($str, "youtube") !== false) {
													$str = explode("embed/", $str);
													$embedCode = preg_replace('/\s+/', '',$str[1]);
													$type = "youtube";
												} elseif (strpos($str, "vimeo") !== false)   {
													$str = explode("video/", $str);
													$embedCode = preg_replace('/\s+/', '', $str[1]);
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
                                                    $embedCode = preg_replace('/\s+/', '', $str[0])  . "/embed/?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";
                                                    if ($displayKeyboard) {
                                                        $embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
                                                    }

                                                    $type = "soundslice";
                                                }
                                                    if ($type == "soundslice" && $displayKeyboard) :
                                             ?>
                                                        <div class="link_wrap full_width">
                                                            <a class="keyboard_link" data-embed="<?php echo $embedKeyboard;?>" href="#">Want to watch this bass line played on a keyboard?</a>
                                                        </div>

                                                    <?php endif; ?>

                                                <?php if ($type == "soundslice") : ?>

                                                <div class="link_wrap full_width replace_link">
                                                    <p>Video trouble? <a class="replace_video" href="#"  data="<?php echo the_field('vimeo_link');?>">Use this LINK!</a></p>
                                                </div>

                                            <?php endif; ?>


                                                <div class="video_wrapper <?php if ($type == 'youtube') { echo "youtube_video";} elseif ($type == 'vimeo') {echo "vimeo_video"; } elseif ($type == 'soundslice') {echo "soundslice_video";}?> full_width" data-embed="<?php echo $embedCode;?>">
												<?php if ($type == "vimeo") : ?>

													<?php if( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
															echo "<img src='" . $video_thumbnail . "' />";
														  } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                echo $video_thumbnail;
                                                           } else { ?>
                                                                <img class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
														  <?php } ?>

												<?php elseif  ($type == "youtube") :

                                                    if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                        echo '<img src="' . $video_thumbnail . '" />';
                                                    } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                        echo $video_thumbnail;
                                                    } else { ?>
                                                        <img class="youtube_image" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                                                    <?php } ?>

                                                <?php elseif ($type == 'soundslice') :

                                                        if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                            echo '<img class="soundslice_image" src="' . $video_thumbnail . '" />';
                                                        } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                            echo $video_thumbnail;
                                                        } else { ?>
                                                            <img class="soundslice_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                        <?php } ?>

                                                <?php endif; ?>

													<div class="button_wrap full_width">
														<img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
													</div>
											</div><!-- video_wrapper -->

                                                <?php if ((is_single() || is_page()) && is_user_logged_in()) { comments_template(); }?>
													
											<?php endif; ?>
											
											<?php if ($shareLink && is_page(7)) : 
												
												$lessonLink = get_post_permalink();
											?>
											<!--<div class="share_button full_width">
													<p class="share">Share</p>
												</div>
												<p class="link"><?php the_field('share_link'); ?></p>
											-->
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
									</div><!-- row -->
									
								<?php endif; ?> <!-- hide -->
							
							<?php endwhile; //query loop
							
							else :
								
								echo 'no posts found';
							
							endif; // if has posts
							
							 $lessonsQuery = null;
							 wp_reset_postdata();
							 
						} /* foreach */
						
					else :  //no sections
						
						if (is_page(7)) {
 	
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
							
						} elseif (is_page(319)) {
							$args = array (
									'post_type' => 'lessons',
									'tax_query' => array (
										array (
											'taxonomy' => 'category',
											'field' => 'slug',
											'terms' => 'live-sessions',
											'order_by' => 'post_date',
											'order' => 'DESC',
											'posts_per_page' => -1,
										)
									),
										
								);
						} else {
							$args = array (
									'post_type' => 'lessons',
									'tax_query' => array (
										array (
											'taxonomy' => 'category',
											'field' => 'slug',
											'terms' => array('live-sessions', 'covers', 'members-only', 'uncategorized'),
											'operator' => 'NOT IN',
											'order_by' => 'post_date',
											'order' => 'DESC',
											'posts_per_page' => -1,
										)
									),
										
								);
							}
						
						$lessons = new WP_Query($args);
						
						
						$lessonsHeading = get_field('lessons_heading');
						 
						if ($lessonsHeading != '') : ?>

                            <div class="full_width">
                                <h2><?php echo $lessonsHeading; ?></h2>
                            </div>

						<?php endif;
						
						if ( $lessons->have_posts() ) : while( $lessons->have_posts() ) : $lessons->the_post();
							
							$hide = get_field('hide_lesson');
							
							if (!$hide) : ?>
								
								<div class="row full_width">
									<div class="left_column">
											
										<p><?php the_title(); ?></p>
										<?php if ($subHeading != 'None'):
										
											$terms = wp_get_post_terms( $post->ID, 'level' );
											
										?>
											<p class="level"><span>
												<?php if($subHeading == "Show Lesson Date"){ 
													
														echo get_the_date('n/j/Y');
													   } elseif ($subHeading == "Show Lesson Description"){
																  echo the_field('title_bar_description');
													   } else { 
														   foreach ($terms as $term) {
															   echo $term->name;
															}
													   } ?></span></p>
											
										<?php endif; ?>
									</div>
									
									<?php $hash = $post->post_name; ?>
									
									<div class="accordion right_column" id="<?php echo $hash ?>">
										<div class="watch" ><?php the_field('button_text'); ?></div>
										<a href="#<?php echo $hash ?>" class="arrow"><img src="<?php echo bloginfo('template_url'); ?>/images/up-arrow.png" /></a>
									</div>
									
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
										<?php if(is_page(7)) :
												//$typeField = get_field_object('free_link_type');
												//$typeFieldValue = $typeField['value'];
                                                $type = null;
												$str = get_field('free_lesson_link');
												if (strpos($str, "youtube") !== false) {
													$str = explode("embed/", $str);
													$embedCode = preg_replace('/\s+/', '', $str[1]);
													$type = "youtube";
												} elseif (strpos($str, "vimeo") !== false) {
													$str = explode("video/", $str);
													$embedCode = preg_replace('/\s+/', '', $str[1]);
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
                                                    $embedCode = preg_replace('/\s+/', '', $str[0]) . "/embed/?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";
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
                                                        <a class="fancybox3" href="#fancybox3">
                                                    <?php } ?>
                                                        <?php if ($type == 'youtube') :

                                                                    if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                        echo '<img src="' . $video_thumbnail . '" />';
                                                                    } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                        echo $video_thumbnail;
                                                                    } else { ?>
                                                                        <img class="youtube_image" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                                                                    <?php } ?>

                                                        <?php elseif ($type == 'vimeo') : ?>

                                                            <?php if( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
                                                                        echo '<img src="' . $video_thumbnail . '" />';
                                                                  } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                        echo $video_thumbnail;
                                                                  } else { ?>
                                                                        <img  class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                                  <?php } ?>

                                                        <?php elseif ($type == 'soundslice') :

                                                                    if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                        echo '<img class="soundslice_image" src="' . $video_thumbnail . '" />';
                                                                    } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                        echo $video_thumbnail;
                                                                    } else { ?>
                                                                        <img class="soundslice_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                                    <?php } ?>

                                                        <?php endif; ?>

                                                        <div class="button_wrap full_width">
                                                            <img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
                                                        </div>
                                                    <?php if ($videoOnly) { ?>
                                                        </a>
                                                    <?php } ?>
												</div><!-- video_wrapper -->
												
										<?php else : 
												//$typeFieldMember = get_field_object('member_link_type');
												//$typeFieldMemberValue = $typeField['value'];
                                                $type = null;
                                                $embedKeyboard = null;
												$str = get_field('member_lesson_link');
												if (strpos($str, "youtube") !== false) {
													$str = explode("embed/", $str);
													$embedCode = preg_replace('/\s+/', '', $str[1]);
													$type = "youtube";
												} elseif (strpos($str, "vimeo") !== false) {
													$str = explode("video/", $str);
													$embedCode = preg_replace('/\s+/', '', $str[1]);
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
                                                    $embedCode = preg_replace('/\s+/', '', $str[0]) . "/embed/?api=1&branding=2&fretboard=1&force_top_video=1&top_controls=" . $controls . "&scroll_type=2&narrow_video_height=48p&enable_waveform=0&synth_display_name=Keyboard";
                                                    if ($displayKeyboard) {
                                                        $embedKeyboard = $embedCode . "&recording_idx=0&keyboard=1";
                                                    }
                                                    $type = "soundslice";
                                                }

                                                 if ($type == "soundslice" && $displayKeyboard) :
                                        ?>
                                                    <div class="full_width link_wrap">
                                                        <a class="keyboard_link" data-embed="<?php echo $embedKeyboard;?>" href="#">Want to watch this bass line played on a keyboard?</a>
                                                    </div>

                                                <?php endif; ?>

                                            <?php if ($type == "soundslice") : ?>

                                                <div class="link_wrap full_width replace_link">
                                                    <p>Video trouble? <a class="replace_video" href="#"  data="<?php echo the_field('vimeo_link');?>">Use this LINK!</a></p>
                                                </div>

                                            <?php endif; ?>
										
											<div class="video_wrapper <?php if ($type == 'youtube') { echo "youtube_video";} elseif ($type == 'vimeo') {echo "vimeo_video"; } elseif($type == 'soundslice') {echo "soundslice_video";}?> full_width" data-embed="<?php echo $embedCode;?>">
												<?php if ($type == "vimeo") : ?>

														<?php if( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
																echo "<img src='" . $video_thumbnail . "' />"; 
															  } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                    echo $video_thumbnail;
                                                              } else { ?>
															  	    <img class="vimeo_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                        <?php } ?>

												<?php elseif ($type == "youtube") :

                                                            if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                echo '<img src="' . $video_thumbnail . '" />';
                                                            } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                echo $video_thumbnail;
                                                            } else { ?>
                                                                <img class="youtube_image"  src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                                                            <?php } ?>

                                                <?php elseif ($type == 'soundslice') :

                                                            if ( ( $video_thumbnail = get_video_thumbnail() ) !=null ) {
                                                                echo '<img class="soundslice_image" src="' . $video_thumbnail . '" />';
                                                            } elseif ( ($video_thumbnail = get_the_post_thumbnail()) != null ) {
                                                                echo $video_thumbnail;
                                                            } else { ?>
                                                                <img class="soundslice_image" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
                                                            <?php } ?>

                                                <?php endif; ?>

												<div class="button_wrap full_width">
													<img class="play_button" src="<?php echo bloginfo('template_url'); ?>/images/play-button.png" />
												</div>
											</div>

                                            <?php if ((is_single() || is_page()) && is_user_logged_in()) {
                                                comments_template();
                                            }?>

										<?php endif; ?>
											
										<?php if ($shareLink && is_page(7)) : 
											
												$lessonLink = get_post_permalink();
										?>
										<!--<div class="share_button full_width">
												<p class="share">Share</p>
												
											</div>
											<p class="link"><?php the_field('share_link'); ?></p>
										-->
											<div class="share_buttons full_width">
												<div class="social_button_wrap">
													<a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_field('share_link'); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/icon-facebook-f.png" />Share</a>
												</div>
												<div class="social_button_wrap">
													<a class="email" href="mailto:?&subject=Awesome Bass Lesson!&body=Check%20out%20this%20bass%20lesson%20I%20found%20on%20http%3A//daricbennett.com...%0A%0A<?php echo the_field('share_link');?>"><img src="<?php echo bloginfo('template_url'); ?>/images/email-envelope.png" />Email</a>
												</div>
												<div class="social_button_wrap">
													<a target="_blank" class="page" href="<?php echo $lessonLink;?>"><img src="<?php echo bloginfo('template_url'); ?>/images/bass-headstock.png" />Lesson Page</a>
												</div>
											</div>
											
										<?php endif; ?>
									</div>
								</div>
								
							<?php endif; ?> <!-- hide -->
						
						<?php endwhile; //query loop
						
						else :
							
							echo 'no posts found';
						
						endif; // if has posts
						
						wp_reset_query();
							
					endif; ?> <!-- $sectionsField -->

				</div><!-- video_list -->
			</div><!-- .container -->
		</section>
	<?php else : 
		
		get_template_part( 'content', 'not-member' );
		
	endif; ?>
 </section>

    <div id="fancybox3">
        <img src="<?php echo bloginfo('template_url'); ?>/images/logo.png"/>
        <h2>This Lesson Is For Members Only</h2>
        <div class="button_wrap">
            <a class="button red" href="/membership-account/membership-levels/">Start My Free Trial For Full Access!</a>
        </div>
    </div>

  <?php get_footer(); ?>