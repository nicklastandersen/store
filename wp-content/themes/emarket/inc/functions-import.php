<?php

function emarket_fnc_import_remote_demos() { 
	return array(
		'emarket' => array( 'name' => 'emarket',  'source'=> 'http://wpsampledemo.com/emarket/emarket.zip' ),
	);
}

add_filter( 'pbrthemer_import_remote_demos', 'emarket_fnc_import_remote_demos' );



function emarket_fnc_import_theme() {
	return 'emarket';
}
add_filter( 'pbrthemer_import_theme', 'emarket_fnc_import_theme' );

function emarket_fnc_import_demos() {
	$folderes = glob( get_template_directory() .'/inc/import/*', GLOB_ONLYDIR ); 

	$output = array(); 

	foreach( $folderes as $folder ){
		$output[basename( $folder )] = basename( $folder );
	}
 	
 	return $output;
}
add_filter( 'pbrthemer_import_demos', 'emarket_fnc_import_demos' );

function emarket_fnc_import_types() {
	return array(
			'all' => 'All',
			'content' => 'Content',
			'widgets' => 'Widgets',
			'page_options' => 'Theme + Page Options',
			'menus' => 'Menus',
			'rev_slider' => 'Revolution Slider',
			'vc_templates' => 'VC Templates'
		);
}
add_filter( 'pbrthemer_import_types', 'emarket_fnc_import_types' );
