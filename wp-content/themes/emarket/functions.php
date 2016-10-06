<?php
/**
 * Emarket functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */
define( 'PRESTABASE_THEME_VERSION', '1.0' );
define( 'PBR_THEME_URI', get_template_directory_uri() );
define( 'PBR_THEME_DIR', get_template_directory() );
define( 'PBR_THEME_TEMPLATE_DIR', PBR_THEME_URI.'/page-templates/' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @see emarket_fnc_content_width()
 *
 * @since Emarket 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Emarket only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'emarket_fnc_setup' ) ) :
/**
 * Emarket setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_setup() {

	/*
	 * Make Emarket available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Emarket, use a find and
	 * replace to change 'emarket' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'emarket', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
 

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'emarket-post-fullwidth', 1038, 9999, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Main menu', 'emarket' ),
		'secondary' => esc_html__( 'Menu in left sidebar', 'emarket' ),
		'topmenu'	=> esc_html__( 'Topbar Menu', 'emarket' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'emarket_fnc_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	
	// add support for display browser title
	add_theme_support( 'title-tag' );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	emarket_fnc_get_load_plugins();

}
endif; // emarket_fnc_setup
add_action( 'after_setup_theme', 'emarket_fnc_setup' );

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function emarket_pbr_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

/**
 * Get Theme Option Value.
 * @param String $name : name of prameters 
 */
function emarket_fnc_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'pbr_theme_options' ) ) ? get_option( 'pbr_theme_options' ) : null;

    
   
    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'pbr_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'pbr_theme_options_$name', $default );
}


/**
 * Function for remove srcset (WP4.4)
 *
 */
function emarket_fnc_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'emarket_fnc_disable_srcset' );



/**
 * Adjust content_width value for image attachment template.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'emarket_fnc_content_width', 810 );
}
add_action( 'after_setup_theme', 'emarket_fnc_content_width', 0 );

//Update logo wordpress 4.5

if ( version_compare( $GLOBALS['wp_version'], '4.5', '>=' ) ) {
	function emarket_fnc_setup_logo() {
	    add_theme_support( 'custom-logo' );
	}
	add_action( 'after_setup_theme', 'emarket_fnc_setup_logo' );
}



/**
 * Require function for including 3rd plugins
 *
 */
require_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );

function emarket_fnc_get_load_plugins(){

	$plugins[] =(array(
		'name'                     => esc_html__( 'MetaBox', 'emarket' ), // The plugin name
	    'slug'                     => 'meta-box', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('WooCommerce', 'emarket' ), // The plugin name
	    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));


	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp', 'emarket'), // The plugin name
	    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'emarket' ), // The plugin name
	    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'WPBakery Visual Composer', 'emarket' ), // The plugin name
	    'slug'                     => 'js_composer', // The plugin slug (typically the folder name)
	    'required'                 => true,
	    'source'                   => 'http://www.wpopal.com/thememods/js_composer.zip', // The plugin source
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'emarket' ), // The plugin name
        'slug'                     => 'revslider', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'                   => 'http://www.wpopal.com/thememods/revslider.zip', // The plugin source
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Wpopal Themer For Themes', 'emarket' ), // The plugin name
        'slug'                     => 'pbrthemer', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => 'http://www.wpopal.com/themeframework/pbrthemer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Google Web Fonts Customizer', 'emarket' ), // The plugin name
        'slug'                     => 'google-web-fonts-customizer-gwfc', // The plugin slug (typically the folder name)
        'required'                 => false ,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'YITH WooCommerce Wishlist', 'emarket' ), // The plugin name
	    'slug'                     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	tgmpa( $plugins );
}

/**
 * Register three Emarket widget areas.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_registart_widgets_sidebars() {
	 
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Sidebar Default', 'emarket' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Newsletter' , 'emarket'),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Vertical Menu' , 'emarket'),
		'id'            => 'vertical-menu',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));	

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Left Sidebar' , 'emarket'),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Right Sidebar' , 'emarket'),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Left Sidebar' , 'emarket'),
		'id'            => 'blog-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Right Sidebar', 'emarket'),
		'id'            => 'blog-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 1' , 'emarket'),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 2' , 'emarket'),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 3' , 'emarket'),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 4' , 'emarket'),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 5' , 'emarket'),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Mass Footer Body' , 'emarket'),
		'id'            => 'mass-footer-body',
		'description'   => esc_html__( 'Appears in the end of footer section of the site.', 'emarket'),
		'before_widget' => '<aside id="%1$s" class="widget-footer clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title hide"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar(
	array(
		'name'          => esc_html__( 'Header Left Sidebar', 'emarket'),
		'id'            => 'header-left-sidebar',
		'description'   => esc_html__( 'Appears in the header left section of the site.', 'emarket'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
}
add_action( 'widgets_init', 'emarket_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for Emarket.
 *
 * @since Emarket 1.0
 *
 * @return string
 */
function emarket_fnc_font_url() {
	 
	$fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lora = _x( 'on', 'Hind font: on or off', 'emarket' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'emarket' );
 
    if ( 'off' !== $lora || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $lora ) {
            $font_families[] = 'Josefin+Sans:400,700';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Poppins:400,300,500,600,700';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		 
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'emarket-open-sans', emarket_fnc_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'emarket-fa', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );

	if(isset($_GET['pbr-skin']) && $_GET['pbr-skin']) {
		$currentSkin = $_GET['pbr-skin'];
	}else{
		$currentSkin = str_replace( '.css','', emarket_fnc_theme_options('skin','default') );
	}
	if( is_rtl() ){
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'emarket-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/rtl-'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'emarket-style', get_template_directory_uri() . '/css/rtl-style.css' );
		}
	}
	else {
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'emarket-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'emarket-style', get_template_directory_uri() . '/css/style.css' );
		}	
	}	
	

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'emarket-ie', get_template_directory_uri() . '/css/ie.css', array( 'emarket-style' ), '20131205' );
	wp_style_add_data( 'emarket-ie', 'conditional', 'lt IE 9' );


	
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'featured-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'featured-slider', 'featuredSliderDefaults', array(
			'prevText' => esc_html__( 'Previous', 'emarket' ),
			'nextText' => esc_html__( 'Next', 'emarket' )
		) );
	}

	wp_enqueue_script( 'emarket-functions-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', true );

	wp_localize_script( 'ajaxurl-script', 'emarketAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	wp_enqueue_script('prettyphoto-js',	get_template_directory_uri().'/js/jquery.prettyPhoto.js');

	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');

}
add_action( 'wp_enqueue_scripts', 'emarket_fnc_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_admin_fonts() {
	wp_enqueue_style( 'emarket-lato', emarket_fnc_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'emarket_fnc_admin_fonts' );

//load file
require_once( get_template_directory() . '/inc/plugins/loader.php' );