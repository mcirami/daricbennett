<?php
/**
 * boiler functions and definitions
 *
 * @package boiler
 */

if ( ! function_exists( 'boiler_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function boiler_setup() {

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails');

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'boiler' ),
		'mobile' => __( 'Mobile Menu', 'boiler' ),
		'members' => __( 'Members Menu', 'boiler' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	

}
endif; // boiler_setup
add_action( 'after_setup_theme', 'boiler_setup' );

// add parent class to menu items 
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'parent-item'; 
		}
	}
	
	return $items;
}

	
/* remove some of the header bloat */

// EditURI link
remove_action( 'wp_head', 'rsd_link' );
// windows live writer
remove_action( 'wp_head', 'wlwmanifest_link' );
// index link
remove_action( 'wp_head', 'index_rel_link' );
// previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// WP version
remove_action( 'wp_head', 'wp_generator' );

// remove pesky injected css for recent comments widget
//add_filter( 'wp_head', 'boiler_remove_wp_widget_recent_comments_style', 1 );
// clean up comment styles in the head
//add_action('wp_head', 'boiler_remove_recent_comments_style', 1);
// clean up gallery output in wp
add_filter('gallery_style', 'boiler_gallery_style');

// Thumbnail image sizes
// add_image_size( 'thumb-400', 400, 400, true );

add_image_size('avatar-size', 300, 300, true);

// remove injected CSS for recent comments widget
/*
function boiler_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
*/
// remove injected CSS from recent comments widget
/*
function boiler_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}
*/
// remove injected CSS from gallery
function boiler_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function boiler_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'boiler' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'boiler_widgets_init' );


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function boiler_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'boiler_javascript_detection', 0 );

/**
 * Enqueue scripts and styles
 */
function boiler_scripts_styles() {
	// style.css just initializes the theme. This is compiled from /sass
	wp_enqueue_style( 'main-style',  get_template_directory_uri() . '/css/main.min.css');
	
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.css');
	
	wp_enqueue_script( 'jquery' , array(), '', true );

	//wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', '2.6.2', true );

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-custom.js', 'custom', true );

	wp_enqueue_script( 'boiler-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20120206', true );

	//wp_enqueue_script( 'boiler-main', get_template_directory_uri() . '/js/main.js', array(), '20120205', true );
	
	// Return concatenated version of JS. If you add a new JS file add it to the concatenation queue in the gruntfile. 
	// current files: js/vendor.mordernizr-2.6.2.min.js, js/plugins.js, js/main.js

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.pack.js', array('jquery'), '', true );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/built.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'vimeo', get_template_directory_uri() . '/js/vendor/vimeothumb/jquery-vimeothumb.min.js', array('jquery'), '', true );

    wp_enqueue_script( 'vimeo', get_template_directory_uri() . '/js/vendor/emoji.min.js', array('jquery'), '', true );

    wp_localize_script('main_js', 'currentUser', array(
	   'nonce' =>  wp_create_nonce('wp_rest'),
        'siteURL' => get_site_url(),
        'userLogin' => wp_get_current_user()->user_login,
        'userID' => wp_get_current_user()->ID,
        'userEmail' => wp_get_current_user()->user_email,
        'userRole' => wp_get_current_user()->roles,
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));

}
add_action( 'wp_enqueue_scripts', 'boiler_scripts_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Auto wrap embeds with video container to make video responsive
function wrap_embed_with_div($html, $url, $attr) {
     return '<div class="video_container">' . $html . '</div>';
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);

add_filter('show_admin_bar', '__return_false');

// Hide Admin Bar for All Users Except Adminministrators
function bs_hide_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'bs_hide_admin_bar');

function pages_category() {
	register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'pages_category');

/**
* ACF Option Pages
*/

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Header');
	acf_add_options_page('Footer');
	acf_add_options_page('Popup');
}

//define("PMPRO_DEFAULT_LEVEL", "1");

/*
	Add this code to your active theme's functions.php or a custom plugin
	to change the PayPal button image on the PMPro checkout page.
*/
function my_pmpro_paypal_button_image($url)
{
	return "https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png";
}
add_filter('pmpro_paypal_button_image', 'my_pmpro_paypal_button_image');



add_action('personal_options_update', 'extra_profile_fields');
add_action('edit_user_profile_update', 'extra_profile_fields');

function extra_profile_fields($user_id) {
	
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}
	
	update_usermeta($user_id, 'bass_guitars', $_POST['bass_guitars']);
	update_usermeta($user_id, 'bass_amps', $_POST['bass_amps']);
	update_usermeta($user_id, 'experience', $_POST['experience']);
	
}

add_filter( "bbpm_get_conversation_array", function( $args ){
    if ( !bbpm_is_search_messages() ) {
        global $wpdb;
        $table = $wpdb->prefix . BBPM_TABLE;
        global $current_user;
        $pm_id = $args->last_message->PM_ID;
        $query = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT ID FROM $table WHERE PM_ID = %d AND recipient = %d AND NOT FIND_IN_SET(%d, deleted) ORDER BY ID DESC LIMIT 1",
                $pm_id,
                $current_user->ID,
                $current_user->ID
            )
        );
        if( !empty( $query[0] ) ) {
            $args->last_message = BBP_messages_message::instance()->get_message( $query[0]->ID );
        }
    }
    return $args;
}, 10);

function replace_bbpress_replies_username_filter($author_name,$reply_id ){
	$author_id = bbp_get_reply_author_id($reply_id);
	$author_object = get_userdata( $author_id );
	$author_name  = ucfirst($author_object->user_login);
	
	return $author_name;
}
add_filter( 'bbp_get_reply_author_display_name','replace_bbpress_replies_username_filter',10, 2);

function allowed_types_init() {  
    global $rtmedia;  
    $rtmedia->allowed_types['video']['extn'] = array('avi','mp4', 'mov','wmv');  
}  

add_action('init','allowed_types_init',99);

/*
function my_pmpro_after_change_membership_level($level_id, $user_id)
{
    //are they cancelling? and don't do this from admin (e.g. when admin's are changing levels)
    if(empty($level_id) && !is_admin())
        wp_logout();
}
add_action("pmpro_after_change_membership_level", "my_pmpro_after_change_membership_level", 10, 2);
*/


function redirect_wp_admin() {

if ( is_page('wp-admin') && !is_user_logged_in() ) {

wp_redirect( 'http://www.daricbennett.com/', 301 ); 
  exit;
    }
}

add_action( 'template_redirect', 'redirect_wp_admin' );

function create_post_type() {
    register_post_type( 'lessons',
        array(
            'labels' => array(
            'name' => __( 'Lessons' ),
            'singular_name' => __( 'Lesson' ),
            'add_new' => ('Add New Lesson'),
            'add_new_item' => ('Add New Lesson'),
            'edit_item' => ('Edit Lesson'),
            'new_item' => ('New Lesson'),
            'view_item' => ('View Lessons'),
            'search_items' => ('Search Lessons'),
            'not_found' => ('No Lesson found'),
            'not_found_in_trash' => ('No Lesson￼found in Trash'),
            'parent_item_colon' => ('Parent Lesson:'),
            'menu_name' => ('Lessons'),
        ),
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_icon' => get_template_directory_uri() . '/images/bass-icon.png',
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
            'rewrite' => array( 'slug' => 'free-bass-lessons' ),
            'show_in_rest' => true
        )
    );
}
add_action( 'init', 'create_post_type' );


function lessons_cat_taxonomy() {  
    register_taxonomy(  
        'category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'lessons',  //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Category',  //Display name
            'query_var' => true,
            'show_in_rest' => true,
            'show_ui'   => true,
            'show_admin_column' => true
            /*'rewrite' => array(
                'slug' => 'themes', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )*/
        )  
    );  
}  
add_action( 'init', 'lessons_cat_taxonomy');

function lessons_level_taxonomy() {  
    register_taxonomy(  
        'level',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'lessons',  //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Level',  //Display name
            'query_var' => true,
            'show_ui'   => true,
            'show_admin_column' => true,
            'show_in_rest' => true
            
            /*'rewrite' => array(
                'slug' => 'themes', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )*/
        )  
    );  
}  
add_action( 'init', 'lessons_level_taxonomy');

add_filter( 'the_content', 'make_clickable');

function autoblank($text) {
    $myurl = 'http://your-domain.com';
    $external = str_replace('href=', 'target="_blank" href=', $text);
    $external = str_replace('target="_blank" href="'.$myurl, 'href="'.$myurl, $external);
    $external = str_replace('target="_blank" href="#', 'href="#', $external);
    $external = str_replace('target = "_blank">', '>', $external);
    return $external;
}
add_filter('the_content', 'autoblank');
add_filter('bbp_get_topic_content', 'autoblank',255);
add_filter('bbp_get_reply_content', 'autoblank',255);



/**
 * Use * for origin
*/

add_action( 'rest_api_init', function() {

    remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
    add_filter( 'rest_pre_serve_request', function( $value ) {
        header( 'Access-Control-Allow-Origin: *' );
        header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
        header('content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Headers: Authorization, Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, X-WP-Nonce, cache-control, postman-token');
        return $value;

    });
}, 15 );


// define the comment_form_submit_button callback


function filter_comment_form_submit_button( $submit_button, $args ) {
    // make filter magic happen here...
    $submit_before = '<div class="comment_submit">';
    $submit_after = '<span class="loading_gif"></span></div>';
    return $submit_before . $submit_button . $submit_after;
};

// add the filter
add_filter( 'comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2 );


function my_comment_form_title($title_reply) {

    $title_reply['title_reply'] = __('Questions? Comments...get in touch!');

    return $title_reply;
}

add_filter('comment_form_defaults', 'my_comment_form_title', 10, 2);

function send_comment_notify_email() {

    $to = "matteo@mscwebservices.net";
    $subject = "You have a new comment";
    $message = "Go to the link below to Approve, Discard or Reply to comment: <br><br> https://www.daricbennett.com/wp-admin/edit-comments.php";
    $headers = "From: admin@daricbennett.com";

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if (wp_mail($to, $subject, $message, $headers)) {
            echo json_encode(array('status' => 'success', 'message' => 'Comment notification message sent.'));
            exit;
        } else {
            echo json_encode(error_get_last());
            die();
        }
    }
}

add_action("wp_ajax_send_comment_notify_email", "send_comment_notify_email");
//add_action("wp_ajax_nopriv_send_email", "send_email");

function send_reply_to_user_email() {

    $userLogin = $_POST['user'];
    $user = get_user_by('login', $userLogin);
    $userEmail = $user->user_email;
    $replyURL = $_POST['url'];

    $to = $userEmail;
    $subject = "Someone replied to your comment";
    $message = "Go to the link below to read and reply to the comment posted: <br><br>" . $replyURL;
    $headers = "From: admin@daricbennett.com";

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        sleep(20);

        if (wp_mail($to, $subject, $message, $headers)) {
            echo json_encode(array('status' => 'success', 'message' => 'Comment reply notification message sent.'));
            exit;
        } else {
            echo json_encode(error_get_last());
            die();
        }
    }
}

add_action("wp_ajax_send_reply_to_user_email", "send_reply_to_user_email");

/*

add_filter( 'wp_nav_menu_items', 'custom_mailbox_link', 10, 2 );

function custom_mailbox_link ( $items, $args ) {

    $user = wp_get_current_user();
    
    if ($items[href] == )
    
    $newLink = str_replace("--username--", $user->user_login, $atts[href]);
	$atts[href] = $newLink;

    return $atts;

}

*/
