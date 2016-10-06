<?php 
if( class_exists("WPBakeryShortCode") ){
	/**
	 * Class Emarket_VC_Woocommerces
	 *
	 */
	class Emarket_VC_Woocommerce  implements Vc_Vendor_Interface  {

		public function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->name,
				'value' => $term->slug,
				'group_id' => $term->taxonomy,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'emarket' ),
			);
		}
		/**
		 * register and mapping shortcodes
		 */
		public function product_category_field_search( $search_string ) {
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = $this->vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
		

		public function product_category_render($query) {  
			$category = get_term_by('slug', (int)$query['value'], 'product_cat');
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->term_id;
				$data['label'] = $category->slug;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}

		/**
		 * register and mapping shortcodes
		 */
		public function load(){  

			$shortcodes = array( 'pbr_categoriestabs', 'pbr_products', 'pbr_products_collection' ); 

			foreach( $shortcodes as $shortcode ){
				add_filter( 'vc_autocomplete_'. $shortcode .'_categories_callback', array($this, 'product_category_field_search'), 10, 1 );
			 	add_filter( 'vc_autocomplete_'. $shortcode .'_categories_render', array($this, 'product_category_render'), 10, 1 );
			}


			$order_by_values = array(
				'',
				esc_html__( 'Date', 'emarket' ) => 'date',
				esc_html__( 'ID', 'emarket' ) => 'ID',
				esc_html__( 'Author', 'emarket' ) => 'author',
				esc_html__( 'Title', 'emarket' ) => 'title',
				esc_html__( 'Modified', 'emarket' ) => 'modified',
				esc_html__( 'Random', 'emarket' ) => 'rand',
				esc_html__( 'Comment count', 'emarket' ) => 'comment_count',
				esc_html__( 'Menu order', 'emarket' ) => 'menu_order',
			);

			$order_way_values = array(
				'',
				esc_html__( 'Descending', 'emarket' ) => 'DESC',
				esc_html__( 'Ascending', 'emarket' ) => 'ASC',
			);
			$product_categories_dropdown = array('none'=> esc_html__('None', 'emarket') );
			$block_styles = emarket_fnc_get_widget_block_styles();
			
			$product_columns_deal = array(1, 2, 3, 4);

			if( is_admin() ){
					$args = array(
						'type' => 'post',
						'child_of' => 0,
						'parent' => '',
						'orderby' => 'name',
						'order' => 'ASC',
						'hide_empty' => false,
						'hierarchical' => 1,
						'exclude' => '',
						'include' => '',
						'number' => '',
						'taxonomy' => 'product_cat',
						'pad_counts' => false,

					);

					$categories = get_categories( $args );
					emarket_fnc_woocommerce_getcategorychilds( 0, 0, $categories, 0, $product_categories_dropdown );
					
			}
		    vc_map( array(
		        "name" => esc_html__("PBR Product Deals",'emarket'),
		        "base" => "pbr_product_deals",
		        "class" => "",
		    	"category" => esc_html__('PBR Woocommerce','emarket'),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'emarket' ),
		        "params" => array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title','emarket'),
		                "param_name" => "title",
		            ),

		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'emarket'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'emarket'),
		                "param_name" => "number",
		                'std' => '1',
		                "description" => esc_html__("", 'emarket')
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Columns count",'emarket'),
		                "param_name" => "columns_count",
		                "value" => $product_columns_deal,
		                'std' => '2',
		                "description" => esc_html__("Select columns count.",'emarket')
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Layout",'emarket'),
		                "param_name" => "layout",
		                "value" => array(esc_html__('Carousel', 'emarket') => 'carousel', esc_html__('Grid', 'emarket') =>'grid' ),
		                "admin_label" => true,
		                "description" => esc_html__("Select columns count.",'emarket')
		            )
		        )
		    ));
		   

			vc_map( array(
		        "name" => esc_html__("PBR Timing Deals",'emarket'),
		        "base" => "pbr_timing_deals",
		        "class" => "",
		    	"category" => esc_html__('PBR Woocommerce','emarket'),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'emarket' ),
		        "params" => array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title','emarket'),
		                "param_name" => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Desciption','emarket'),
		                "param_name" => "description",
		                "admin_label" => false
		            ),
		             array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'End Date', 'emarket' ),
					    'param_name' => 'input_datetime',
					    'description' => esc_html__( 'Enter Date Count down', 'emarket' ),
					    "value" => ""

					),
		             array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Columns count",'emarket'),
		                "param_name" => "columns_count",
		                "value" => array(6,5,4,3,2,1),
		                "admin_label" => false,
		                "description" => esc_html__("Select columns count.",'emarket')
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'emarket'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
		            )

		            
		        )
		    ));
	 
		    //// 
		    vc_map( array(
		        "name" => esc_html__( "PBR Products On Sale", 'emarket' ),
		        "base" => "pbr_products_onsale",
		        "class" => "",
		    	"category" => esc_html__( 'PBR Woocommerce', 'emarket' ),
		    	'description'	=> esc_html__( 'Display Products Sales With Pagination', 'emarket' ),
		        "params" => array(
		            array(
		                "type" 		  => "textfield",
		                "class" 	  => "",
		                "heading" 	  => esc_html__( 'Title','emarket' ),
		                "param_name"  => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'emarket'),
		                "param_name" => "number",
		                'std' => '9',
		                "description" => esc_html__("", 'emarket'),
		                  "admin_label" => true
		            ),
		             array(
		                "type" 		  => "dropdown",
		                "heading" 	  => esc_html__( "Columns count",'emarket' ),
		                "param_name"  => "columns_count",
		                "value" 	  => array(6,5,4,3,2,1),
		                "admin_label" => false,
		                "description" => esc_html__( "Select columns count.",'emarket' )
		            ),

		            array(
		                "type" 		  => "textfield",
		                "heading" 	  => esc_html__( "Extra class name", 'emarket' ),
		                "param_name"  => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'emarket')
		            )
		        )
		    ));
		  
			/**
			 * pbr_productcategory
			 */
		 

			$product_layout = array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel', 'Special'=>'special', 'List-v1' => 'list-v1');
			$product_type = array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' );
			$product_columns = array(6 ,5 ,4 , 3, 2, 1);
			$show_tab = array(
			                array('recent', esc_html__('Latest Products', 'emarket')),
			                array( 'featured_product', esc_html__('Featured Products', 'emarket' )),
			                array('best_selling', esc_html__('BestSeller Products', 'emarket' )),
			                array('top_rate', esc_html__('TopRated Products', 'emarket' )),
			                array('on_sale', esc_html__('Special Products', 'emarket' ))
			            );

			vc_map( array(
			    "name" => esc_html__("PBR Product Category",'emarket'),
			    "base" => "pbr_productcategory",
			    "class" => "",
			 "category" => esc_html__('PBR Woocommerce','emarket'),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special','emarket' ), 
			    "params" => array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'emarket'),
						"param_name" => "title",
						"value" =>''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'emarket'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style",'emarket'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'emarket'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count",'emarket'),
						"param_name" => "columns_count",
						"value" => array(6, 5, 4, 3, 2, 1),
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon",'emarket'),
						"param_name" => "icon"
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles",'emarket'),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'emarket'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));
			 
			vc_map( array(
			    "name" => esc_html__("PBR Products Category Index",'emarket'),
			    "base" => "pbr_productcategory_index",
			    "class" => "",
				 "category" => esc_html__('PBR Woocommerce','emarket'),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special','emarket' ), 
			    "params" => array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'emarket'),
						"param_name" => "title",
						"value" =>''
					),

					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'emarket'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style",'emarket'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'emarket'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count",'emarket'),
						"param_name" => "columns_count",
						"value" => array(6, 5, 4, 3, 2, 1),
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles",'emarket'),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon",'emarket'),
						"param_name" => "icon",
						'value'	=> 'fa-gear'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'emarket'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));
			 
			/**
			* pbr_category_filter
			*/
		 
			vc_map( array(
					"name"     => esc_html__("PBR Product Categories Filter",'emarket'),
					"base"     => "pbr_category_filter",
					'description' => esc_html__( 'Show images and links of sub categories in block','emarket' ),
					"class"    => "",
					"category" => esc_html__('PBR Woocommerce','emarket'),
					"params"   => array(

					array(
						"type" => "dropdown",
						"heading" => esc_html__('Category', 'emarket'),
						"param_name" => "term_id",
						"value" =>$product_categories_dropdown,	"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'emarket'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'emarket') => '', 
							esc_html__('style 1', 'emarket') => 'style1',
						),
						'std' => ''
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),

					array(
						"type"       => "textfield",
						"heading"    => esc_html__("Number of categories to show",'emarket'),
						"param_name" => "number",
						"value"      => '5',

					),

					array(
						"type"        => "textfield",
						"heading"     => esc_html__("Extra class name",'emarket'),
						"param_name"  => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));

			/**
			 * pbr_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Products",'emarket'),
			    "base" => "pbr_products",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'emarket' ),
			    "class" => "",
			   "category" => esc_html__('PBR Woocommerce','emarket'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title",'emarket'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'emarket' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'emarket' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type",'emarket'),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style",'emarket'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count",'emarket'),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'emarket'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'emarket'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));
			 

			/**
			 * pbr_all_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Products Tabs",'emarket'),
			    "base" => "pbr_tabs_products",
			    'description'	=> esc_html__( 'Display BestSeller, TopRated ... Products In tabs', 'emarket' ),
			    "class" => "",
			   "category" => esc_html__('PBR Woocommerce','emarket'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title",'emarket'),
						"param_name" => "title",
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
					array(
			            "type" => "sorted_list",
			            "heading" => esc_html__("Show Tab", "emarket"),
			            "param_name" => "show_tab",
			            "description" => esc_html__("Control teasers look. Enable blocks and place them in desired order.", 'emarket'),
			            "value" => "recent,featured_product,best_selling",
			            "options" => $show_tab
			        ),
			        array(
						"type" => "dropdown",
						"heading" => esc_html__("Style",'emarket'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'emarket'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count",'emarket'),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'emarket'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));

			vc_map( array(
				"name"     => esc_html__("PBR Product Categories List",'emarket'),
				"base"     => "pbr_category_list",
				"class"    => "",
				"category" => esc_html__('PBR Woocommerce','emarket'),
				'description' => esc_html__( 'Show Categories as menu Links', 'emarket' ),
				"params"   => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__('Title', 'emarket'),
					"param_name" => "title",
					"value"      => '',
				),
				 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post counts', 'emarket' ),
					'param_name' => 'show_count',
					'description' => esc_html__( 'Enables show count total product of category.', 'emarket' ),
					'value' => array( esc_html__( 'Yes, please', 'emarket' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("show children of the current category",'emarket'),
					"param_name" => "show_children",
					'description' => esc_html__( 'Enables show children of the current category.', 'emarket' ),
					'value' => array( esc_html__( 'Yes, please', 'emarket' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("Show dropdown children of the current category ",'emarket'),
					"param_name" => "show_dropdown",
					'description' => esc_html__( 'Enables show dropdown children of the current category.', 'emarket' ),
					'value' => array( esc_html__( 'Yes, please', 'emarket' ) => 'yes' )
				),

				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name",'emarket'),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
				)
		   	)
		));
	 


		/**
		 * pbr_all_products
		 */
		 
		vc_map( array(
				'name' => esc_html__( 'PBR Product categories ', 'emarket' ),
				'base' => 'pbr_special_product_categories',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'emarket' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'emarket' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'emarket' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'emarket' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'emarket' ),
						'value' => 4,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'emarket' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'emarket' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'emarket' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'emarket' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						"admin_label" => true,
						'description' => esc_html__( 'Product category list', 'emarket' ),
					),
				)
			) );
	
		/**
		 * pbr_productcats_tabs
		 */
		$sortby = array(
            array('recent_product', esc_html__('Latest Products', 'emarket')),
            array('featured_product', esc_html__('Featured Products', 'emarket' )),
            array('best_selling', esc_html__('BestSeller Products', 'emarket' )),
            array('top_rate', esc_html__('TopRated Products', 'emarket' )),
            array('on_sale', esc_html__('Special Products', 'emarket' )),
            array('recent_review', esc_html__('Recent Products Reviewed', 'emarket' ))
        );
        $layout_type = array(
        	esc_html__('Carousel', 'emarket') => 'carousel',
        	esc_html__('Grid', 'emarket') => 'grid'
    	);
    	$product_layouts = array('Grid'=>'grid','List'=>'list');
		vc_map( array(
				'name' => esc_html__( 'Categories Tabs ', 'emarket' ),
				'base' => 'pbr_categoriestabs',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'emarket' ),
				'description' => esc_html__( 'Display  categories in Tabs', 'emarket' ),
				'params' => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'emarket'),
						"param_name" => "title",
						"value"      => '',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'emarket' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'emarket' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'emarket' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'emarket' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'emarket' ),
						'param_name' => 'sortby',
						'std' => 'recent_product',
						'value' => $sortby,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'emarket' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'emarket' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
				   	),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout Type', 'emarket' ),
						'param_name' => 'layout_type',
						'std' => 'carousel',
						'value' => $layout_type,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style",'emarket'),
						"param_name" => "style",
						"value" => $product_layouts
					),
				)
			) );

		/**
		 * pbr_productcats_tabs
		 */
		vc_map( array(
				'name' => esc_html__( 'Product Categories Tabs ', 'emarket' ),
				'base' => 'pbr_productcats_tabs',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'emarket' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'emarket' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'emarket' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'emarket' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'emarket' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'emarket' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'emarket' ),
						'param_name' => 'orderby',
						'std' => 'date',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'emarket' ),
						'param_name' => 'order',
						'std' => 'DESC',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'emarket' ),
						'value' => $product_categories_dropdown,
						"admin_label" => true,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'emarket' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout Type', 'emarket' ),
						'param_name' => 'layout_type',
						'std' => 'carousel',
						'value' => $layout_type,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
				)
			) );
		 
		/**
		 * pbr_productcats_normal
		 */

		vc_map( array(
				'name' => esc_html__( 'Product Categories Style 1 ', 'emarket' ),
				'base' => 'pbr_productcats_normal',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'emarket' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'emarket' ),

				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'emarket' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'emarket' ),
						
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'emarket'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'emarket' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Float', 'emarket' ),
						'param_name' => 'image_float',
						'value' => array( esc_html__('Left','emarket') =>'pull-left', esc_html__('Right','emarket') =>'pull-right' ),
						'description' =>  esc_html__( 'Display banner image on left or right', 'emarket' ),
						'std' => 'pull-left'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'emarket' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'emarket' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'emarket' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'std' => 'date',
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'emarket' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'std' => 'DESC',
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'emarket' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'emarket' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'emarket' ),'admin_label'	=> true
					),
					array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name",'emarket'),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
				)
				)
			) );
			
			vc_map( array(
			    "name" => esc_html__("PBR Products Collection",'emarket'),
			    "base" => "pbr_products_collection",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'emarket' ),
			    "class" => "",
			   	"category" => esc_html__('PBR Woocommerce','emarket'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title",'emarket'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','emarket'),
		                "param_name" => "subtitle",
		            ),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'emarket' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'emarket' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type",'emarket'),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'emarket'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count",'emarket'),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.",'emarket')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'emarket'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'emarket'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'emarket')
					)
			   	)
			));

		}
	}	

	/**
	  * Register Woocommerce Vendor which will register list of shortcodes
	  */
	function emarket_fnc_init_vc_woocommerce_vendor(){

		$vendor = new Emarket_VC_Woocommerce();
		add_action( 'vc_after_set_mode', array(
			$vendor,
			'load'
		) );

	}
	add_action( 'after_setup_theme', 'emarket_fnc_init_vc_woocommerce_vendor' , 9 );   
}		