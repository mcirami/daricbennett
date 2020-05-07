<?php

/**
 * Template Name: Member Profile
 *
 * The template for displaying member Profile edit page.
 *
 *
 * @package boiler
 */

get_header();?>

<div class="full_width page_content member">

    <header class="sub_header full_width">
        <div class="container">
            <h1><?php the_title(); ?></h1>
		</div><!-- .container -->
    </header>

	<section class="profile_wrap">
		<div class="container">
			<div class="cover_img full_width">
				<img src="<?php echo bloginfo( 'template_url' ); ?>/images/home-bass.jpg" alt="playing bass"/>
			</div>
			<div class="avatar_wrap full_width">
				<?php echo do_shortcode('[avatar]'); ?>
			</div>
			<div class="form_wrap full_width">
				<?php echo do_shortcode('[pmpro_member_profile_edit]');?>
			</div>
			<div class="avatar_upload full_width">
				<?php echo do_shortcode('[avatar_upload]');?>
			</div>
		</div>
	</section>

</div>

<?php
	get_footer();
?>