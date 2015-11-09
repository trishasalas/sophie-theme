<?php
/**
 * Sophie Theme functions and definitions
 *
 * @package Sophie Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'sophie_setup' ) ) :

function grace_setup() {

	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'sophie', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'gallery-large', 640, 640, true );
	add_image_size( 'horizontal-slider', 603, 603, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sophie' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sophie_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // grace_setup
add_action( 'after_setup_theme', 'sophie_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function grace_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sophie' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'sophie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function grace_scripts() {

	wp_enqueue_style( 'grace-style', get_stylesheet_uri() );

	wp_enqueue_style( 'grace-raleway', 'http://fonts.googleapis.com/css?family=Raleway:400,300,200,100' );

	wp_enqueue_style( 'grace-genericons', get_template_directory_uri() . '/fonts/genericons.css' );

	wp_enqueue_script( 'grace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'grace-tiny-scrollbar', get_template_directory_uri() . '/js/jquery.tinyscrollbar.js', array( 'jquery' ), '2.1.8', false );

	wp_enqueue_script( 'grace-scrollbar', get_template_directory_uri() . '/js/scrollbar.js', array( 'grace-tiny-scrollbar' ), '1.0', true );

	wp_enqueue_script( 'grace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', false );

	wp_enqueue_script( 'grace-thickbox', get_template_directory_uri() . '/js/add-thickbox.js', array(), '1.0', true );




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sophie_scripts' );

add_action( 'wp_enqueue_scripts', 'add_thickbox' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions extended.
 */
require get_template_directory() . '/inc/extend-theme-customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';