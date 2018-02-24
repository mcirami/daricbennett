<?php
/**
 * The Template for displaying all single posts.
 *
 * @package boiler
 */

get_header(); ?>

		<article class="single_lesson full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
			
			<header class="sub_header full_width">
				<div class="container">
					<h1>Free Online Bass Lessons</h1>
				</div><!-- .container -->
			 </header>
			 
			<div class="video_section full_width">
				<section class="container">
					
					<?php while ( have_posts() ) : the_post(); ?>
			
						<?php get_template_part( 'content', 'single-lesson' ); ?>
			
						<?php boiler_content_nav( 'nav-below' ); ?>
			
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template();
						?>
			
					<?php endwhile; // end of the loop. ?>
				
				</section>
			</div>
        <?php if (!pmpro_hasMembershipLevel()) : ?>
			<div class="form_section full_width">
				<div class="container">
					<div id="email_join_single_lesson">
						<h4>Enter Your Email for FREE Bass Lessons</h4>
						<?php echo do_shortcode('[mc4wp_form id="49"]'); ?>
					</div>
				</div>
			</div>
			
			<div class="social_media_section full_width">
				<div class="image_wrap">
					<!--<img src="<?php echo bloginfo('template_url'); ?>/images/daric-single-lesson.jpg" />-->
				</div>
				<div class="text_wrap">
					<h3>Are You Ready for Full Access to Every <span>Complete lesson?</span></h3>
					<div class="button_wrap">
						<a class="button yellow" href="/membership-account/membership-levels/">Start My Full Access Free Trial Now!</a>
					</div>
					
					<?php get_template_part( 'content', 'social-media' ); ?>
					
				</div>
				
			</div>
			
			<div class="bottom_section full_width">
				<div class="container">
					<h2 class="full_width">Become A Bass Nation Member Today!</h2>
					<h3 class="full_width">Remember, with your Bass Nation Membership you will have access to:</h3>
					<div class="columns full_width">
						<div class="column">
							<ul>
								<li><p>Every Complete Lesson</p></li>
								<li><p>Full Modes Series</p></li>
								<li><p>Bass Nation Forums</p></li>
								<li><p>Bass Nation Member Directory</p></li>
								<li><p>Messaging System</p></li>
								<li><p>Live Library</p></li>
								<li><p>and so much more!</p></li>
							</ul>
						</div>
						<div class="column">
							<div class="video_wrapper full_width">
								<iframe src="https://www.youtube.com/embed/PiVqp3ZIJWs" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</div><!-- columns -->
					<h4 class="full_width">Don't Delay, Start Your Free Trial Now!</h4>
					<div class="button_wrap">
						<a class="button yellow" href="/membership-account/membership-levels/">Start My Full Access Free Trial Now!</a>
					</div>
				</div><!-- container -->
			</div><!-- bottom_section -->

        <?php endif; ?>

        </article>
		
		<?php //get_sidebar(); ?>

    <div id="members_only_video_pop">
        <img src="<?php echo bloginfo('template_url'); ?>/images/logo.png"/>
        <h2>This Lesson Is For Members Only</h2>
        <div class="button_wrap">
            <a class="button red" href="/membership-account/membership-levels/">Start My Free Trial For Full Access!</a>
        </div>
    </div>

<?php get_footer(); ?>