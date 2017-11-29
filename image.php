<?php
/**
 * The template for displaying image attachments.
 *
 * @package boiler
 */

get_header();
?>
	<section>
		<?php while ( have_posts() ) : the_post(); ?>

			<article>
				<header>
					<?php the_title( '<h1>', '</h1>' ); ?>

					<div class="entry-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'boiler' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height'],
								get_permalink( $post->post_parent ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);

							edit_post_link( __( 'Edit', 'boiler' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' );
						?>
					</div>

					<nav role="navigation" id="image-navigation" class="navigation-image">
						<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'boiler' ) ); ?></div>
						<div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'boiler' ) ); ?></div>
					</nav>
				</header>

				<div>
					<div>
						<figure>
							<?php boiler_the_attached_image(); ?>
						</figure>

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
						<?php endif; ?>
					</div>

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'boiler' ),
							'after'  => '</div>',
						) );
					?>
				</div>

				<footer>
					<?php
						if ( comments_open() && pings_open() ) : // Comments and trackbacks open
							printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'boiler' ), get_trackback_url() );
						elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open
							printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'boiler' ), get_trackback_url() );
						elseif ( comments_open() && ! pings_open() ) : // Only comments open
							 _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'boiler' );
						elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed
							_e( 'Both comments and trackbacks are currently closed.', 'boiler' );
						endif;

						edit_post_link( __( 'Edit', 'boiler' ), ' <span class="edit-link">', '</span>' );
					?>
				</footer>
			</article>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>
	</section>
<?php get_footer(); ?>