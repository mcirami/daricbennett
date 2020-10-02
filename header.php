<?php
/**
 * The Header for our theme.
 *
 * @package boiler
 */

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if (isset($_GET['clickid'])) {
	$cookie_name = "daric_clickid";
	$cookie_value = $_GET['clickid'];
	setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60), "/");
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115393894-1"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-115393894-1');
	</script>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	-->
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '1092024584249788'); // Insert your pixel ID here.
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1092024584249788&ev=PageView&noscript=1"/></noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->

    <?php

        $attachment_id = get_field('og_image');
        $size = "video-thumb";
        $ogImage = wp_get_attachment_image_src( $attachment_id, $size );

        if(!empty($ogImage)) : ?>
            <meta property="og:image" content="<?php echo $ogImage[0];?>" />
            <meta property="og:image:secure_url" content="<?php echo $ogImage[0];?>" />
            <meta property="og:image:type" content="image/jpeg" />

        <?php else : ?>

	        <meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/images/og-image-bass-nation.png" />
	        <?php   if(is_single()) :

                $str = get_field('free_lesson_link');

    ?>

                <?php if (strpos($str, "youtube") !== false) :

                            $str = explode("embed/", $str);
                            $embedCode = preg_replace('/\s+/', '',$str[1]);
                ?>
                    <meta property="og:image" content="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                    <meta property="og:image:secure_url" content="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
                    <meta property="og:image:type" content="image/jpeg" />
                    <meta property="og:image:width" content="1200" />
                    <meta property="og:image:height" content="630" />

                <?php endif; //if youtube?>

            <?php endif; //is_single?>

        <?php endif; //!empty($ogImage)?>

    <?php if (get_field('lesson_description')) : ?>
        <meta property="og:description" content="<?php echo the_field('lesson_description'); ?>" />
    <?php elseif (get_field('description')) : ?>
        <meta property="og:description" content="<?php echo the_field('description'); ?>" />
    <?php endif; ?>

    <meta property="og:site_name" content="Daric Bennett Bass Lessons" />
    <meta property="og:title" content="<?php echo the_title(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $actual_link; ?>" />
    <meta property="fb:app_id" content="476725656008860" />

	<?php wp_head(); ?>

</head>

<?php
$current_user = wp_get_current_user();
$username = $current_user->user_login;
?>

<body <?php body_class(); ?>>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '476725656008860',
            xfbml      : true,
            version    : 'v2.9'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
<div class="mobile_menu cover">
	<div class="logo">
		<?php $logo = get_field('logo', 'options');
			
			if (!empty($logo)) :
		?>
				<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
		
		<?php endif; ?>
	</div>

	<?php if (is_user_logged_in()) : ?>

		<?php wp_nav_menu( array( 'theme_location' => 'members', 'container' => false, 'menu_class' => 'member_menu' ) ); // remember to assign a menu in the admin to remove the container div ?>
		
	<?php else : ?>
		<nav role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'menu_class' => 'header_menu' ) ); // remember to assign a menu in the admin to remove the container div ?>
		</nav>

	<?php endif; ?>	
</div>

	<header id="global_header">
		
		<?php if (!is_user_logged_in()) : ?>

			<div class="header_top">
				<div class="container">
					
						<?php if (have_rows('top_header', 'options')) : ?>
						
							<?php while (have_rows('top_header', 'options')) : the_row(); ?>
						
								<?php if (get_row_layout() == 'without_buttons'): ?>
								
									<div class="content_wrap">
										
										<p class="desktop"><?php echo the_sub_field('header_text_desktop', 'options'); ?>
										
											<?php if (get_sub_field('header_popup', 'options')) : ?>
											
												<a class="fancybox" href="#email_join"><?php echo the_sub_field('link_text', 'options'); ?></a>
												
											<?php else: ?>
											
												<a  href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('link_text', 'options'); ?></a>
												
											<?php endif; ?>
										</p>
										
										<p class="mobile"><?php echo the_sub_field('header_text_mobile', 'options'); ?><br>
										
											<?php if (get_sub_field('header_popup', 'options')) : ?>
											
												<a class="fancybox" href="#email_join"><?php echo the_sub_field('link_text', 'options'); ?></a>
												
											<?php else: ?>
											
												<a  href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('link_text', 'options'); ?></a>
												
											<?php endif; ?>
										
										</p>
										
									</div>
								<?php elseif( get_row_layout() == 'with_buttons'): ?>
								
										<div class="content_wrap_buttons">
											<p class="desktop"><?php echo the_sub_field('header_text_desktop', 'options'); ?><a href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('text_link', 'options'); ?></a></p>
											<p class="mobile"><?php echo the_sub_field('header_text_mobile', 'options'); ?><a href="<?php echo the_sub_field('link', 'options'); ?>"><?php echo the_sub_field('text_link', 'options'); ?></a></p>
											
											<div class="buttons">
												<div class="button_wrap">
													<a class="button white" href="<?php echo the_sub_field('white_button_link', 'options'); ?>"><?php echo the_sub_field('white_button_text', 'options'); ?></a>
												</div>
												<div class="button_wrap">
													<a class="button dark_red" href="<?php echo the_sub_field('red_button_link','options'); ?>"><?php echo the_sub_field('red_button_text', 'options')?></a>
												</div>
											</div>
										</div>
							    <?php endif;
						
						    endwhile;
						
						else : ?>

							// no layouts found
						<?php endif; ?>
						
					
				</div><!-- container -->
			</div><!-- header top -->
			
		<?php endif; ?>
		
		<div class="header_bottom <?php if(!is_front_page() && !is_page(5)){ echo "background"; } ?>">
			<?php wp_reset_query(); ?>
			<div class="container">
				<?php if (is_user_logged_in()): ?>
					<a href="/member-home"><h1 class="logo"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" /></h1></a>
				<?php else : ?>
					<a href="/"><h1 class="logo"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" /></h1></a>
				<?php endif; ?>

				<a class="mobile_menu_icon" href="#">
					<span></span>
					<span></span>
					<span></span>
				</a>
				<div class="menu">

						<nav role="navigation">

							<?php if (is_user_logged_in()): ?>
							
									<?php wp_nav_menu( array( 'theme_location' => 'members', 'container' => false, 'menu_class' => 'member_menu' ) ); // remember to assign a menu in the admin to remove the container div ?
									
							else : ?>
							
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'header_menu' ) ); // remember to assign a menu in the admin to remove the container div ?>
								
							<?php endif; ?>
							
						</nav>
				</div>
			</div>
		</div>
	</header>
<div class="wrapper">

	<?php if (!is_user_logged_in()) :?>
		<div style="display: none;" id="email_join">
			<a href="/"><div class="logo"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" /></div></a>
			<h2><?php echo the_field('heading_text', 'options'); ?></h2>
			<p><?php echo the_field('form_text', 'options'); ?></p>
			<!-- Begin Mailchimp Signup Form -->

			<div id="mc_embed_signup">
				<form action="https://daricbennett.us14.list-manage.com/subscribe/post?u=31b2e6fbc1efe1874039014fd&amp;id=08854914fe" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_31b2e6fbc1efe1874039014fd_08854914fe" tabindex="-1" value=""></div>
						<div class="g-recaptcha" data-sitekey="6Ld21OkUAAAAAKqhEA8IqH9d4Fj8SDZoKsFXj9dq"></div>
					</div>
				</form>
			</div>
			<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[3]='PMPLEVELID';ftypes[3]='number';fnames[4]='PMPLEVEL';ftypes[4]='text';fnames[8]='TABLP';ftypes[8]='text';fnames[5]='TABDL';ftypes[5]='text';fnames[6]='PMPALLIDS';ftypes[6]='text';fnames[7]='FC6';ftypes[7]='text';fnames[9]='TABDL2';ftypes[9]='text';fnames[10]='TABDL3';ftypes[10]='text';fnames[1]='TABDL4';ftypes[1]='text';fnames[2]='TABDL5';ftypes[2]='text';fnames[11]='TABDL6';ftypes[11]='text';fnames[12]='TABDL7';ftypes[12]='text';fnames[13]='TABDL8';ftypes[13]='text';fnames[14]='TABDL9';ftypes[14]='text';fnames[15]='LIVESTRMLP';ftypes[15]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
			<!--End mc_embed_signup-->

			<!--End mc_embed_signup-->



			<!-- Begin MailChimp Signup Form-->
			<!--<div id="mc_embed_signup">
				<form action="https://daricbennett.us14.list-manage.com/subscribe/post-json?u=31b2e6fbc1efe1874039014fd&amp;id=08854914fe&c=?" method="get" id="subscribe-form" name="subscribe-form" class="validate" novalidate>
				    <div id="mc_embed_signup_scroll">
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
					    real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <!--<div style="position: absolute; left: -5000px;" aria-hidden="true">
						    <input type="text" name="b_31b2e6fbc1efe1874039014fd_08854914fe" tabindex="-1" value="">
						</div>
						 <input type="submit" value="<?php //*echo the_field('button_text', 'options'); */*/?>" name="subscribe" id="mc-embedded-subscribe" class="button">
				    </div>
				</form>
				<div id="subscribe-result">

				</div>
			</div>-->
		</div>
	<?php endif; ?>
