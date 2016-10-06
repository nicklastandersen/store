<?php 

class Emarket_VC_Theme implements Vc_Vendor_Interface {

	public function load(){
		/*********************************************************************************************************************
		 *  Vertical menu
		 *********************************************************************************************************************/
		$option_menu  = array(); 
		if( is_admin() ){
			$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
		    $option_menu = array('---Select Menu---'=>'');
		    foreach ($menus as $menu) {
		    	$option_menu[$menu->name]=$menu->term_id;
		    }
		}    
		vc_map( array(
		    "name" => esc_html__("PBR Quick Links Menu",'emarket'),
		    "base" => "pbr_quicklinksmenu",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    'description'	=> esc_html__( 'Show Quick Links To Access', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => 'Quick To Go'
				),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'emarket'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'emarket')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'emarket'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
				)
		   	)
		));
		 
		

		/*********************************************************************************************************************
		 *  Vertical menu
		 *********************************************************************************************************************/
	 
		vc_map( array(
		    "name" => esc_html__("PBR Vertical MegaMenu",'emarket'),
		    "base" => "pbr_verticalmenu",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => 'Vertical Menu',
					"admin_label"	=> true
				),

		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'emarket'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'emarket')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Position", 'emarket'),
					"param_name" => "postion",
					"value" => array(
							'left'=>'left',
							'right'=>'right'
						),
					'std' => 'left',
					"description" => esc_html__("Postion Menu Vertical.", 'emarket')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'emarket'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
				)
		   	)
		));
		 
		vc_map( array(
		    "name" => esc_html__("Fixed Show Vertical Menu ",'emarket'),
		    "base" => "pbr_verticalmenu_show",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "description" => esc_html__( 'Always showing vertical menu on top', 'emarket' ),
		    "params" => array(
		  
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"description" => esc_html__("When enabled vertical megamenu widget on main navition and its menu content will be showed by this module. This module will work with header:Martket, Market-V2, Market-V3" , 'emarket')
				)
		   	)
		));
	 

		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
		    "name" => esc_html__("PBR Our Team Grid Style",'emarket'),
		    "base" => "pbr_team",
		    "class" => "",
		    "description" => 'Show Personal Profile Info',
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => '',
						"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'emarket'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'emarket'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'emarket'),
					"param_name" => "information",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'emarket')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'emarket'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus", 'emarket'),
					"param_name" => "google",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'emarket'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'emarket'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest", 'emarket'),
					"param_name" => "pinterest",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'emarket'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'emarket'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'emarket'), 'vertical' => esc_html__('vertical', 'emarket') , 'horizontal' => esc_html__('horizontal', 'emarket') ),
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'emarket'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
				)
		   	)
		));
	 
		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
			"name" => esc_html__("PBR Our Team List Style",'emarket'),
			"base" => "pbr_team_list",
			"class" => "",
			"description" => esc_html__('Show Info In List Style', 'emarket'),
			"category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => '',
						"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'emarket'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'emarket'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'emarket'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Information", 'emarket'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'emarket')
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Blockquote", 'emarket'),
					"param_name" => "blockquote",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Email", 'emarket'),
					"param_name" => "email",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'emarket'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'emarket'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'emarket'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'emarket'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'emarket'), 'vertical' => esc_html__('vertical', 'emarket') , 'horizontal' => esc_html__('horizontal', 'emarket') ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'emarket'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
				)

		   	)
		));
	 
		
	 

		/* Heading Text Block
		---------------------------------------------------------- */
		vc_map( array(
			'name'        => esc_html__( 'PBR Widget Heading','emarket'),
			'base'        => 'pbr_title_heading',
			"class"       => "",
			"category" => esc_html__('PBR Widgets', 'emarket'),
			'description' => esc_html__( 'Create title for one Widget', 'emarket' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'emarket' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'emarket' ),
					'description' => esc_html__( 'Enter heading title.', 'emarket' ),
					"admin_label" => true
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'emarket' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'emarket' )
				),
				 
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'emarket' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'emarket' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'emarket' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'emarket' )
				)
			),
		));
		
		/* Heading Text Block
		---------------------------------------------------------- */
		vc_map( array(
			'name'        => esc_html__( 'PBR Banner CountDown','emarket'),
			'base'        => 'pbr_banner_countdown',
			"class"       => "",
			"category" => esc_html__('PBR Widgets', 'emarket'),
			'description' => esc_html__( 'Show CountDown with banner', 'emarket' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'emarket' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'emarket' ),
					'description' => esc_html__( 'Enter heading title.', 'emarket' ),
					"admin_label" => true
				),


				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'emarket'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'emarket' )
				),


				array(
				    'type' => 'textfield',
				    'heading' => esc_html__( 'Date Expired', 'emarket' ),
				    'param_name' => 'input_datetime',
				    'description' => esc_html__( 'Select font color', 'emarket' ),
				),
				 

				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'emarket' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'emarket' ),
				    'class'	=> 'hacongtien'
				),
				 
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'emarket' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'emarket' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'emarket' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'emarket' )
				),


				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Link', 'emarket' ),
					'param_name' => 'text_link',
					'value'		 => 'Find Out More',
					'description' => esc_html__( 'Enter your link text', 'emarket' )
				),


				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link', 'emarket' ),
					'param_name' => 'link',
					'value'		 => 'http://',
					'description' => esc_html__( 'Enter your link to redirect', 'emarket' )
				)
			),
		));


	}
}