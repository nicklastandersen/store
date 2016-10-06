<?php

/** Enqueue scripts and styles. */

function wp_love_store_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'wp_love_store_scripts' );


function wp_love_setup() {

// Adds the ability to use "WordPress core custom background feature" in Customizer.

    add_theme_support('custom-background', apply_filters('main_custom_background_args', array(
        'default-color' => 'fff',
        'default-image' => '',
    )));

// Adds theme support for using the theme with WooCommerce Store Plug-in.

    add_theme_support('woocommerce');

}
add_action( 'after_setup_theme', 'wp_love_setup' );


// Adds support for admin bar.

function register_admin_bar() {
    // Checks if user can manage_options, if not admin bar will not be displayed.
    if ( ! current_user_can( 'manage_options' ) ) {
        show_admin_bar( true );
    }
}
add_filter('show_admin_bar', 'register_admin_bar');

// adds support for menu in wp-admin.
add_theme_support('menus');

function register_theme_menus() {
    // This theme uses wp_nav_menu()
    register_nav_menus( array(
            'primary' => __( 'Primary Menu'),
            'social'  => __( 'Social Links Menu')
        )
    );
}
add_action('init', 'register_theme_menus' );


add_filter( 'admin_footer_text', 'wp_love_store_admin_footer_text' );

function wp_love_store_admin_footer_text( $text ) {
    /** Modify the footer text inside of the WordPress admin area. */
    return sprintf( __( 'Hey you, have a good day.' ) );
}


function main_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'shop', 'shop' ),
        'id'            => 'shop',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title title-font">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'main_widgets_init' );