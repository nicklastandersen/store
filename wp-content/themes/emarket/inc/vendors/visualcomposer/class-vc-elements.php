<?php 

class Emarket_VC_Elements implements Vc_Vendor_Interface {

	public function load(){ 
		
		/*********************************************************************************************************************
		 *  Our Service
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Featured Box",'emarket'),
		    "base" => "pbr_featuredbox",
		
		    "description"=> esc_html__('Decreale Service Info', 'emarket'),
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => '',    "admin_label" => true,
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'emarket' ),
				    'param_name' => 'title_color',
				    'description' => esc_html__( 'Select font color', 'emarket' )
				),

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Sub Title", 'emarket'),
					"param_name" => "subtitle",
					"value" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'emarket'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Default', 'emarket') => '', 
						esc_html__('Version 1', 'emarket') => 'v1', 
						esc_html__('Version 2', 'emarket') => 'v2', 
						esc_html__('Version 3', 'emarket' )=> 'v3',
						esc_html__('Version 4', 'emarket') => 'v4',
						esc_html__('Version 5', 'emarket') => 'v5'
					),
					'std' => ''
				),

				array(
					'type'                           => 'dropdown',
					'heading'                        => esc_html__( 'Title Alignment', 'emarket' ),
					'param_name'                     => 'title_align',
					'value'                          => array(
					esc_html__( 'Align left', 'emarket' )   => 'separator_align_left',
					esc_html__( 'Align center', 'emarket' ) => 'separator_align_center',
					esc_html__( 'Align right', 'emarket' )  => 'separator_align_right'
					),
					'std' => 'separator_align_left'
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'emarket'),
					"param_name" => "icon",
					"value" => 'fa fa-gear',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'emarket' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'emarket' ) . '</a>'
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Icon Color', 'emarket' ),
				    'param_name' => 'color',
				    'description' => esc_html__( 'Select font color', 'emarket' )
				),	
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background Icon', 'emarket' ),
					'param_name' => 'background',
					'value' => array(
						esc_html__( 'None', 'emarket' ) => 'nostyle',
						esc_html__( 'Success', 'emarket' ) => 'bg-success',
						esc_html__( 'Info', 'emarket' ) => 'bg-info',
						esc_html__( 'Danger', 'emarket' ) => 'bg-danger',
						esc_html__( 'Warning', 'emarket' ) => 'bg-warning',
						esc_html__( 'Light', 'emarket' ) => 'bg-default',
					),
					'std' => 'nostyle',
				),

				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'emarket'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'emarket'),
					"param_name" => "information",
					"value" => 'Your Description Here',
					'description'	=> esc_html__('Allow  put html tags', 'emarket' )
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
		 * Pricing Table
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Pricing",'emarket'),
		    "base" => "pbr_pricing",
		    "description" => esc_html__('Make Plan for membership', 'emarket' ),
		    "class" => "",
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
					"type" => "textfield",
					"heading" => esc_html__("Price", 'emarket'),
					"param_name" => "price",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'emarket'),
					"param_name" => "currency",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Period", 'emarket'),
					"param_name" => "period",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'emarket'),
					"param_name" => "subtitle",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Is Featured", 'emarket'),
					"param_name" => "featured",
					'value' 	=> array(  esc_html__('No', 'emarket') => 0,  esc_html__('Yes', 'emarket') => 1 ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Skin", 'emarket'),
					"param_name" => "skin",
					'value' 	=> array(  esc_html__('Skin 1', 'emarket') => 'v1',  esc_html__('Skin 2', 'emarket') => 'v2', esc_html__('Skin 3', 'emarket') => 'v3' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Box Style", 'emarket'),
					"param_name" => "style",
					'value' 	=> array( 'boxed' => esc_html__('Boxed', 'emarket')),
				),

				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'emarket'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'emarket')
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link Title", 'emarket'),
					"param_name" => "linktitle",
					"value" => 'SignUp',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", 'emarket'),
					"param_name" => "link",
					"value" => 'http://yourdomain.com',
					'description'	=> ''
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
		 *  PBR Counter
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Counter",'emarket'),
		    "base" => "pbr_counter",
		    "class" => "",
		    "description"=> esc_html__('Counting number with your term', 'emarket'),
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'emarket'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'emarket'),
					"param_name" => "number",
					"value" => ''
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'emarket'),
					"param_name" => "icon",
					"value" => '',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'emarket' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'emarket' ) . '</a>'
				),


				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'emarket'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'emarket' )
				),

		 

				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Color", 'emarket'),
					"param_name" => "text_color",
					'value' 	=> '',
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
		    "name" => esc_html__("PBR Socials link",'emarket'),
		    "base" => "pbr_socials_link",
		    "class" => "",
		    "description"=> esc_html__('Show socials link', 'emarket'),
		    "category" => esc_html__('PBR Widgets', 'emarket'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'emarket'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'emarket'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook Page URL", 'emarket'),
					"param_name" => "facebook_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter Page URL", 'emarket'),
					"param_name" => "twitter_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Youtube Page URL", 'emarket'),
					"param_name" => "youtube_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest Page URL", 'emarket'),
					"param_name" => "pinterest_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus Page URL", 'emarket'),
					"param_name" => "google-plus_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'emarket'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
				)
		   	)
		));
	}
}