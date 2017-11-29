<?php

    get_header();

    //session_start();

 	$url = $_SERVER["REQUEST_URI"];
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	$isCurrentUser = strpos($url, $username);
?>
 
 <section class="forum page_content full_width <?php if (is_user_logged_in()){ echo "member";} ?>">
	 
	 	<?php if (pmpro_hasMembershipLevel()) :  ?>
		 	
		 	<header class="sub_header full_width">
				 <div class="container">
						<h2>Bass Nation Forum</h2>
				</div><!-- .container -->
			 </header>

			 <div class="forum_wrapper full_width">

				 <div class="container">

					 <div class="forum_content">

						 <?php while ( have_posts() ) : the_post(); ?>
						 
						 	<?php if ( is_bbpress() ) : ?>
							 	
							 	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								 	
								 	<header class="entry-header">
				 
										<h1 class="entry-title"><?php the_title(); ?></h1>
										<?php if ($isCurrentUser) : ?>
												<a class="edit_link" href="/your-profile">(edit)</a>
										<?php endif; ?>
						 
									</header>
									
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
									
							 	</article>
							 	
							<?php endif; ?>
						 	
						 <?php endwhile; ?>
						 
						 <?php wp_reset_query(); ?>
					 </div>
					 
					  <?php get_sidebar(); ?>
					  
				  </div>
				  
			 </div>
			 
		<?php else :

			get_template_part( 'content', 'not-member' );

		endif; ?>
		
 </section>
 
 <?php get_footer(); ?>