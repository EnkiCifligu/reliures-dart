<?php
/**
 * vmagazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vmagazine
 */

/** important constants **/
$theme_ob = wp_get_theme();
$ver      = $theme_ob -> get( 'Version' );
define( 'VMAG_VER',$ver);
define( 'VMAG_URI', get_template_directory_uri() );
define( 'VMAG_DIR', get_template_directory() );
define( 'VMAG_LIB_URI', get_template_directory_uri(). '/assets/library/' );

if ( ! function_exists( 'vmagazine_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vmagazine_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on vmagazine, use a find and replace
		 * to change 'vmagazine' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vmagazine', VMAG_DIR . '/languages' );

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array( 
			'height'      => 1280,
		   	'width'       => 1920,
		   	'flex-width' => true,
   			) );


	//custom image sizes
    add_image_size( 'vmagazine-rectangle-thumb', 510, 369, true );
	add_image_size( 'vmagazine-small-thumb', 320, 224, true );
	add_image_size( 'vmagazine-single-large', 1920, 1000, true );
	add_image_size( 'vmagazine-large-category', 1200, 500, true );
	add_image_size( 'vmagazine-single-third', 1920, 500, true );
	add_image_size( 'vmagazine-archive-large', 1250, 550, true );
	add_image_size( 'vmagazine-long-thumb', 300, 423, true );
	add_image_size( 'vmagazine-small-square-thumb', 321, 257, true );
	add_image_size( 'vmagazine-large-square-thumb', 612, 588, true ); //540, 519
	add_image_size( 'vmagazine-large-square-middle', 540, 565, true );
    add_image_size( 'vmagazine-long-post-thumb', 600, 800, true );
    add_image_size( 'vmagazine-rect-post-thumb', 425, 475, true );
    add_image_size( 'vmagazine-slider-thumb', 300, 200, true );
    add_image_size( 'vmagazine-ftr-slider-thumb', 800, 448, true );    
    add_image_size( 'vmagazine-vertical-slider-thumb', 400, 340, true );
    add_image_size( 'vmagazine-rect-post-carousel', 400, 600, true );
    add_image_size( 'vmagazine-post-slider-lg', 600, 400, true );
    add_image_size( 'vmagazine-cat-post-sm', 100, 70, true );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	* Add support for gutenbert wide images
	*/
	add_theme_support('gutenberg', array(
            'wide-images' => true,
        ));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'vmagazine' ),
		'top_menu' => esc_html__( 'Top Header Menu', 'vmagazine' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'vmagazine' )
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
		'audio',
		'video',
		'gallery',
		'quote',
		'link',
	) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'vmagazine_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'vmagazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vmagazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vmagazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'vmagazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vmagazine_widgets_init() {
	
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'vmagazine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vmagazine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title-bg">',
			'after_title'   => '</span></h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'vmagazine' ),
			'id'            => 'vmagazine_left_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'vmagazine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title-bg">',
			'after_title'   => '</span></h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Header Ads Area', 'vmagazine' ),
			'id'            => 'vmagazine_header_ads_area',
			'description'   => esc_html__( 'Display selected widget beside site logo.', 'vmagazine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title-bg">',
			'after_title'   => '</span></h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Side Navigation Menu Area', 'vmagazine' ),
			'id'            => 'vmagazine_sidebar_area',
			'description'   => esc_html__( 'Add widgets to display on sidebar', 'vmagazine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title-bg">',
			'after_title'   => '</span></h4>',
		) );

	$footer_widget_regions = apply_filters( 'vmagazine_footer_widget_regions', 4 );
	
	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		
		register_sidebar( array(
			'name' 				=> sprintf( __( 'Footer Widget Area %d', 'vmagazine' ), $i ),
			'id' 				=> sprintf( 'footer-%d', $i ),
			'description' 		=> sprintf( __( ' Add Widgetized Footer Region %d.', 'vmagazine' ), $i ),
			'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h4 class="widget-title"><span class="title-bg">',
			'after_title' 		=> '</span></h4>',
		));
	}

		
}
add_action( 'widgets_init', 'vmagazine_widgets_init' );


function vmagazine_ticker_control() {
    $ticker_control_option = get_theme_mod( 'vmagazine_top_ticker_layout', 'default-layout' );
    if( $ticker_control_option == 'default-layout' ) {
        return true;
    } else {
        return false;
    }
}

/** Adding Editor Styles **/
function vmagazine_add_editor_styles() {
    add_editor_style( get_template_directory_uri().'/assets/css/custom-editor-style.css' );
}

add_action( 'admin_init', 'vmagazine_add_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function vmagazine_scripts() {
    $vmagazine_lazyload_option = get_theme_mod('vmagazine_lazyload_option','enable');
    if( $vmagazine_lazyload_option == 'enable' ){
	   wp_enqueue_script( 'jquery-lazy',VMAG_LIB_URI.'lazy-load/jquery.lazy.min.js', array( 'jquery' ), VMAG_VER, true );
    }
	wp_enqueue_script( 'jquery-mCustomScrollbar',VMAG_LIB_URI.'mCustomScrollbar/jquery.mCustomScrollbar.js', array( 'jquery' ), VMAG_VER, true );	
	wp_enqueue_script('jquery-fitvids',VMAG_URI.'/assets/js/jquery.fitvids.js',array('jquery'), VMAG_VER, true );
	wp_enqueue_script( 'vmagazine-navigation',VMAG_URI.'/assets/js/navigation.js', array(), VMAG_VER, true );
	wp_enqueue_script( 'vmagazine-skip-link-focus-fix',VMAG_URI.'/assets/js/skip-link-focus-fix.js', array(), VMAG_VER, true );
    wp_enqueue_script( 'jquery-lightslider',VMAG_LIB_URI.'lightslider/lightslider.js', array( 'jquery' ), VMAG_VER, true ); 
    wp_enqueue_script( 'jquery-wow',VMAG_URI.'/assets/js/wow.js', array( 'jquery' ), VMAG_VER, true );
    wp_enqueue_script( 'jquery-prettyphoto',VMAG_LIB_URI.'prettyPhoto/js/jquery.prettyPhoto.js', array( 'jquery' ), VMAG_VER, true );
    wp_enqueue_script( 'youtube-api',VMAG_URI.'/assets/js/iframe-api.js', array( 'jquery' ), VMAG_VER, true );
    wp_enqueue_script( 'jquery-theia-sticky-sidebar',VMAG_LIB_URI.'theia-sticky-sidebar/theia-sticky-sidebar.js', array( 'jquery' ), VMAG_VER, true );
    wp_enqueue_script( 'jquery-slick',VMAG_LIB_URI.'slick/slick.min.js', array( 'jquery' ), VMAG_VER, true );	
	wp_register_script( 'vmagazine-custom-script',VMAG_URI.'/assets/js/vmagazine-custom.js', array( 'jquery' ), VMAG_VER, true );
	
	/**
	* wp localize
	*/
	$vmagazine_sticky_header_enable = get_theme_mod('vmagazine_sticky_header_enable','show');
	$vmagazine_preloader_show = get_theme_mod('vmagazine_preloader_show','hide');
	$ticker_option = vmagazine_ticker_control();
	$vmagazine_ajax_search_enable = get_theme_mod('vmagazine_ajax_search_enable','show');
    $animation_option = get_theme_mod( 'vmagazine_wow_animation_option', 'enable' );
    $dir_url = VMAG_URI;
    $rtl_val = (is_rtl()) ? 'true' : 'false';
    
    $localize_options =  array(
        'mode'			=> $animation_option,
        'ajax_search'	=> $vmagazine_ajax_search_enable,
        'ajaxurl'		=> admin_url( 'admin-ajax.php'),
        'fileUrl'		=> $dir_url,
        'lazy'          => $vmagazine_lazyload_option,
        'controls'		=> $ticker_option,
        'rtl'           => $rtl_val,
        'preloader'		=> $vmagazine_preloader_show,
        'stickyHeader'	=> $vmagazine_sticky_header_enable
        );

    wp_localize_script( 'vmagazine-custom-script', 'vmagazine_ajax_script', $localize_options  );
    wp_enqueue_script( 'vmagazine-custom-script' );

/*===============================================================================================================================*/
    $vmagazine_font_args = array(
        'family' => 'Open+Sans:400,600,700,400italic,300|Poppins:300,400,500,600,700|Montserrat:300,300i,400,800,800i|Lato:300,400,700,900',
        );
    wp_enqueue_style( 'vmagazine-google-fonts', add_query_arg( $vmagazine_font_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'scrollbar-style',VMAG_LIB_URI.'mCustomScrollbar/jquery.mCustomScrollbar.min.css', array(), VMAG_VER );
    wp_enqueue_style( 'elegant-fonts',VMAG_LIB_URI.'elegant_font/HTML-CSS/style.css', array(), VMAG_VER );  
    wp_enqueue_style( 'lightslider-style',VMAG_LIB_URI.'lightslider/lightslider.css', array(), VMAG_VER );  
    wp_enqueue_style( 'font-awesome-style',VMAG_LIB_URI.'font-awesome/css/font-awesome.min.css', array(), VMAG_VER );
    wp_enqueue_style( 'animate-css', VMAG_URI .'/assets/css/animate.css', array(), VMAG_VER );

    wp_enqueue_style( 'prettyPhoto-style',VMAG_LIB_URI.'prettyPhoto/css/prettyPhoto.css', array(), VMAG_VER );
    wp_enqueue_style( 'slick-style',VMAG_LIB_URI.'slick/slick.css', array(), VMAG_VER );
    wp_enqueue_style( 'slick-style1',VMAG_LIB_URI.'slick/slick-theme.css', array(), VMAG_VER );
    wp_enqueue_style( 'vmagazine-style', get_stylesheet_uri(), array(), VMAG_VER );
    if( ! is_rtl() ){
        wp_enqueue_style( 'vmagazine-responsive', VMAG_URI. '/assets/css/responsive.css',array(), VMAG_VER );    
    }
    wp_style_add_data( 'vmagazine-style', 'rtl', 'replace' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vmagazine_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
add_action( 'admin_enqueue_scripts', 'vmagazine_admin_scripts' );
function vmagazine_admin_scripts( $hook ) {
    
    $vmagazine_font_args = array(
        'family' => 'Open+Sans:400,600,700,400italic,300|Poppins:300,400,500,600,700|Montserrat:300,300i,400,800,800i|Lato:300,400,700,900',
        );
    wp_enqueue_style( 'vmagazine-google-fonts', add_query_arg( $vmagazine_font_args, "//fonts.googleapis.com/css" ) );
    
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_register_script( 'of-media-uploader', VMAG_URI . '/assets/js/media-uploader.js', array('jquery'), VMAG_VER);
    wp_enqueue_script( 'of-media-uploader' );
    wp_localize_script( 'of-media-uploader', 'vmagazine_l10n', array(
        'upload' => esc_html__( 'Upload', 'vmagazine' ),
        'remove' => esc_html__( 'Remove', 'vmagazine' )
        ));

    wp_enqueue_script( 'vmagazine-admin-script', VMAG_URI .'/inc/assets/admin.js', array( 'jquery','jquery-ui-button' ), VMAG_VER, true );
    
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'wp-color-picker' );

    wp_enqueue_style( 'vmagazine-fontawesome-style',VMAG_LIB_URI.'font-awesome/css/font-awesome.min.css', array(), VMAG_VER );
    
    wp_enqueue_style( 'vmagazine-admin-style', VMAG_URI . '/inc/assets/admin.css', VMAG_VER );

    wp_enqueue_style('vmagazine-spectrum-css',VMAG_URI.'/inc/assets/spectrum/spectrum.css');
	wp_enqueue_script('vmagazine-spectrum-js', VMAG_URI . '/inc/assets/spectrum/spectrum.js',array('jquery'));
    
    //chosen
    wp_enqueue_style('chosen-css',VMAG_LIB_URI.'chosen/chosen.min.css');
	wp_enqueue_script('jquery-chosen', VMAG_LIB_URI . 'chosen/chosen.jquery.min.js',array('jquery'));
}

/**
 * Implement the Custom Header feature.
 */
require VMAG_DIR . '/inc/etc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require VMAG_DIR . '/inc/etc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require VMAG_DIR . '/inc/etc/template-functions.php';

/**
 * Customizer additions.
 */
require VMAG_DIR . '/inc/customizer/customizer.php';

/**
 * Extra Init.
 */
require VMAG_DIR . '/inc/init.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require VMAG_DIR . '/inc/etc/jetpack.php';
}
