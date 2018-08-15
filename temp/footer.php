<?php
/**
 * The template for displaying the footer.
 *
 * @package boiler
 */
 
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
?>

			<footer id="global_footer" class="site_footer">
				<div class="container">
					<div class="content_wrap">
						<div class="logo">
							<a href="/"><img src="<?php echo bloginfo('template_url'); ?>/images/logo.png" /></a>
						</div>
						<div class="columns_wrap">
							<div class="column">
								<h3><?php echo the_field('first_column_heading', 'options'); ?></h3>
								<div class="menu">
									<nav role="navigation">
											<?php if (is_user_logged_in()) : ?>
									
												<?php if (have_rows('member_links_first_column', 'options')) : ?>
														<ul>
													
														<?php while (have_rows('member_links_first_column', 'options')) : the_row(); 
														
																if(get_sub_field('link_type', 'options') == "Hard Coded Link") : ?>
															
																	<li><a href="<?php echo do_shortcode('[bbpm-messages-link]'); ?>"><?php the_sub_field('link_text','options'); ?></a></li>
															
																<?php else : ?>
															
																	<li><a href="<?php the_sub_field('link', 'options'); ?>"><?php the_sub_field('link_text','options'); ?></a></li>
																
																<?php endif; ?>
															
														<?php endwhile; ?>
														
														</ul>
												<?php endif; ?>
												
											<?php else : ?>
											
												<?php if (have_rows('first_column_links', 'options')) : ?>
													<ul>
														<?php while (have_rows('first_column_links', 'options')) : the_row(); ?>
															<li><a href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('link_text', 'options'); ?></a></li>
														<?php endwhile; ?>
													</ul>
												<?php endif; ?>
												
											<?php endif; ?>
									</nav>
								</div>
							</div>
							<div class="column">
								
								<h3><?php echo the_field('second_column_heading', 'options'); ?></h3>
								
								<?php if (is_user_logged_in()) : ?>
									
									<?php if (have_rows('member_links_second_column', 'options')) : ?>
										<ul>
									
										<?php while (have_rows('member_links_second_column', 'options')) : the_row(); ?>
											
												<li><a href="<?php the_sub_field('link', 'options'); ?>"><?php the_sub_field('link_text','options'); ?></a></li>
											
										<?php endwhile; ?>
										
										</ul>
									<?php endif; ?>
									
								<?php else : ?>
								
									<ul>
										<?php if (have_rows('second_column_links', 'options')) : ?>
											
											<?php while (have_rows('second_column_links', 'options')) : the_row(); ?>
												
												<?php if (get_sub_field('popup', 'options')) : ?>
												
														<li><a class="fancybox" href="#email_join"><?php echo the_sub_field('link_text','options'); ?></a></li>
														<!--<li><a class="feather" data-featherlight="#email_join" href="#"><?php echo the_sub_field('link_text','options'); ?></a></li>-->
														
														
												<?php else: ?>
														
														<li><a href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('link_text','options'); ?></a></li>
														
												<?php endif; ?>
										
											<?php endwhile; ?>
										<?php endif; ?>
										
									</ul>
									
								<?php endif; ?>
								
							</div>
							<div class="column">
								<h3><?php echo the_field('third_column_heading', 'options'); ?></h3>
								<!--<p class="white">E:<a href="mailto:daric@daricbennett.com">Daric@DaricBennett.com</a></p>-->
								<div class="icon_wrap">
									
									<?php if (have_rows('third_column_links', 'options')) : ?>
									
										<?php while (have_rows('third_column_links', 'options')) : the_row(); ?>
										
											<div class="row">
												
												<?php $socialIcon = get_sub_field('social_icon','options'); 
													  $socialText = strtolower(get_sub_field('social_text', 'options'));
												?>

												<a class="<?php if ( $socialText == "facebook"){echo "facebook";} elseif ($socialText == "instagram"){ echo "instagram";} elseif ($socialText == "youtube") {echo "youtube";}?>" target="_blank" href="<?php echo the_sub_field('social_link','options'); ?>">
													<?php if (!empty($socialIcon)) : ?>
														<img src="<?php echo $socialIcon['url']; ?>" />
													<?php endif; ?>
														<h3><?php echo the_sub_field('social_text','options'); ?></h3>
												</a>
												
											</div>
											
										<?php endwhile; ?>
										
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php if (have_rows('bottom_copy', 'options')) : ?>
						<div class="copy">
							<ul>
								<?php while (have_rows('bottom_copy', 'options')) : the_row(); ?>
								
									<?php $link = get_sub_field('add_link', 'options');	
										if($link) : 
									?>
										<li><a href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('text', 'options'); ?></a></li>
									<?php else : ?>
										<li><p><?php echo the_sub_field('text', 'options'); ?></p></li>
									<?php endif; ?>
									
								<?php endwhile; ?>

							</ul>
                            <?php $number = get_field('phone_number', 'options');
                                  $number = preg_replace('/[^A-Za-z0-9\-]/', '', $number);
                                  $number = str_replace('-', '', $number);
                            ?>
                            <ul>
                                <li><p><?php the_field('address', 'options'); ?></p></li>
                                <li><a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a></li>
                                <li><a href="tel:+1<?php echo $number; ?>"><?php the_field('phone_number', 'options'); ?></a></li>
                            </ul>
						</div>
					<?php endif; ?>
				</div><!-- .container -->
			</footer>

			<?php wp_footer(); ?>
		</div><!-- wrapper -->

		<?php if (!pmpro_hasMembershipLevel() && !is_page(27) && !is_page(30) && !is_page(19)) : ?>
			<script>
				jQuery(document).ready(function($){
					var popup = getCookie("popup");
					var subscribed = getCookie("subscribed");
					var subscribedForm = getCookie("subscribed_form");
					var lpSubscribed = getCookie("lp-subscribed");
					var subscribedMember = getCookie("subscribed-member");
					
					setTimeout(function() {
						
						if (!$('#email_join').hasClass('active') && popup == "" && subscribed == "" && subscribedForm == "" && lpSubscribed == "" && subscribedMember == "") {
							
							$.fancybox({
								arrows: false,
								autoSize: false,
								width: '750',
								height: '410',
								closeBtn: true,
								scrolling: 'hidden',
								scrollOutside: false,
								href: '#email_join',
								beforeShow  :function(){
						            	$("body").css({'overflow-y':'hidden'});
						            },
						        afterClose :function(){
						            	$("body").css({'overflow-y':'visible'});
						            },
						        helpers: {
						            overlay: {
						                locked: true
						            }
						        }
							});
							
							$('#email_join').addClass('active');
							createCookie("popup", "popped", 1);
				
						} }, 15000);
					
					
					function getCookie(cname) {
					    var name = cname + "=";
					    var ca = document.cookie.split(';');
					    for(var i = 0; i <ca.length; i++) {
					        var c = ca[i];
					        while (c.charAt(0)==' ') {
					            c = c.substring(1);
					        }
					        if (c.indexOf(name) == 0) {
					            return c.substring(name.length,c.length);
					        }
					    }
					    return "";
					}
					
					function createCookie(name, value, days) {
					    var expires;
					    if (days) {
					        var date = new Date();
					        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					        expires = "; expires=" + date.toGMTString();
					    }
					    else {
					        expires = "";
					    }
					    document.cookie = name + "=" + value + expires + "; path=/";
					}
				});	
			</script>
			
		<?php endif; ?>
		<div id="media_upload_wait">
			<div class="text_wrap">
				 <h2>Your Media is Uploading....</h2>
				 <h3>The page will refresh when it's complete, please be patient!</h3>
			 </div>
		 </div>

        <input type="hidden" id="ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>"/>

        <div class="keyboard_popup">
            <div class="iframe_wrap">
                <div class="close_button">
                    <img src="<?php echo bloginfo('template_url'); ?>/images/close-button.png"/>
                </div>
                <iframe src="" frameborder="0"></iframe>
            </div>

        </div>

	</body>
</html>