<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package boiler
 */
?>

	<div class="page_content full_width <?php if (is_user_logged_in()){ echo "member";} ?>">
		<?php if (pmpro_hasMembershipLevel() || is_page(27) || is_page(19) || is_page(20) || is_page(22) || is_page(335) || is_page(23) || is_page(333) || is_page(30)) : ?>
			<header>
				<?php if (is_page('member-profile')): ?>
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
		<?php else :
			
			get_template_part( 'content', 'not-member' );
		 
		 endif; ?>	
		
	</div>
	<?php edit_post_link( __( 'Edit', 'boiler' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

