<?php
/**
 * @package boiler
 */
?>

	<header>
		<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php boiler_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		
			<?php the_excerpt(); ?>
		
	<?php else : ?>
	<div>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boiler' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'boiler' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php endif; ?>

	<footer>
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'boiler' ) );
				if ( $categories_list && boiler_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'boiler' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'boiler' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'boiler' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'boiler' ), __( '1 Comment', 'boiler' ), __( '% Comments', 'boiler' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'boiler' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer>
