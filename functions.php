<?php
require_once('inc/books-ajax-filter.php');

if ( ! function_exists( 'nwps_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function nwps_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be placed in the /languages/ directory.
		 */
		load_theme_textdomain( 'nwps', get_template_directory() . '/languages' );
		/**
		 * Add default posts and comments RSS feed links to <head>.
		 */
		add_theme_support( 'automatic-feed-links' );
		/**
		 * Enable support for post thumbnails and featured images.
		 */
		add_theme_support( 'post-thumbnails' );
		/**
		 * Enable support for Widgets
		 */

		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'nwps' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Sidebar', 'nwps' ),
			'id'            => 'sidebar-2',
			'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li></ul>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Header Sidebar', 'nwps' ),
			'id'            => 'sidebar-3',
			'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li></ul>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		/**
		 * Add support for two custom navigation menus.
		 */
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'nwps' ),
			'footer' => __('Footer Menu', 'nwps' )
		) );

		/**
		 * Custom Image Sizes
		 */
		//add_image_size( 'book-post-type-thumb', 300, 300, true );

		/**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 */
		add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
	}
	endif; // myfirsttheme_setup
	add_action( 'init', 'nwps_setup' );


/**
* Enqueue Styles and Scripts
*
*/

function nwps_scripts_enqueue() {
	// Main Stylesheet
	wp_enqueue_style( 'main-css', get_stylesheet_uri() );
	// jQuery UI Core CSS CDN
	wp_enqueue_style( 'jq-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'fontawesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css' );
	// loading the WP Default jQuery & jQuery UI Libraries
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'jquery-ui-accordion');
	wp_enqueue_script( 'jquery-ui-dialog');
	wp_enqueue_script( 'jquery-ui-datepicker');
	wp_enqueue_script( 'jquery-ui-widget');
	wp_enqueue_script( 'jquery-effects-blind');
	wp_enqueue_script( 'jquery-effects-explode');

	// Custom Javascript
	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js', array(), false, true );
	wp_enqueue_script( 'fontawesome-js', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js', array(), false, true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	wp_localize_script('script', 'wp_ajax',
		array('ajax_url' => admin_url('admin-ajax.php'))
	);

	// Apply Comments if enabled
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nwps_scripts_enqueue' );

/**
* Custom Post Types
*
*/
function nwps_book_init() {
    $labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Book', 'textdomain' ),
        'new_item'              => __( 'New Book', 'textdomain' ),
        'edit_item'             => __( 'Edit Book', 'textdomain' ),
        'view_item'             => __( 'View Book', 'textdomain' ),
        'all_items'             => __( 'All Books', 'textdomain' ),
        'search_items'          => __( 'Search Books', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
        'not_found'             => __( 'No books found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
		'menu_position'      => 4,
		'menu_icon' 		 => 'dashicons-book',
		'show_in_rest' 		 => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'category' ),
		'taxonomies'		 => array('category', 'post_tag')
    );

    register_post_type( 'book', $args );
}
add_action( 'init', 'nwps_book_init' );
