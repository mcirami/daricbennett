<?php
	
	/**
	 * Template Name: Testimonials
	 *
	 * The template for displaying home page.
	 *
	 *
	 * @package boiler
	 */
	 
 get_header();
  
 ?>

 	<section class="testimonials full_width page_content <?php if (is_user_logged_in()) { echo "member";} ?>">
 		<header class="sub_header full_width">
			 <div class="container">
					<h2><?php the_field('page_heading'); ?></h2>
			</div><!-- .container -->
		</header>

		<section class="top_section full_width">
			<div class="container">
				<p><?php the_field('page_description'); ?></p>
			</div>
		</section>

		<div class="full_width testimonials_content">
			<div class="container">
				<div class="full_width">
					<?php if (have_rows('testimonials')) : 
						$count = 0;
					?>
						<?php while (have_rows('testimonials')) : the_row(); 
							$count++;
						?>

							<div class="row full_width">
								<div class="column_one">
									<img src="<?php echo bloginfo('template_url'); ?>/images/icon-quote-left.png" />
								</div>
								<div class="column_two">
									<p><?php the_sub_field('quote_text'); ?></p>
									<div class="full_width quote_info">
									<?php 
										$image = get_sub_field('user_image');
										$size = 'thumbnail';
										$thumb = $image['sizes'][ $size ];
										
										if (!empty($image)) :
									 ?>
											<div class="image_wrap">
												<img src="<?php echo $thumb; ?>" />
											</div>
											
										<?php endif; ?>
										<div class="text_wrap">
											<p class="name"><?php the_sub_field('user_name'); ?> <span>|</span></p><p class="date"> <?php the_sub_field('date'); ?></p>
										</div>
									</div>
								</div>
								<div class="column_three">
									<?php 
										$image = get_sub_field('user_image');
										$size = 'thumbnail';
										$thumb = $image['sizes'][ $size ];
										
										if (!empty($image)) :
									 ?>
											<img src="<?php echo $thumb; ?>" />
											
										<?php endif; ?>
								</div>
							</div><!-- row -->
							<?php if ($count % 3 == 0) : ?>
							
								<div class="button_wrap">
									<a class="button yellow" href="/membership-account/membership-checkout"><?php the_field('button_text'); ?></a>
								</div>
							
							<?php endif; ?>
							
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div><!-- container -->
		</div><!-- rows -->
 	</section>

 <?php get_footer(); ?>