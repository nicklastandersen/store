<?php

 /**
  * Register Woocommerce Vendor which will register list of shortcodes
  */
function emarket_fnc_init_vc_vendors(){
	
	$vendor = new Emarket_VC_News();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );


	$vendor = new Emarket_VC_Theme();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	$vendor = new Emarket_VC_Elements();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	
}
add_action( 'after_setup_theme', 'emarket_fnc_init_vc_vendors' , 99 );   

/**
 * Add parameters for row
 */
function emarket_fnc_add_params(){

 	/**
	 * add new params for row
	 */
	vc_add_param( 'vc_row', array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Parallax", 'emarket'),
	    "param_name" => "parallax",
	    "value" => array(
	        'Yes, please' => true
	    )
	));

	$row_class =  array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Background Styles', 'emarket' ),
        'param_name' => 'bgstyle',
        'description'	=> esc_html__('Use Styles Supported In Theme, Select No Use For Customizing on Tab Design Options','emarket'),
        'value' => array(
			esc_html__( 'No Use', 'emarket' ) => '',
			esc_html__( 'Background Color Primary', 'emarket' ) => 'bg-primary',
			esc_html__( 'Background Color Info', 'emarket' ) 	 => 'bg-info',
			esc_html__( 'Background Color Danger', 'emarket' )  => 'bg-danger',
			esc_html__( 'Background Color Warning', 'emarket' ) => 'bg-warning',
			esc_html__( 'Background Color Success', 'emarket' ) => 'bg-success',
			esc_html__( 'Background Color Theme', 'emarket' ) 	 => 'bg-theme',
		    esc_html__( 'Background Image 1 Dark', 'emarket' ) => 'bg-style-v1',
			esc_html__( 'Background Image 2 Dark', 'emarket' ) => 'bg-style-v2',
			esc_html__( 'Background Image 3 Blue', 'emarket' ) => 'bg-style-v3',
			esc_html__( 'Background Image 4 Red', 'emarket' ) => 'bg-style-v4',
        )
    ) ;

	vc_add_param( 'vc_row', $row_class );
	vc_add_param( 'vc_row_inner', $row_class );
 

	 vc_add_param( 'vc_row', array(
	     "type" => "dropdown",
	     "heading" => esc_html__("Is Boxed", 'emarket'),
	     "param_name" => "isfullwidth",
	     "value" => array(
	     				esc_html__('Yes, Boxed', 'emarket') => '1',
	     				esc_html__('No, Wide', 'emarket') => '0'
	     			)
	));

	vc_add_param( 'vc_row', array(
	    "type" => "textfield",
	    "heading" => esc_html__("Icon", 'emarket'),
	    "param_name" => "icon",
	    "value" => '',
		'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'emarket' )
						. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
						. esc_html__( 'here to see the list, and use class icons-lg, icons-md, icons-sm to change its size', 'emarket' ) . '</a>'
	));
	// add param for image elements

	 vc_add_param( 'vc_single_image', array(
	     "type" => "textarea",
	     "heading" => esc_html__("Image Description", 'emarket'),
	     "param_name" => "description",
	     "value" => "",
	     'priority'	
	));

	vc_add_param( 'vc_single_image', array(
	    'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'emarket' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			esc_html__( 'No', 'emarket' ) => '',
			esc_html__( 'effect v1', 'emarket' ) => 'effect-v1',
			esc_html__( 'effect v2', 'emarket' ) => 'effect-v2',
			esc_html__( 'effect v3', 'emarket' ) => 'effect-v3',
			esc_html__( 'effect v4', 'emarket' ) => 'effect-v4',
			esc_html__( 'effect v5', 'emarket' ) => 'effect-v5',
			esc_html__( 'effect v6', 'emarket' ) => 'effect-v6',
			esc_html__( 'effect v7', 'emarket' ) => 'effect-v7',
			esc_html__( 'effect v8', 'emarket' ) => 'effect-v8',
			esc_html__( 'effect v9', 'emarket' ) => 'effect-v9',
			esc_html__( 'effect v10', 'emarket' ) => 'effect-v10',
		),
		'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'emarket' ),
	));
}
add_action( 'after_setup_theme', 'emarket_fnc_add_params', 99 );
 
 /** 
  * Replace pagebuilder columns and rows class by bootstrap classes
  */
function emarket_wpo_change_bootstrap_class( $class_string,$tag ){
 
	if ($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
		$class_string = preg_replace('/vc_hidden-(\w)/', 'hidden-$1', $class_string);
		$class_string = preg_replace('/vc_col-(\w)/', 'col-$1', $class_string);
		$class_string = str_replace('wpb_column', '', $class_string);
		$class_string = str_replace('column_container', '', $class_string);
	}
	return $class_string;
}

/*add_filter( 'vc_shortcodes_css_class', 'emarket_wpo_change_bootstrap_class',10,2);*/

function emarket_fnc_set_visual_composer_footer(){

	if($options = get_option('wpb_js_content_types')){
		$check = true;
		foreach ($options as $key => $value) {
			if( $value== 'footer' ){  
				$check=false;
			}
		}
		if($check)
			$options[] =  'footer';
	}else{
		$options = array('page', 'footer');
	}

	update_option( 'wpb_js_content_types',$options );
}

		
if( in_array( 'pbrthemer/pbrthemer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	add_action('init','emarket_fnc_set_visual_composer_footer',100);

}