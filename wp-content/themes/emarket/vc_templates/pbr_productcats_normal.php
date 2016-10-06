4<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
 

$_id = emarket_fnc_makeid();
if($category=='') return;
$_count = 0;

$ocategory = get_term_by( 'slug', $category, 'product_cat' );
 

?>
<?php if ( !empty($ocategory) && !is_wp_error($ocategory) ): ?>
<div class="widget <?php echo esc_attr($el_class); ?> widget-products widget-productcats">
	<?php if($ocategory->name!=''){ ?>
	 <div class="widget-heading clearfix">
			<h3 class="widget-title">
		       <span><?php echo trim($ocategory->name); ?></span>
			</h3>	
			
					  <?php 

					  $args = array(
					       'hierarchical' => 1,
					       'show_option_none' => '',
					       'hide_empty' => 0,
					       'parent' => $ocategory->term_id,
					       'taxonomy' => 'product_cat'
					    );
						$subcats = get_categories($args);


						if( $subcats ){ ?> 
						
						<div class="sub-categories pull-right"><ul class="list-inline bullets">
						<?php 
						foreach ( $subcats as $term ){
						    $category_id = $term->term_id;
						    $category_name = $term->name;
						    $category_slug = $term->slug;

						    echo '<li><a href="'. esc_url( get_term_link($term->slug, 'product_cat') ) .'" title="'.esc_attr( $category_name).'">'.esc_html( $category_name ).'</a></li>';
						 } ?>
						 </ul>
							</div> <?php } ?>
	</div>	
	<?php }
	?>

	<div class="widget-content-productcats">
		 	<div class="row">
		 		<?php if( !empty($image_cat) ) { ?>
		 		<?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
		 		<div class="col-lg-3 hidden-md hidden-sm hidden-xs <?php echo esc_attr( $image_float );?>">
		 			<img src="<?php echo esc_url_raw($img[0]); ?>" title="<?php echo esc_attr($ocategory->name); ?>" alt="">
		 		</div>
		 		<?php } ?>
		 		<div class="col-lg-<?php echo empty($image_cat)?12:9;?> col-md-12">
				    <div class="panel-wrapper no-space-row clearfix">
					    <div class="panel-products-grid panel-left col-lg-8 col-md-9">
							<div class="widget-primary">

								<div class="widget-title">
									<span><?php esc_html_e( 'Best Seller', 'emarket'); ?></span>
								</div>
								<div class="widget-content woocommerce"><div class="grid-wrapper">
									 <?php 
									 $loop = emarket_fnc_woocommerce_query( 'best_selling', $per_page , array($ocategory->slug) );
									 if ( $loop->have_posts() ) : ?>
											 
											<div id="carousel-<?php echo esc_attr($_id); ?>" class="text-center owl-carousel-play" data-ride="owlcarousel">
											<div class="owl-carousel row-products" data-slide="<?php echo esc_attr($columns); ?>" data-pagination="false" data-navigation="true">
												 <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
												 		<div class="product-wrapper"><?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
												 <?php  $_count++ ; endwhile; ?>

											</div>
											<?php if( $columns  < $loop->post_count) { ?>
										
									                <a class="left carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>" data-slide="prev">
									                    <span class="fa fa-arrow-left"></span>
									                </a>
									                <a class="right carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>" data-slide="next">
									                    <span class="fa fa-arrow-right"></span>
									                </a>
	
									            <?php wp_reset_postdata(); ?>
											 <?php } ?>
											</div>			
										 
									<?php endif; ?>
								</div></div>
							</div>					    	
					    
					    </div>	

					    <div class="panel-products-list panel-right col-lg-4 col-md-3">
					    	<div class="widget <?php echo esc_attr($el_class); ?>">
						    	<div class="widget-title" >
						    		<span><?php esc_html_e( 'New Arrivals', 'emarket'); ?></span>
						    	</div>
						    	<div class="widget-content">
						    		<?php 
							    		$loop = emarket_fnc_woocommerce_query( 'recent_product', 3 , array($ocategory->slug) );
							    		wc_get_template( 'widget-products/list.php' , array( 'loop'=>$loop,'columns_count'=> $columns ,'posts_per_page'=>$per_page ) ); 
							    	?>
							    	<?php wp_reset_postdata(); ?>
							    </div>
						    </div>	
					    </div>	
					</div>    
		 		</div>
		 	</div>		
	</div>
</div>
<?php endif; ?>