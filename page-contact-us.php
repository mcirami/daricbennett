<?php
	
	/**
	 * Template Name: Contact Us
	 *
	 * The template for displaying home page.
	 *
	 *
	 * @package boiler
	 */
	 
 get_header();
  
 ?>
 
 	<section class="contact_us full_width page_content <?php if (is_user_logged_in()) { echo member;} ?>">
	 	
	 	<header class="sub_header full_width">
			 <div class="container">
					<h2><?php echo the_field('page_header'); ?></h2>
			</div><!-- .container -->
		 </header>

		<section class="top_section full_width">
			<div class="container">
				<h2><?php echo the_field('heading_text'); ?></h2>
				<p><?php echo the_field('description'); ?></p>
				<?php echo the_field('form_shortcode'); ?>
			</div>
		</section>
		<section class="bottom_section full_width">
			<div class="container">
				<div class="full_width">
					<?php if (have_rows('three_column_section')) : ?>
						<?php while (have_rows('three_column_section')) : the_row(); ?>
							<div class="column">
								<div class="icon_wrap">
									<?php $image = get_sub_field('icon'); ?>
									
									<?php if (!empty($image)): ?>
										<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt']; ?>"/>
									<?php endif; ?>
								</div>
								<div class="content_wrap">
									<h3><?php echo the_sub_field('heading'); ?></h3>
									<p><?php echo the_sub_field('description'); ?></p>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>

<?php wp_footer(); ?>
		
 <?php get_footer(); ?>