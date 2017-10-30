<?php
/**
 * cousateca functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cousateca
 */

add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'cousateca_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cousateca_setup() {

		load_theme_textdomain( 'cousateca', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cousateca' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'cousateca_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Image sizes
		add_image_size( 'cousa-image', 540, 9999, false ); // (cropped)
		add_image_size( 'cousa-image-list', 255, 170, true ); // (cropped)
	}
endif;
add_action( 'after_setup_theme', 'cousateca_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cousateca_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cousateca_content_width', 640 );
}
add_action( 'after_setup_theme', 'cousateca_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cousateca_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cousateca' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cousateca' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cousateca_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cousateca_scripts() {
	$template_url = get_template_directory_uri();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script("jquery");
	wp_enqueue_script("bm-custom-js", $template_url."/js/custom.js", array('jquery'), '1.0', true);
	wp_localize_script( 'bm-custom-js', 'bm_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	if(get_post_type() == 'cousa'){
		wp_enqueue_script("bm-google-map", 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCYyuykujHNOba4Egoo-QlL4qAAyPQgdeY&callback=initMap', array(), '', false);
	}
	wp_enqueue_style( 'cousateca-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bm-bootstrap',  $template_url."/css/bootstrap.min.css", array(), 	'2', 'all' );
	wp_enqueue_style( 'material-icons',  'https://fonts.googleapis.com/icon?family=Material+Icons', array(), 	'2', 'all' );
	wp_enqueue_style( 'google-font-rubik',  'https://fonts.googleapis.com/css?family=Rubik:300,400,500,700', array(), 	'2', 'all' );
	wp_enqueue_style( 'bm-custom',  $template_url."/css/custom.css", array('bm-bootstrap', 'material-icons', 'google-font-rubik'), '2', 'all' );

}
add_action( 'wp_enqueue_scripts', 'cousateca_scripts' );

/**
 * Disable emojis
 */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );
add_filter( 'emoji_svg_url', '__return_false' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}
/**
 * Requires
 */
require get_template_directory() . '/inc-functions/custom-structure.php';
require get_template_directory() . '/inc-functions/custom-cmb2.php';
require get_template_directory() . '/inc-functions/shortcodes.php';
require get_template_directory() . '/inc-functions/ajax.php';
require get_template_directory() . '/inc-functions/login.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';
