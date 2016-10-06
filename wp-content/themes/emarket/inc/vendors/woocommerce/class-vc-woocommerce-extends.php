<?php 
if( class_exists("WPBakeryShortCode") ){
	/*
	 *
	 */
	class WPBakeryShortCode_PBR_Tabs_Products extends WPBakeryShortCode {

		public function getListQuery( $atts ){ 
			$this->atts  = $atts; 
			$list_query = array();
			$types = explode(',', $this->atts['show_tab']);
			foreach ($types as $type) {
				$list_query[$type] = $this->getTabTitle($type);
			}


			return $list_query;
		}

		public function getTabTitle($type){ 
			switch ($type) {
				case 'recent':
					return array('title'=>esc_html__('Latest Products','emarket'),'title_tab'=>esc_html__('Latest','emarket'));
				case 'featured_product':
					return array('title'=>esc_html__('Featured Products','emarket'),'title_tab'=>esc_html__('Featured','emarket'));
				case 'top_rate':
					return array('title'=> esc_html__('Top Rated Products','emarket'),'title_tab'=>esc_html__('Top Rated', 'emarket'));
				case 'best_selling':
					return array('title'=>esc_html__('BestSeller Products','emarket'),'title_tab'=>esc_html__('BestSeller','emarket'));
				case 'on_sale':
					return array('title'=>esc_html__('Special Products','emarket'),'title_tab'=>esc_html__('Special','emarket'));
			}
		}
	}

	/**
	 *
	 */
	 class WPBakeryShortCode_Pbr_product_deals extends WPBakeryShortCode {}

	 /**
	  *
	  */
	 class WPBakeryShortCode_Pbr_timing_deals extends WPBakeryShortCode {}

	 
	class WPBakeryShortCode_Pbr_productcategory extends WPBakeryShortCode {}
	class WPBakeryShortCode_Pbr_productcategory_index extends WPBakeryShortCode {}


	class WPBakeryShortCode_Pbr_category_filter extends WPBakeryShortCode {}

	class WPBakeryShortCode_Pbr_products extends WPBakeryShortCode {}
	 

	class WPBakeryShortCode_Pbr_category_list extends WPBakeryShortCode {}
	class WPBakeryShortCode_Pbr_special_product_categories extends WPBakeryShortCode {}
	class WPBakeryShortCode_Pbr_productcats_tabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_Pbr_productcats_normal extends WPBakeryShortCode {}
	class WPBakeryShortCode_Pbr_categoriestabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_pbr_products_onsale extends WPBakeryShortCode {}
	class WPBakeryShortCode_pbr_products_collection extends WPBakeryShortCode {}

 }
