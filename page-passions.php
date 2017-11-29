<?php
	
	/**
	 * Template Name: Passions
	 *
	 * The template for displaying home page.
	 *
	 *
	 * @package boiler
	 */
	 
 get_header();
  
 ?>
	 <section class="passions full_width page_content <?php if (is_user_logged_in()) { echo "member";} ?>">
	 	
	 	<header class="sub_header full_width">
			 <div class="container">
					<h2><?php echo the_field('page_header'); ?></h2>
			</div><!-- .container -->
		 </header>

	 	
	 	<section class="top_section full_width">
			<div class="container">
				<h2><?php echo the_field('heading_text'); ?></h2>
				<p><?php echo the_field('description' , false, false); ?></p>
			</div>
		</section>
		<section class="photo_section gray full_width">
			<div class="container">
				<div class="full_width">
					<h2><?php echo the_field('gear_heading'); ?></h2>
				</div>
				<?php if (have_rows('gear')) : ?>
					<?php while (have_rows('gear')) : the_row(); ?>
					
						<div class="row full_width">
							
						<?php if (have_rows('gear_row')) : ?>
							<?php while (have_rows('gear_row')) : the_row(); ?>
								<?php $gearImage = get_sub_field('gear_image'); ?>
							
								<div class="image_wrap">
									<a target="_blank" href="<?php echo the_sub_field('gear_link'); ?>"><img src="<?php echo $gearImage['url'] ?>" alt="<?php echo $gearImage['alt']; ?>"/></a>
									<a class="text" target="_blank" href="<?php echo the_sub_field('gear_link'); ?>">
										<h3><?php echo the_sub_field('gear_title'); ?></h3>
									</a>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
						
						</div>
						
					<?php endwhile; ?>
				<?php endif; ?>
			</div><!-- container -->
		</section>
		<section class="photo_section full_width">
			<div class="container">
				<div class="full_width">
					<h2><?php echo the_field('inspires_heading'); ?></h2>
				</div>
				<?php if (have_rows('bassists')) : ?>
					<?php while (have_rows('bassists')) : the_row(); ?>
					
						<div class="row full_width">
							
						<?php if (have_rows('bassists_row')) : ?>
							<?php while (have_rows('bassists_row')) : the_row(); ?>
								<?php $image = get_sub_field('image'); ?>
							
								<div class="image_wrap">
									<a target="_blank" href="<?php echo the_sub_field('link'); ?>"><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt']; ?>"/></a>
									<a class="text" target="_blank" href="<?php echo the_sub_field('link'); ?>">
										<h3><?php echo the_sub_field('name'); ?></h3>
									</a>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
						
						</div>
						
					<?php endwhile; ?>
				<?php endif; ?>
			</div><!-- container -->
		</section>
	 	
	 </section>
 
 <?php get_footer(); ?>