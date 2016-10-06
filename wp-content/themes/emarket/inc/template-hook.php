<?php 
/**
 * Remove javascript and css files not use
 */


/**
 * Hoo to top bar layout
 */
function emarket_fnc_topbar_layout(){
	$layout = emarket_fnc_get_header_layout();
	get_template_part( 'page-templates/parts/topbar', $layout );
	get_template_part( 'page-templates/parts/topbar', 'mobile' );
}

add_action( 'emarket_template_header_before', 'emarket_fnc_topbar_layout' );

/**
 * Hook to select header layout for archive layout
 */
function emarket_fnc_get_header_layout( $layout='' ){
	global $post; 

	$layout = $post && get_post_meta( $post->ID, 'emarket_header_layout', 1 ) ? get_post_meta( $post->ID, 'emarket_header_layout', 1 ) : emarket_fnc_theme_options( 'headerlayout' );
	 
 	if( $layout ){
 		return trim( $layout );
 	}elseif ( $layout = emarket_fnc_theme_options('header_skin','') ){
 		return trim( $layout );
 	}

	return $layout;
} 

add_filter( 'emarket_fnc_get_header_layout', 'emarket_fnc_get_header_layout' );

/**
 * Hook to select header layout for archive layout
 */
function emarket_fnc_get_footer_profile( $profile='default' ){

	global $post; 

	$profile =  $post? get_post_meta( $post->ID, 'emarket_footer_profile', 1 ):null ;

 	if ( $profile && $profile != 'global' ) {
 		return trim( $profile );
 	} elseif ( $profile = emarket_fnc_theme_options('footer-style', $profile ) ) {
 		return trim( $profile );
 	}

	return $profile;
} 

add_filter( 'emarket_fnc_get_footer_profile', 'emarket_fnc_get_footer_profile' );


/**
 * Render Custom Css Renderig by Visual composer
 */
if ( !function_exists( 'emarket_fnc_print_style_footer' ) ) {
	function emarket_fnc_print_style_footer(){
		$footer =  emarket_fnc_get_footer_profile( 'default' );
		if($footer!='default'){
			$shortcodes_custom_css = get_post_meta( $footer, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				echo '<style>
					'.$shortcodes_custom_css.'
					</style>';
			}
		}
	}
	add_action('wp_head','emarket_fnc_print_style_footer', 18);
}


/**
 * Hook to show breadscrumbs
 */
function emarket_fnc_render_breadcrumbs(){
	
	global $post;

	if( is_object($post) ){
		$disable = get_post_meta( $post->ID, 'emarket_disable_breadscrumb', 1 );  
		if(  $disable || is_front_page() ){
			return true; 
		}
		$bgimage = get_post_meta( $post->ID, 'emarket_image_breadscrumb', 1 );  
		$color 	 = get_post_meta( $post->ID, 'emarket_color_breadscrumb', 1 );  
		$bgcolor = get_post_meta( $post->ID, 'emarket_bgcolor_breadscrumb', 1 );  
		$style = array();
		if( $bgcolor  ){
			$style[] = 'background-color:'.$bgcolor;
		}
		if( $bgimage  ){ 
			$style[] = 'background-image:url(\''.wp_get_attachment_url($bgimage).'\')';
		}

		if( $color  ){ 
			$style[] = 'color:'.$color;
		}

		$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	}else {
		$estyle = ''; 
	}
	
	echo '<section id="pbr-breadscrumb" class="pbr-breadscrumb" '.$estyle.'><div class="container">';
			emarket_fnc_breadcrumbs();
	echo '</div></section>';

}

add_action( 'emarket_template_main_before', 'emarket_fnc_render_breadcrumbs' ); 

 
/**
 * Main Container
 */

function emarket_template_main_container_class( $class ){
	global $post; 
	global $emarket_wpopconfig;

	$layoutcls = get_post_meta( $post->ID, 'emarket_enable_fullwidth_layout', 1 );
	
	if( $layoutcls ) {
		$emarket_wpopconfig['layout'] = 'fullwidth';
		return 'container-fluid';
	}
	return $class;
}
add_filter( 'emarket_template_main_container_class', 'emarket_template_main_container_class', 1 , 1  );
add_filter( 'emarket_template_main_content_class', 'emarket_template_main_container_class', 1 , 1  );



/**
 * Get Configuration for Page Layout
 *
 */
function emarket_fnc_get_page_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'emarket_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'emarket_rightsidebar', 1 );

	return emarket_fnc_get_layout_configs( $left, $right );
}

add_filter( 'emarket_fnc_get_page_sidebar_configs', 'emarket_fnc_get_page_sidebar_configs', 1, 1 );


function emarket_fnc_get_single_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'emarket_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'emarket_rightsidebar', 1 );

	if ( empty( $left ) ) {
		$left  =  emarket_fnc_theme_options( 'blog-single-left-sidebar' ); 
	}

	if ( empty( $right ) ) {
		$right =  emarket_fnc_theme_options( 'blog-single-right-sidebar' ); 
	}

	return emarket_fnc_get_layout_configs( $left, $right );
}

add_filter( 'emarket_fnc_get_single_sidebar_configs', 'emarket_fnc_get_single_sidebar_configs', 1, 1 );

function emarket_fnc_get_archive_sidebar_configs( $configs='' ){

	global $post; 


	$left  =  emarket_fnc_theme_options( 'blog-archive-left-sidebar' ); 
	$right =  emarket_fnc_theme_options( 'blog-archive-right-sidebar' ); 
 	
	return emarket_fnc_get_layout_configs( $left, $right );
}

add_filter( 'emarket_fnc_get_archive_sidebar_configs', 'emarket_fnc_get_archive_sidebar_configs', 1, 1 );
add_filter( 'emarket_fnc_get_category_sidebar_configs', 'emarket_fnc_get_archive_sidebar_configs', 1, 1 );

/**
 *
 */
function emarket_fnc_get_layout_configs( $left, $right ){
	$configs = array();
	$configs['main'] = array( 'class' => 'col-lg-9 col-md-9' );

	$configs['sidebars'] = array( 
		'left'  => array( 'sidebar' => $left, 'active' => is_active_sidebar( $left ), 'class' => 'col-lg-3 col-md-3'  ),
		'right' => array( 'sidebar' => $right, 'active' => is_active_sidebar( $right ), 'class' => 'col-lg-3 col-md-3' ) 
	); 

	if( $left && $right ){
		$configs['main'] = array( 'class' => 'col-lg-6 col-md-6' );
	} elseif( empty($left) && empty($right) ){
		$configs['main'] = array( 'class' => 'col-lg-12 col-md-12' );
	}
	return $configs; 
}


function emarket_fnc_sidebars_others_configs(){
	
	global $emarket_page_layouts;
	
	return $emarket_page_layouts; 
}

add_filter("emarket_fnc_sidebars_others_configs", "emarket_fnc_sidebars_others_configs");