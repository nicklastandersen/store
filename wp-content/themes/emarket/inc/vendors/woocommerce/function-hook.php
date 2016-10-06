<?php
/**
 * Auto config product images after the theme actived.
 */
function emarket_fnc_woocommerce_setup(){
	$catalog = array(
		'width' 	=> '465',	// px
		'height'	=> '528',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '550',	// px
		'height'	=> '625',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '90',	// px
		'height'	=> '102',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'emarket_setup_theme_actived', 'emarket_fnc_woocommerce_setup');

/**
 */
function emarket_woocommerce_enqueue_scripts() {
	wp_enqueue_script( 'emarket-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'suggest' ), '20131022', true );
}
add_action( 'wp_enqueue_scripts', 'emarket_woocommerce_enqueue_scripts' );


/**
 */
add_filter('add_to_cart_fragments',				'emarket_fnc_woocommerce_header_add_to_cart_fragment' );

function emarket_fnc_woocommerce_header_add_to_cart_fragment( $fragments ){
	global $woocommerce;

	$fragments['#cart .mini-cart-items'] =  sprintf(_n(' <span class="mini-cart-items"> %d  item</span> ', ' <span class="mini-cart-items"> %d item </span> ', $woocommerce->cart->cart_contents_count, 'emarket'), $woocommerce->cart->cart_contents_count);
 	$fragments['#cart .mini-cart-total'] = '<div class="mini-cart-total">'.trim( $woocommerce->cart->get_cart_total() ).'</div>';
    
    return $fragments;
}
add_filter( 'yith_wcwl_button_label',          'emarket_fnc_wpo_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'emarket_fnc_wpo_woocomerce_icon_wishlist_add' );

function emarket_fnc_wpo_woocomerce_icon_wishlist( $value='' ){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist','emarket').'</span>';
}

function emarket_fnc_wpo_woocomerce_icon_wishlist_add(){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist','emarket').'</span>';
}
/**
 * Mini Basket
 */
if(!function_exists('emarket_fnc_minibasket')){
    function emarket_fnc_minibasket( $style='' ){ 
        $template =  apply_filters( 'emarket_fnc_minibasket_template', emarket_fnc_get_header_layout( '' )  );  
        
      //  if( $template == 'v4' ){
        //	$template = 'v3';
     //   }
       	
        return get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
if(emarket_fnc_theme_options("woo-show-minicart",true)){
	add_action( 'emarket_template_header_right', 'emarket_fnc_minibasket', 30, 0 );
}
/******************************************************
 * 												   	  *
 * Hook functions applying in archive, category page  *
 *												      *
 ******************************************************/
function emarket_template_woocommerce_main_container_class( $class ){ 
	if( is_product() ){
		$class .= ' '.  emarket_fnc_theme_options('woocommerce-single-layout') ;
	}else if( is_product_category() || is_archive()  ){ 
		$class .= ' '.  emarket_fnc_theme_options('woocommerce-archive-layout') ;
	}
	return $class;
}

add_filter( 'emarket_template_woocommerce_main_container_class', 'emarket_template_woocommerce_main_container_class' );
function emarket_fnc_get_woocommerce_sidebar_configs( $configs='' ){

	global $post; 
	$right = null; $left = null; 

	if( is_product() ){
		
		$left  =  emarket_fnc_theme_options( 'woocommerce-single-left-sidebar' ); 
		$right =  emarket_fnc_theme_options( 'woocommerce-single-right-sidebar' );  

	}else if( is_product_category() || is_archive() ){
		$left  =  emarket_fnc_theme_options( 'woocommerce-archive-left-sidebar' ); 
		$right =  emarket_fnc_theme_options( 'woocommerce-archive-right-sidebar' ); 
	}

 
	return emarket_fnc_get_layout_configs( $left, $right );
}

add_filter( 'emarket_fnc_get_woocommerce_sidebar_configs', 'emarket_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function emarket_woocommerce_breadcrumb_defaults( $args ){
	$args['wrap_before'] = '<div class="pbr-breadscrumb"><div class="container"><ol class="pbr-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	$args['wrap_after'] = '</ol></div></div>';

	return $args;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'emarket_woocommerce_breadcrumb_defaults' );

add_action( 'emarket_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );
/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function emarket_fnc_woocommerce_after_shop_loop_start(){
	echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'emarket_fnc_woocommerce_after_shop_loop_start', 1 );

function emarket_fnc_woocommerce_after_shop_loop_after(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'emarket_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function emarket_fnc_woocommerce_before_shop_loop_start(){
	echo '<div class="products-top-wrap clearfix">';
}

function emarket_fnc_woocommerce_before_shop_loop_end(){
	echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'emarket_fnc_woocommerce_before_shop_loop_start' , 0 );
add_action( 'woocommerce_before_shop_loop', 'emarket_fnc_woocommerce_before_shop_loop_end' , 1000 );


function emarket_fnc_woocommerce_display_modes(){
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	$woo_display = emarket_fnc_theme_options( 'wc_listgrid', 'grid' );

	if ( isset($_COOKIE['emarket_woo_display']) && $_COOKIE['emarket_woo_display'] == 'list' ) {
		$woo_display = $_COOKIE['emarket_woo_display'];
	}
	
	echo '<form action="'.  $current_url  .'" class="display-mode" method="get">';
 
		echo '<button title="'.esc_html__('Grid','emarket').'" class="btn '.($woo_display == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';	
		echo '<button title="'.esc_html__( 'List', 'emarket' ).'" class="btn '.($woo_display == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';	
	echo '</form>'; 
}

add_action( 'woocommerce_before_shop_loop', 'emarket_fnc_woocommerce_display_modes' , 10 );


/**
 * Processing hook layout content
 */
function emarket_fnc_layout_main_class( $class ){
	$sidebar = emarket_fnc_theme_options( 'woo-sidebar-show', 1 ) ;
	if( is_single() ){
		$sidebar = emarket_fnc_theme_options('woo-single-sidebar-show'); ;
	}
	else {
		$sidebar = emarket_fnc_theme_options('woo-sidebar-show'); 
	}

	if( $sidebar ){
		return $class;
	}

	return 'col-lg-12 col-md-12 col-xs-12';
}
add_filter( 'emarket_woo_layout_main_class', 'emarket_fnc_layout_main_class', 4 );


/**
 *
 */
function emarket_fnc_woocommerce_archive_image(){ 
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) { 
		$thumb =  get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true ) ;

		if( $thumb ){
			$img = wp_get_attachment_image_src( $thumb, 'full' ); 
		
			echo '<p class="category-banner"><img src="'.$img[0].'""></p>'; 
		}
	}
}
add_action( 'woocommerce_archive_description', 'emarket_fnc_woocommerce_archive_image', 9 );
/**
 * Add action to init parameter before processing
 */

function emarket_fnc_before_woocommerce_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'emarket_woo_display', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['emarket_woo_display'] = trim($_GET['display']);
	}
}

add_action( 'init', 'emarket_fnc_before_woocommerce_init' );
/***************************************************
 * 												   *
 * Hook functions applying in single product page  *
 *												   *
 ***************************************************/


/** 
 * Remove review to products tabs. and display this as block below the tab.
 */
function emarket_fnc_woocommerce_product_tabs( $tabs ){

	if( isset($tabs['reviews']) ){
		unset( $tabs['reviews'] ); 
	}
	return $tabs;
}
//add_filter( 'woocommerce_product_tabs','emarket_fnc_woocommerce_product_tabs', 99 );
 
 /**
  * Rehook product review products in woocommerce_after_single_product_summary
  */
function emarket_fnc_product_reviews(){
	return comments_template();
}
//add_action('woocommerce_after_single_product_summary','emarket_fnc_product_reviews', 10 );
 


/**
 * Show/Hide related, upsells products
 */
function emarket_woocommerce_related_upsells_products($located, $template_name) {
	$options      = get_option('pbr_theme_options');
	$content_none = get_template_directory() . '/woocommerce/content-none.php';

	if ( 'single-product/related.php' == $template_name ) {
		if ( isset( $options['wc_show_related'] ) && 
			( 1 == $options['wc_show_related'] ) ) {
			$located = $content_none;
		}
	} elseif ( 'single-product/up-sells.php' == $template_name ) {
		if ( isset( $options['wc_show_upsells'] ) && 
			( 1 == $options['wc_show_upsells'] ) ) {
			$located = $content_none;
		}
	}

	return apply_filters( 'emarket_woocommerce_related_upsells_products', $located, $template_name );
}

add_filter( 'wc_get_template', 'emarket_woocommerce_related_upsells_products', 10, 2 );

/**
 * Number of products per page
 */
function emarket_woocommerce_shop_per_page($number) {
	$value = emarket_fnc_theme_options('woo-number-page', get_option('posts_per_page'));
	if ( is_numeric( $value ) && $value ) {
		$number = absint( $value );
	}
	return $number;
}

add_filter( 'loop_shop_per_page', 'emarket_woocommerce_shop_per_page' );

/**
 * Number of products per row
 */
function emarket_woocommerce_shop_columns($number) {
	$value = emarket_fnc_theme_options('wc_itemsrow', 3);
	if ( in_array( $value, array(2, 3, 4, 6) ) ) {
		$number = $value;
	}
	return $number;
}

add_filter( 'loop_shop_columns', 'emarket_woocommerce_shop_columns' );

function emarket_fnc_woocommerce_share_box() {
	if ( emarket_fnc_theme_options('wc_show_share_social', 1) ) {
		get_template_part( 'page-templates/parts/sharebox' );
	}
}
add_action( 'emarket_woocommerce_after_single_product_summary', 'emarket_fnc_woocommerce_share_box', 25 );

function emarket_fnc_woo_product_nav(){
    echo '<div class="product-nav pull-right">';

        previous_post_link('<p>%link</p>', '<i class="fa fa-angle-left"></i> Prev', FALSE); 
        next_post_link('<p>%link</p>', 'Next <i class="fa fa-angle-right"></i>', FALSE); 

    echo '</div>';
}

add_action( 'emarket_woocommerce_after_single_product_title', 'emarket_fnc_woo_product_nav', 1 );


// rating star
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'emarket_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating');


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'emarket_woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'emarket_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'emarket_woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );