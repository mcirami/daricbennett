<?php
/**
 * The Header for our theme.
 *
 * @package boiler
 */

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js under_construction" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body>
	
	<section class="container">
	
		<div class="contruction_logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" /></div>
		<h1>Coming soon!</h1>
		<div class="construction_login">
			<?php 
				$args = array(
			        'echo'           => true,
			        'redirect'       => site_url( '/' ), 
			        'form_id'        => 'construction',
			        'label_username' => __( 'Username' ),
			        'label_password' => __( 'Password' ),
			        'label_remember' => __( 'Remember Me' ),
			        'label_log_in'   => __( 'Log In' ),
			        'id_username'    => 'user_login',
			        'id_password'    => 'user_pass',
			        'id_remember'    => 'rememberme',
			        'id_submit'      => 'wp-submit',
			        'remember'       => true,
			        'value_username' => NULL,
			        'value_remember' => false
				);
				wp_login_form( $args );
			?>
		</div>
	</section>
	
<?php wp_footer(); ?>

</body>
</html>
