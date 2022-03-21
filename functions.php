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

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );


	/**
	 * Enable support for Title Tags
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'daricbennett' );

	/**
	 * Enable support for image for header
	 */
	add_theme_support( 'custom-header');

	/**
	 * Enable support for using background images or solid colors for background
	 */
	add_theme_support( 'custom-background');

	// Add support for responsive embeds.
	//add_theme_support( 'responsive-embeds' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new DaricBennett_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

	/**
	 * Enable support to make the editor content match the resulting post output in the theme, for a better user experience
	 */
	add_editor_style();
}
endif; // boiler_setup
add_action( 'after_setup_theme', 'boiler_setup' );

// Custom script loader class.
require get_template_directory() . '/classes/class-daricbennett-script-loader.php';



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

if ( function_exists( 'add_image_size' ) ) {
    add_image_size('avatar-size', 300, 300, true);
    add_image_size( 'video-thumb', 640, 360, true );
}

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
	wp_enqueue_style( 'main-style',  get_template_directory_uri() . '/css/main.min.css', array(), 6.3, 'all');
/*	wp_enqueue_style( 'override-css',  get_template_directory_uri() . '/css/override.css');*/
	
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.min.css');
	
	wp_enqueue_script( 'jquery' , array(), '', true );

	wp_enqueue_script( 'boiler-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20120206', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	wp_enqueue_script( 'fancybox_js', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/built.min.js', array('jquery'), '5.9', true );
	wp_enqueue_script( 'vimeo', get_template_directory_uri() . '/js/vendor/vimeothumb/jquery-vimeothumb.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'calendly', 'https://assets.calendly.com/assets/external/widget.js', array('jquery'), '1', true );
    //wp_enqueue_script( 'jquery_ui', get_template_directory_uri() . '/js/vendor/jquery-ui.min.js', array('jquery'), '', true );

	if (is_page('lessons') && is_user_logged_in()){

        wp_enqueue_script('filterizr', get_template_directory_uri() . '/js/vendor/jquery.filterizr.min.js', array('jquery'), '2.2.4', true);

    }


	if(is_user_logged_in()) {
		wp_localize_script( 'main_js', 'myAjaxurl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	wp_localize_script( 'main_js', 'currentPage', array(

		'pageName' => get_the_title(),
		'postType' => get_post_type(),
		'postSlug' => get_permalink(),
	) );
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

//add_filter('show_admin_bar', '__return_false');

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



//add_action('personal_options_update', 'extra_profile_fields');
//add_action('edit_user_profile_update', 'extra_profile_fields');
/*
function extra_profile_fields($user_id) {
	
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}
	
	update_usermeta($user_id, 'bass_guitars', $_POST['bass_guitars']);
	update_usermeta($user_id, 'bass_amps', $_POST['bass_amps']);
	update_usermeta($user_id, 'experience', $_POST['experience']);
	
}*/

function add_pmpro_profile_fields() {
	// Don't break if Register Helper is not loaded.
	if ( ! function_exists( 'pmprorh_add_registration_field' ) ) {
		return false;
	}

	$fields = array();
	$fields[] = new PMProRH_Field(
			'bass_guitars',
			'text',
			array(
					'label'     => 'Bass Guitar(s)',
					'profile'   => 'only',
			)
	);
	$fields[] = new PMProRH_Field(
			'bass_amps',
			'text',
			array(
					'label'     => 'Bass Amp(s)',
					'profile'   => 'only'
			)
	);

	$fields[] = new PMProRH_Field(
		'experience',
		'select',
		array(
			'label'     => 'Experience',
			'profile'   => 'only',
			'options'    => array(
					'0-2'  => '0-2 years',
					'3-5'  => '3-5 years',
					'6-10' => '6-10 years',
					'10+'  => '10+ years'
			)
		)
	);

	$fields[] = new PMProRH_Field(
		'description',
		'textarea',
		array(
			'label'     => 'About Me',
			'profile'   => 'only',
			'row'       => 5,
		)
	);

	// Add the fields into a new checkout_boxes are of the checkout page.
	foreach ( $fields as $field ) {
		pmprorh_add_registration_field(
			'just_profile',				// location on checkout page
			$field							// PMProRH_Field object
		);
	}
}

add_action('init', 'add_pmpro_profile_fields');

function allowed_types_init() {  
    global $rtmedia;  
    $rtmedia->allowed_types['video']['extn'] = array('avi','mp4', 'mov','wmv');  
}  

//add_action('init','allowed_types_init',99);


function blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) &&
	     ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}

add_action( 'init', 'blockusers_init' );

function create_lesson_post_type() {
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
add_action( 'init', 'create_lesson_post_type' );


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
        )  
    );  
}  
add_action( 'init', 'lessons_level_taxonomy');


function create_video_post_type() {
    register_post_type( 'videos',
        array(
            'labels' => array(
                'name' => __( 'Video Submit' ),
                'singular_name' => __( 'Video Submit' ),
                'add_new' => ('Add New Video'),
                'add_new_item' => ('Add New Video'),
                'edit_item' => ('Edit Video Submit'),
                'new_item' => ('New Video'),
                'view_item' => ('View Videos'),
                'search_items' => ('Search Videos'),
                'not_found' => ('No Video Submit found'),
                'not_found_in_trash' => ('No Video￼Submit found in Trash'),
                'parent_item_colon' => ('Parent Video:'),
                'menu_name' => ('Submitted Videos'),
            ),
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_icon' => get_template_directory_uri() . '/images/videos-icon.png',
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
            'rewrite' => array( 'slug' => 'video-q-and-a' ),
            'show_in_rest' => true
        )
    );
}
add_action( 'init', 'create_video_post_type' );



function create_tv_video_post_type() {
	register_post_type( 'tv-videos',
		array(
			'labels' => array(
				'name' => __( 'TV Videos' ),
				'singular_name' => __( 'TV Video' ),
				'add_new' => ('Add New Video'),
				'add_new_item' => ('Add New Video'),
				'edit_item' => ('Edit Video'),
				'new_item' => ('New Video'),
				'view_item' => ('View Videos'),
				'search_items' => ('Search TV Videos'),
				'not_found' => ('No TV Video found'),
				'not_found_in_trash' => ('No TV Video found in Trash'),
				'parent_item_colon' => ('Parent Video:'),
				'menu_name' => ('TV Videos'),
			),
			'public' => true,
			'has_archive' => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_icon' => get_template_directory_uri() . '/images/videos-icon.png',
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
			'rewrite' => array( 'slug' => 'bass-nation-tv' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'create_tv_video_post_type' );

function create_live_stream_post_type() {
    register_post_type( 'live-streams',
        array(
            'labels' => array(
                'name' => __( 'Live Streams' ),
                'singular_name' => __( 'Live Stream' ),
                'add_new' => ('Add New Stream'),
                'add_new_item' => ('Add New Stream'),
                'edit_item' => ('Edit Stream'),
                'new_item' => ('New Stream'),
                'view_item' => ('View Streams'),
                'search_items' => ('Search Streams'),
                'not_found' => ('No Stream found'),
                'not_found_in_trash' => ('No Stream found in Trash'),
                'parent_item_colon' => ('Parent Stream:'),
                'menu_name' => ('Live Streams'),
            ),
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_icon' => get_template_directory_uri() . '/images/live-stream-icon.png',
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
            'rewrite' => array( 'slug' => 'live-stream' ),
            'show_in_rest' => true
        )
    );
}
add_action( 'init', 'create_live_stream_post_type' );


function create_courses_post_type() {
	register_post_type( 'courses',
		array(
			'labels' => array(
				'name' => __( 'Courses' ),
				'singular_name' => __( 'Course' ),
				'add_new' => ('Add New Course'),
				'add_new_item' => ('Add New Course'),
				'edit_item' => ('Edit Course'),
				'new_item' => ('New Course'),
				'view_item' => ('View Courses'),
				'search_items' => ('Search Courses'),
				'not_found' => ('No Course found'),
				'not_found_in_trash' => ('No Course￼found in Trash'),
				'parent_item_colon' => ('Parent Course:'),
				'menu_name' => ('Courses'),
			),
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'hierarchical'       => true,
			'menu_icon' => get_template_directory_uri() . '/images/courses-icon.png',
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
			//'rewrite' => array( 'slug' => 'courses' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'create_courses_post_type' );


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


function my_comment_form_edits($edit_fields) {

    if (get_post_type() == "videos") {
        $title_reply = 'REPLY TO THIS THREAD';
        $label_submit = 'Post Reply';
        $title_reply_after = '<span>(you may embed a YouTube or Vimeo video link in your reply)</span>';
    } else if (get_post_type() == "live-streams"){
        $title_reply = 'CHAT LIVE';
        $label_submit = 'Submit';
        $title_reply_after = '';
    } else {
        $title_reply = 'Questions? Comments...get in touch!';
        $label_submit = 'Post Comment';
        $title_reply_after =  '<br><span>(you may embed a YouTube or Vimeo video link in your reply)</span>';
    }

    $edit_fields = array(
        'title_reply' => $title_reply,
        'title_reply_after' => $title_reply_after,
        'label_submit' => $label_submit
    );

    return $edit_fields;
}

add_filter('comment_form_defaults', 'my_comment_form_edits', 10, 2);

function send_post_author_notification($comment_ID, $comment_approved, $commentdata) {

	$postID      = $commentdata['comment_post_ID'];
	$commentAuthorEmail = $commentdata['comment_author_email'];
	$postAuthorID    = get_post_field( 'post_author', $postID );
	$postAuthorEmail = get_the_author_meta( 'user_email', $postAuthorID );
	$postURL     = get_post_permalink( $postID );
	//$commentContent = $commentdata['comment_content'];

	if(strpos($postURL, 'video-q-and-a') !== false && $commentAuthorEmail !== $postAuthorEmail) {

		$messageData = "
			<div style='background: #000; padding: 20px 20px 100px 20px; text-align: center;'>
				<img class=\"alignnone size-medium wp-image-114\" src=\"https://staging.daricbennett.com/wp-content/uploads/2016/09/logo-300x69.png\" alt=\"\" width=\"300\" height=\"69\" />
				<p style=\"color: #fff; text-align: left;\">You can read and reply to the comment here: </p><br><br>
				<a style=\"color: #ddb72e; display: block; text-align: left;\" href=\"$postURL\">$postURL</a>
			
			</div>
		";

		$to      = $postAuthorEmail;
		$subject = "Someone commented on your Video Q & A post";
		$message = $messageData;
		$headers = "From: admin@daricbennett.com";

		if ( wp_mail( $to, $subject, $message, $headers ) ) {
			return json_encode( array( 'status' => 'success', 'message' => 'Comment on author post notification sent' ) );
			//exit;
		} else {
			echo json_encode( error_get_last() );
			die();
		}
	}
}

add_action('comment_post', 'send_post_author_notification', 10, 3);

function custom_post_comment_action($location, $commentData) {
	if ( isset( $_COOKIE['clickHash'] ) ) {
		$hash = $_COOKIE['clickHash'];
	}

	$post_id = $commentData->comment_post_ID;

	if(get_post_type($post_id) == "courses" || get_post_type($post_id) == "lessons") {
		$location = $_SERVER['HTTP_REFERER'] . $hash;
	}

	return $location;
}

add_filter('comment_post_redirect', 'custom_post_comment_action', 10, 2);

function subscribe_all() {

    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (isset($_POST['subscribeall'])) {

        global $current_user;
        $user = $current_user->ID;

        $forumSubs = array();

        global $wpdb;

        $forumResults = $wpdb->get_results("SELECT meta_value FROM a02_usermeta WHERE user_id =" . $user . " AND meta_key = 'a02__bbp_forum_subscriptions'");

        if ($forumResults != null) {
            foreach ($forumResults[0] as $forumResult) {
                $forumSubs = explode(',', $forumResult);
            }
        }

        while (bbp_forums()) : bbp_the_forum();

            $forumID = bbp_get_forum_id();
            $value = false;

            $forumID = strval($forumID);

            if ($forumResults != null) {
                foreach ($forumSubs as $forumSub) {
                    if ($forumSub == $forumID) {
                        $value = true;
                        break;
                    }
                }
            }

            if ($value == false) {

                bbp_add_user_forum_subscription($user, $forumID);
            }

        endwhile;

    }

    echo '<form class="subscribe_all" method="post" action="'. $actual_link . '?subscribeall=subscribed">
        <input type="submit" name="subscribeall" value="Subscribe To All">
    </form>';


}

define('PMPRO_FAILED_PAYMENT_LIMIT', 3);


add_filter( 'fep_menu_buttons', 'fep_cus_fep_menu_buttons', 99 );

function fep_cus_fep_menu_buttons( $menu )
{
    unset( $menu['announcements'] );
    $menu['message_box']['title'] = "Inbox";
    $menu['message_box']['action'] = "messagebox&fep-filter=inbox";

    return $menu;
}


add_action('acf/save_post', 'my_save_post', 1);

function my_save_post( $post_id )
{

    // bail early if not a models post
    if (get_post_type($post_id) !== 'videos') {
        return;
    }

    // bail early if editing in admin
    if (is_admin()) {
        return;
    }

	$url = site_url();

	if (strpos($url,'test') !== false || strpos($url,'staging') !== false ) {
		$mailTo = "matteo@mscwebservices.net";
	} else {
		$mailTo = 'admin@daricbennett.com, daric@daricbennett.com';
	}

	$link = get_permalink($post_id);

	$to = $mailTo;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$subject = 'A new Q & A Video was submitted';
	$body = 'A new video was submitted to the Video Q & A section! <br><br>To view it click here:<br>' . $link;

	wp_mail( $to, $subject, $body, $headers );

	httpPost('https://', ' ');
}

function httpPost($url, $params) {

	$fields_string = array();

	foreach($params as $key => $value) {
		$fields_string .= $key . '=' . urlencode($value) . '&';
	}

	//rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	//curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch,CURLOPT_HEADER, false);
	curl_setopt($ch,CURLOPT_POST, count($fields_string));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
}

/*
 * Fire Braintree Postback on free trial signup and every payment after.
 * Save click id, transaction id, and order email into db table a02_click_id
 */
/*function fire_braintree_postback( $MemberOrder ) {

	$orderArray = json_encode($MemberOrder);

	$transactionID = $MemberOrder->subscription_transaction_id;
	$gateway = $MemberOrder->gateway;
	$levelID = $MemberOrder->membership_id;
	$orderEmail = $MemberOrder->Email;

	if ($gateway == "braintree") {

		if ( isset( $_COOKIE['daric_clickid'] ) ) {
			$clickID = $_COOKIE['daric_clickid'];
		} else {
			global $wpdb;
			$results = $wpdb->get_results( "SELECT * FROM `a02_click_id` WHERE `email` = '$orderEmail'" );
			if ( count( $results ) > 0 ) {
				$clickID = $results[0]->clickid;
			} else {
				$clickID = "";
			}
			$wpdb->flush();
		}

		if ($clickID != "") {

			global $wpdb;
			$orders           = $wpdb->get_results( "SELECT o.*, UNIX_TIMESTAMP(o.timestamp) as timestamp, l.name as membership_level_name FROM $wpdb->pmpro_membership_orders o LEFT JOIN $wpdb->pmpro_membership_levels l ON o.membership_id = l.id WHERE o.user_id = '$MemberOrder->user_id' AND o.subscription_transaction_id = '$MemberOrder->subscription_transaction_id' ORDER BY timestamp DESC" );
			$transactionCount = count( $orders );
			$wpdb->flush();

			if ( $transactionCount == 1 ) {

				$data = array(
					'id'          => 'NULL',
					'email'       => $orderEmail,
					'clickid'     => $clickID,
					'recurringid' => $transactionID,
					'timestamp'   => current_time( 'mysql', 1 )
				);

				global $wpdb;
				$wpdb->insert( 'a02_click_id', $data );
				$wpdb->flush();

				$params = array(
					"uid"      => "drbt",
					"clickid"  => $clickID,
					"function" => "free"
				);

				httpPost( "http://affiliate.daricbennett.com/", $params );

				$postback = "http://affiliate.daricbennett.com/?uid=drbt&clickid=" . $clickID . "&function=free";

				send_email( $gateway, $orderArray, $levelID, $transactionCount, $postback );
			}

			if ( $transactionCount > 1 ) {

				$params = array(
					"uid"     => "drbt",
					"clickid" => $clickID
				);

				httpPost( "http://affiliate.daricbennett.com/", $params );

				$postback = "http://affiliate.daricbennett.com/?uid=drbt&clickid=" . $clickID;
				send_email( $gateway, $orderArray, $levelID, $transactionCount, $postback );
			}
		}
	}
}
add_action( 'pmpro_added_order', 'fire_braintree_postback', 10, 1 );*/

/*
 *
 * Fire PayPal Postback on free trial signup
 * Save click id, transaction id, and order email into db table a02_click_id
 *
 * */

/*function my_pmpro_after_checkout($user_id, $morder) {

	$orderArray = json_encode($morder);

	$transactionID = $morder->subscription_transaction_id;
	$gateway = $morder->gateway;
	$orderEmail = $morder->Email;

	if ($gateway == "paypalexpress") {


		if (isset($_COOKIE['daric_clickid'])) {
			$clickID = $_COOKIE['daric_clickid'];
		} else {
			global $wpdb;
			$results = $wpdb->get_results("SELECT * FROM `a02_click_id` WHERE `email` = '$orderEmail'");
			if (count($results) > 0) {
				$clickID = $results[0]->clickid;
			} else {
				$clickID = "";
			}

			$wpdb->flush();
		}

		if ($clickID != "") {

			$data = array(
				'id'          => 'NULL',
				'email'       => $orderEmail,
				'clickid'     => $clickID,
				'recurringid' => $transactionID,
				'timestamp'   => current_time( 'mysql', 1 )
			);

			global $wpdb;
			$wpdb->insert( 'a02_click_id', $data );
			$wpdb->flush();

			$params = array(
				"uid"      => "drbt",
				"clickid"  => $clickID,
				"function" => "free"
			);

			httpPost( "http://affiliate.daricbennett.com/", $params );

			$postback = "http://affiliate.daricbennett.com/?uid=drbt&clickid=" . $clickID . "&function=free";

			$to      = "mcirami@gmail.com";
			$headers = array( 'Content-Type: text/html; charset=UTF-8' );
			$subject = "Triggered pmpro_after_checkout paypal express from functions.php";
			$body    = "user ID: " . $user_id . "<br><br> The whole array is: <br>" . $orderArray . "<br><br> transaction Id: " . $transactionID . "<br><br> gateway: " . $gateway . "<br><br> postback: " . $postback;

			wp_mail( $to, $subject, $body, $headers );
		}
	}
}

add_action('pmpro_after_checkout', 'my_pmpro_after_checkout', 10, 2);*/

/*function send_email($gateway, $array, $level, $count, $post) {
	$to = "mcirami@gmail.com";
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$subject = "Triggered function from functions.php";
	$body = "Payment gateway:" . $gateway . "<br><br> The whole array is: <br>" . $array . "<br><br>The member level is: " . $level . "<br><br> transaction count: " . $count . "<br><br> postback url: " . $post;

	wp_mail($to, $subject, $body, $headers);
}*/


function devplus_wpquery_where( $where ){
	global $current_user;

	if( is_user_logged_in() ){
		// logged in user, but are we viewing the library?
		if( isset( $_POST['action'] ) && ( $_POST['action'] == 'query-attachments' ) ){
			// here you can add some extra logic if you'd want to.
			$where .= ' AND post_author='.$current_user->data->ID;
		}
	}

	return $where;
}

add_filter( 'posts_where', 'devplus_wpquery_where' );

function get_lesson_comments() {

    $postID = $_POST['id'];
	$comments = get_comments(array('post_id' => $postID));
	wp_list_comments(array(
            'avatar_size' => 100,
            'style'       => 'ol',
            'short_ping'  => true,
            'callback' => 'boiler_comment' ), $comments);
	$args = array(
		'id_form'           => 'commentform',
		'class_form'      => 'comment-form',
		'id_submit'         => 'submit',
		'class_submit'      => 'submit',
		'name_submit'       => 'submit',
		'label_submit'      => __( 'Post Comment' ),
		'format'            => 'xhtml');
	 comment_form( $args, $postID );

	//echo $comments . comment_form( '', $postID );
}

add_action('wp_ajax_nopriv_get_lesson_comments', 'get_lesson_comments');
add_action('wp_ajax_get_lesson_comments', 'get_lesson_comments');

function get_comment_form() {

	$postID = $_POST['id'];
	$args = array(
		'id_form'           => 'commentform',
		'class_form'      => 'comment-form',
		'id_submit'         => 'submit',
		'class_submit'      => 'submit',
		'name_submit'       => 'submit',
		'title_reply'       => __( 'Leave a Reply' ),
		'label_submit'      => __( 'Post Comment' ),
		'format'            => 'xhtml');
	comment_form($args , $postID);
}

add_action('wp_ajax_nopriv_get_comment_form', 'get_comment_form');
add_action('wp_ajax_get_comment_form', 'get_comment_form');

function hash_shortcode() {
	if ( isset( $_COOKIE['clickHash'] ) ) {
		$hash = $_COOKIE['clickHash'];
	}

	$hostUrl = get_site_url();
	$hostUrl = get_site_url();

	$url = $hostUrl . "/lessons/" . $hash;

	return $url;
}

add_shortcode( 'lessonhash', 'hash_shortcode' );

function pmpro_expiration_date_shortcode( $atts ) {
    //make sure PMPro is active
    if(!function_exists('pmpro_getMembershipLevelForUser'))
        return;

    //get attributes
    $a = shortcode_atts( array(
        'user' => '',
    ), $atts );

    //find user
    if(!empty($a['user']) && is_numeric($a['user'])) {
        $user_id = $a['user'];
    } elseif(!empty($a['user']) && strpos($a['user'], '@') !== false) {
        $user = get_user_by('email', $a['user']);
        $user_id = $user->ID;
    } elseif(!empty($a['user'])) {
        $user = get_user_by('login', $a['user']);
        $user_id = $user->ID;
    } else {
        $user_id = false;
    }

    //no user ID? bail
    if(!isset($user_id))
        return;

    //get the user's level
    $level = pmpro_getMembershipLevelForUser($user_id);

    if(!empty($level) && !empty($level->enddate))
        $content = date(get_option('date_format'), $level->enddate);
    else
        $content = "---";

    return $content;
}
add_shortcode('pmpro_expiration_date', 'pmpro_expiration_date_shortcode');

add_filter('bbp_after_get_the_content_parse_args', 'add_media_button');

function add_media_button( $args ) {
	$args['media_buttons'] = true;

	return $args;
}

//add_filter('bbp_get_topic_content', 'video_embed');
//add_filter('bbp_get_reply_content', 'video_embed');
function video_embed($content){
	$linkFinal = '';
	$search = 'video';
	if (preg_match("/{$search}/i", $content)) {
		$positionStart = strpos($content, "http");
		$positionEnd = strpos($content, "\"]");
		$link = substr($content, $positionStart, $positionEnd);
		$positionEnd2 = strpos($link, "\"]");
		$linkFinal = substr($link, 0, $positionEnd2);

		$replaceStart = strpos($content, "[video");
		$replaceEnd = strpos($content, "video]");

		$replace = substr_replace($content, ' ', $replaceStart, $replaceEnd);

		$replaceStart2 = strpos($replace, "video]");
		$replaceEnd2 = strpos($replace, "]");

		$content = substr_replace($replace, ' ', $replaceStart2, $replaceEnd2);
	}

	return do_shortcode('[evp_embed_video url="' . $linkFinal . '" template="mediaelement"]') . $content;

}

function give_permissions( $allcaps, $cap, $args ) {
	$allcaps['upload_files'] = true;
	return $allcaps;
}
add_filter( 'user_has_cap', 'give_permissions', 0, 3 );


/**
 * Require user's checking out for any level that requires billing to match their IP address with billing country address fields.
 * Only works with levels that require billing fields.
 * Please install and activate the following plugin - https://wordpress.org/plugins/geoip-detect/
 */

function pmpro_require_location_match_IP($continue)
{

    global $pmpro_requirebilling;

    // If something else is wrong or billing fields aren't required, don't run this code further.
    if (!$continue || !$pmpro_requirebilling) {
        return $continue;
    }

    // If GEOIP plugin not installed, bail.
    if (!function_exists('geoip_detect2_get_info_from_current_ip')) {
        pmpro_setMessage("Unable to obtain user's location. Function 'geoip_detect2_get_info_from_current_ip' does not exist.", "pmpro_error");
        return false;
    }

    // Compare IP with billing fields.
    $ip_country = geoip_detect2_get_info_from_current_ip()->country->isoCode;
    $billing_country = isset($_REQUEST['bcountry']) ? sanitize_text_field($_REQUEST['bcountry']) : '';

    // Unable to get IP Country.
    if (empty($ip_country)) {
        pmpro_setMessage("Unable to obtain user's location.", "pmpro_error");
        return false;
    }

    // Unable to get billing field.
    if (empty($billing_country)) {
        pmpro_setMessage("Unable to get billing country field.", "pmpro_error");
        return false;
    }

    if ($ip_country == $billing_country) {
        $okay = true;
    } else {
        pmpro_setMessage("Your location does not match your billing location.", "pmpro_error");
        $okay = false;
    }

    return $okay;
}

add_filter('pmpro_registration_checks', 'pmpro_require_location_match_IP');


// Remove comment-reply.min.js from footer
function crunchify_clean_header_hook(){
	wp_deregister_script( 'comment-reply' );
}
add_action('init','crunchify_clean_header_hook');
