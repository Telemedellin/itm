<?php
/**
 * itm functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package itm
 */

if ( is_plugin_active( 'enhanced-category-pages/enhanced-category-pages.php' ) ) {
    $options = array(
        'labels' => array(
            'not_found' => 'Sin resultados',
            'search_items' => 'Buscar plantilla',
            'add_new_item' => 'Añadir nueva',
            'view_item' => 'Ver Plantilla',
            'edit_item' => 'Editar Plantilla',
        ),
        'label' => 'Plantillas',
        'singular_label' => 'Plantilla',
        'public' => true,
        'show_ui' => true, // UI in admin panel
        '_builtin' => true, // It's a custom post type, not built in
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array("slug" => 'enhancedcategory'), // Permalinks
        'query_var' => 'enhancedcategory', // This goes to the WP_Query schema
        'supports' => array('title','editor','thumbnail','excerpt','custom-fields','comments'), // Let's use custom fields for debugging purposes only
    );

    // Register custom post types
    register_post_type('enhancedcategory', $options);

    if (function_exists('vc_set_default_editor_post_types'))
    {
        vc_set_default_editor_post_types(array(
                'enhancedcategory'
            )
        );
    }
}

function get_ecp_post($category_id = null)
{
	$ecp = new \ecp\Enhanced_Category('', 'ecp_x_category');

	if (is_null($category_id))
	{
		global $ecp_post, $ecp_category;

		$category_id	= get_query_var('cat');
		$ecp_category	= get_category($category_id);
		$ecp_post		= $ecp->get_by_category($category_id);
		$ecp_post		= $ecp_post[0];
	}
	else
	{
		$ecp_category	= get_category($category_id);
		$ecp_post		= $ecp->get_by_category($category_id);
		$ecp_post		= $ecp_post[0];

		return $ecp_post;
	}
}

add_action('admin_init', 'admin_category_stuff');
function admin_category_stuff() {
	$template_url = get_bloginfo('template_url');
	wp_register_script('admin_category_stuff_js',$template_url.'/js/admin_category_stuff_js.js');
	wp_enqueue_script('admin_category_stuff_js');
}

if ( ! function_exists( 'itm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function itm_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on itm, use a find and replace
	 * to change 'itm' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'itm', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Menú Principal', 'itm' ),
		'users-menu' => esc_html__( 'Usuarios', 'itm' ),
		'top-bar-menu' => esc_html__( 'Superior', 'itm' ),
		'footer-menu' => esc_html__( 'Pie de página', 'itm' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'itm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // itm_setup
add_action( 'after_setup_theme', 'itm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function itm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'itm_content_width', 640 );
}
add_action( 'after_setup_theme', 'itm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function itm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'itm' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Dirección', 'itm' ),
		'id'            => 'direccion',
		'description'   => 'Espacio para modificar la dirección en el pie de página',
		'before_widget' => '<div id="%1$s" class="ctn__direccion widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'itm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function itm_scripts() {
	wp_enqueue_style( 'itm-style', get_stylesheet_uri() );

	wp_enqueue_script( 'itm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'itm-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151229', true );

	wp_enqueue_script( 'itm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'itm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';