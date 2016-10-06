<?php
/*
Plugin Name: WooCommerce Disable Reviews
Plugin URI:
Description: This plugin disable WooCommerce reviews using add_filter to remove the tab completely.
Version: 1.0.0
Author: Nicklas Andersen
Author URI: https://rommel.dk/

*/

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

/**
 * Disable WooCommerce reviews.
 */
// Check if WooCommerce is active.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    add_filter( 'woocommerce_product_tabs', 'raketten_wc_remove_reviews_tab', 98);
    function raketten_wc_remove_reviews_tab($tabs) {

        unset($tabs['reviews']);

        return $tabs;
    }
}
    