<?php
/**
 * Template Name: Home
 *
 * The template for displaying home page.
 *
 *
 * @package boiler
 */

get_header(); ?>

	<section class="home_section page_content_home">		
		<?php $heroImage = get_field('hero_image'); ?>
		<section class="hero full_width" style="background:url(<?php if(!empty($heroImage)){echo $heroImage['url'];} ?>) no-repeat">
			<div class="container">
				<div class="full_width">
					<h2><?php echo the_field('hero_title'); ?></h2>
					<h3><?php echo the_field('hero_sub_title'); ?></h3>
					
				</div>
				<div class="full_width">
					<div class="content_wrap">
						<img src="<?php echo bloginfo('template_url'); ?>/images/double-arrows.png" />
						<div class="text_wrap">
							<h4>Enter Your Email for FREE Bass Lessons</h4>
							<p><?php echo the_field('form_text'); ?></p>
						</div>
						<?php
							echo the_field('email_form_shortcode'); 
						?>
					</div>
				</div>
				
				<!--
				<iframe class="home_top" src="<?php //echo bloginfo('template_url'); ?>/signup-form.html" frameborder="0" width="654" height="200">
					<a href="http://link-to-form-on-mailchimp-site" target="_blank">Anchor text saying "click here to sign up" or something like that for people whose browsers can't read iframes</a>
				</iframe>-->
			</div>
		</section><!-- hero -->
		<section class="motto full_width">
			<div class="container">
				<div class="content full_width">
					<?php $quoteBackground = get_field('quote_section_background_image'); ?>
					<div class="content_wrap" style="background:url(<?php if(!empty($quoteBackground)){echo $quoteBackground['url']; }?>) no-repeat center center">
						<h3><?php echo the_field('quote_section'); ?></h3>
					</div>
					<div class="image_wrap">
						
						<?php $quoteImage = get_field('quote_section_image'); 
							
							if (!empty($quoteImage)) :
						?>	
								<img src="<?php echo $quoteImage['url']; ?>" alt="<?php echo $quoteImage['alt']; ?>" />
						
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section><!-- motto -->
		
		<?php $lessonsBackground =  get_field('lessons_background');?>
		<section class="lessons full_width" style="background:url(<?php if(!empty($lessonsBackground)){echo $lessonsBackground['url'];} ?>) no-repeat">
			<div class="container">
				<h2><?php echo the_field('lessons_heading'); ?></h2>
				<div class="content_wrap full_width">
					<?php $columnBackground =  get_field('lessons_column_background');?>
					
					<?php if (have_rows('lessons_text')) : ?>

						<?php while (have_rows('lessons_text')) : the_row(); ?>
							
							<div class="row full_width">
								
								<?php if (have_rows('row')) : ?>
									
									<?php while (have_rows('row')) : the_row(); ?>
										
										<div class="column" style="background:url(<?php if(!empty($columnBackground)){echo $columnBackground['url'];} ?>) no-repeat center center">
											<h3><?php the_sub_field('column_text') ?></h3>
										</div>
									
									<?php endwhile; ?>
									
								<?php endif; ?>
								
							</div>
							
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section> <!-- lessons -->
		<section class="video full_width">
			<div class="container">
				<div class="column">
					<h2><?php echo the_field('about_heading'); ?></h2>
					<p><?php echo the_field('about_text'); ?></p>
					<p class="bold desktop"><?php echo the_field('about_form_text_desktop'); ?></p>
					<p class="bold mobile"><?php echo the_field('about_form_text_mobile'); ?></p>
					<?php echo the_field('email_form_shortcode'); ?>
				<!--	<iframe class="home_bottom" src="<?php echo bloginfo('template_url'); ?>/signup-form.html" frameborder="0" width="654" height="200">
						<a href="http://link-to-form-on-mailchimp-site" target="_blank">Anchor text saying "click here to sign up" or something like that for people whose browsers can't read iframes</a>
					</iframe>-->
				</div>
				<div class="column">
					<div class="video_wrapper full_width">
						<iframe src="<?php echo the_field('about_video_link'); ?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</section>
	</section>

<?php get_footer(); ?>