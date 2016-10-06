<?php 
class Emarket_VC_News implements Vc_Vendor_Interface  {
	
	public function load(){
		 
		$newssupported = true; 
 
			/**********************************************************************************
			 * Front Page Posts
			 **********************************************************************************/
			// front page 3
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 3', 'emarket' ),
				'base' => 'pbr_frontpageposts3',
				'icon' => 'icon-wpb-news-3',
				"category" => esc_html__('PBR News', 'emarket'),
				'description' => esc_html__( 'Create Post having blog styles', 'emarket' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'emarket' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'emarket' ),
						"admin_label" => true
					),

					 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'emarket' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'emarket' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'emarket'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'emarket' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'emarket' ),
						'value' => array( esc_html__( 'Yes, please', 'emarket' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'emarket' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'emarket' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'emarket' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'emarket' )
					)
				)
			) );

		// front page 9
		vc_map( array(
			'name' => esc_html__( '(News) FrontPage 9', 'emarket' ),
			'base' => 'pbr_frontpageposts9',
			'icon' => 'icon-wpb-news-9',
			"category" => esc_html__('PBR News', 'emarket'),
			'description' => esc_html__( 'Create Post having blog styles', 'emarket' ),
			 
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'emarket' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'emarket' ),
					"admin_label" => true
				),

				array(
					'type' => 'loop',
					'heading' => esc_html__( 'Grids content', 'emarket' ),
					'param_name' => 'loop',
					'settings' => array(
						'size' => array( 'hidden' => false, 'value' => 4 ),
						'order_by' => array( 'value' => 'date' ),
					),
					'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'emarket' )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Grid Columns", 'emarket'),
					"param_name" => "grid_columns",
					"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
					"std" => 1
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination Links', 'emarket' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'emarket' ),
					'value' => array( esc_html__( 'Yes, please', 'emarket' ) => 'yes' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'emarket' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'emarket' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'emarket' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'emarket' )
				)
			)
		) );
	}
}