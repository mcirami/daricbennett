<?php
	/**
	 * Template Name: Member Home Page
	 *
	 * The template for displaying Member Pages.
	 *
	 *
	 * @package boiler
	 */
	 
	get_header();
	
	
 	global $current_user;
 	wp_get_current_user();
 	$username = $current_user->user_login;
 	$url = site_url();
 	
 ?>
 	
	 	<section class="page_content full_width<?php if (is_user_logged_in()){ echo " member";} ?>">
		 	
		 	<?php if (is_user_logged_in()) :  ?>
		 	
			 	<header class="sub_header full_width">
					 <div class="container">
							<h2>Home Page</h2>
					</div><!-- .container -->
				 </header>
			 	<div class="container">
				 	
				 	<div class="member_home full_width">
					 	<?php if ($current_user->user_firstname !== '') : ?>
				 			<h2> Welcome To Daric Bennett's Bass Nation, <?php echo $current_user->user_firstname; ?>!</h2>
				 		<?php else : ?>
				 			<h2>Welcome To Daric Bennett's Bass Nation!</h2>
				 		<?php endif; ?>

				 		<?php if ($username === "admin" || $username === "mat@77jef@79") : ?>
				 			<a style="text-align: center;" class="full_width" href="/wp-admin">Admin</a>
				 		<?php endif; ?>
				 		<div class="content_wrap full_width">
					 		<div class="column">
						 		<div class="heading full_width">
							 		<h3>My Profile</h3>
							 		<a href="/user">(Edit)</a>
						 		</div>
						 		<?php //echo get_avatar( $current_user->ID, 200 );
							        echo get_wp_user_avatar( $current_user->ID, 200 );
						 		?>
					 		</div>
					 		<div class="column">
						 		<div class="heading full_width">
							 		<h3>Quick Links</h3>
						 		</div>
						 		<div class="row full_width">
							 		<div class="icon_wrap">
								 		<img src="<?php echo bloginfo('template_url'); ?>/images/icon-profile.png" />
							 		</div>
							 		<div class="info_wrap account">
								 		<h4>Account</h4>
								 		<a class="button red" href="/user">Edit Profile</a>
								 		<a class="button yellow" href="/my-inbox/?fepaction=messagebox&fep-filter=inbox">My Inbox</a>
							 		</div>
						 		</div>
						 		<div class="row full_width">
							 		<div class="icon_wrap">
								 		<img src="<?php echo bloginfo('template_url'); ?>/images/icon-lessons.png" />
							 		</div>
							 		<div class="info_wrap">
								 		<h4>Instruction</h4>
								 		<a class="button red" href="/lessons">Member Lessons</a>
                                        <a class="button yellow" href="/video-q-and-a">Video Q & A</a>
							 		</div>
						 		</div>
						 		<div class="row full_width">
							 		<div class="icon_wrap forums">
								 		<img src="<?php echo bloginfo('template_url'); ?>/images/icon-forums.png" />
							 		</div>
							 		<div class="info_wrap forums">
								 		<h4>Forums</h4>
								 		<a class="button red" href="/forums">Forum Home</a>
								 		<a class="button yellow" href="<?php echo $url; ?>/forums/forum/darics-throwdown/">Daric's Throwdown</a>
							 		</div>
						 		</div>
					 		</div>
				 		</div>
				 	</div>
				 	<?php// endif; ?>
				 	
				 <?php else :
				 
				 	get_template_part( 'content', 'not-member' );
				 	
				endif; ?>
		 	</div><!-- .container -->
	 	</section>
	 
 <?php get_footer(); ?>