<?php

/** Enqueue scripts and styles. */

function wp_bilstereo_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');

}
add_action( 'wp_enqueue_scripts', 'wp_bilstereo_scripts' );


function wp_bilstereo_setup() {

// Adds the ability to use "WordPress core custom background feature" in Customizer.
    add_theme_support('custom-background', apply_filters('main_custom_background_args', array(
        'default-color' => 'fff',
        'default-image' => '',
    )));

    add_theme_support( 'post-thumbnails' );

    // Adds the ability to use Post-thumbnails on Forum Post types. 
    add_theme_support( 'post-thumbnails', array( 'forum' ) );
    add_post_type_support('forum', 'thumbnail');

    //Register our sidebars and widgetized areas.
    function bilstereo_widgets_init() {
        register_sidebar( array(
            'name' => 'Footer Sidebar 1',
            'id' => 'footer-sidebar-1',
            'description' => 'Appears in the footer area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => 'Footer Sidebar 2',
            'id' => 'footer-sidebar-2',
            'description' => 'Appears in the footer area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => 'Footer Sidebar 3',
            'id' => 'footer-sidebar-3',
            'description' => 'Appears in the footer area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

    }
    add_action( 'widgets_init', 'bilstereo_widgets_init' );

}
add_action( 'after_setup_theme', 'wp_bilstereo_setup' );


// adds support for menu in wp-admin.
add_theme_support('menus');

function register_theme_menus() {
    // This theme uses wp_nav_menu()
    register_nav_menus( array(
            'primary' => __( 'Primary Menu'),
            'service-menu-logged-in'  => __( 'service menu logged in'),
            'service-menu-logged-out'  => __( 'service menu logged out'),
        )
    );
}
add_action('init', 'register_theme_menus' );
