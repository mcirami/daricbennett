<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package boiler
 */
?>

	<div class="page_content full_width <?php if (is_user_logged_in()){ echo "member";} ?>">
		<?php if (pmpro_hasMembershipLevel() || is_page('membership-checkout') || is_page('privacy') || is_page('terms-of-use') || is_page('membership-levels') || is_page('login') || is_page('logout')|| is_page('password-reset')) : ?>
			<header>
				<?php if (is_page('user')): ?>
					<h1 class="entry-titlem sub_header">Bass Nation Directory Profile</h1>
				<?php else : ?>
					<h1 class="entry-titlem sub_header"><?php the_title(); ?></h1>
				<?php endif; ?>
			</header>
			<div class="container">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'boiler' ),
						'after'  => '</div>',
					) );
				?>
			</div>

			<?php

				if(is_page('login') || is_page('password-reset')) {
					echo do_shortcode( '[bws_google_captcha]' );
				} ?>

		<?php else :
			
			get_template_part( 'content', 'not-member' );
		 
		 endif; ?>	
		
	</div>
	<?php edit_post_link( __( 'Edit', 'boiler' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

