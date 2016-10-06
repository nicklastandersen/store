<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}
$per_page = emarket_fnc_theme_options('woo-number-product-single', $posts_per_page);
$related = $product->get_related( $per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<div class="related widget">

		<h3 class="widget-title"><span><?php esc_html_e( 'Related Products', 'emarket' ); ?></span></h3>
		<div class="widget-content">
		<?php woocommerce_product_loop_start(); ?>

			<?php wc_get_template( 'widget-products/carousel.php',array( 'loop'=>$products,'columns_count'=> emarket_fnc_theme_options('product-number-columns', 4),'class_column'=>'', 'posts_per_page'=> $products->post_count ) ); ?>

		<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
