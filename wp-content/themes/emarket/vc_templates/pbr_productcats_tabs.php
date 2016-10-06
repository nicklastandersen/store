<?php
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

$scolumns = $columns > 0 ? 12/$columns : 4;
$ocategory = get_term_by( 'slug', $category, 'product_cat' );
?>
<?php if ( !empty($ocategory) && !is_wp_error($ocategory) ): ?>
<div class="widget widget-products widget-productcats-tabs">
<?php if($ocategory->name!=''){ ?>
<div class="widget-heading pull-left hidden">
			<h3>
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


						if( 	$subcats ){ ?> 
						
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
<?php } ?>

<div class="widget woo-ajax-load-prods">
	 		
		<?php if( !empty($image_cat) ) { ?>
 		<?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
 		<div class="clearfix">
 			<img src="<?php echo esc_url_raw($img[0]); ?>" title="<?php echo esc_attr($ocategory->name); ?>">
 		</div>
 		<?php } ?>
		  <div class="nav-inner">
		    <ul role="tablist" class="tab-v1 nav nav-tabs">
		      <li class="active" data-action="wooloadproducts" data-slug="<?php echo trim( $category );?>" data-type="best_selling" data-show="<?php echo esc_attr( $columns );?>" data-limit="<?php echo esc_attr( $per_page );?>" data-href="#tab-<?php echo esc_attr($_id);?>1">
		        <a  aria-expanded="false" data-toggle="tab" role="tab" href="#tab-<?php echo esc_attr($_id);?>1" ><?php esc_html_e( 'Best Seller', 'emarket'); ?></a>
		      </li>
		      <li  data-action="wooloadproducts" data-slug="<?php echo trim( $category );?>" data-type="newarrivals" data-show="<?php echo esc_attr( $columns );?>" data-limit="<?php echo esc_attr( $per_page );?>" data-href="#tab-<?php echo esc_attr($_id);?>2">
		        <a aria-expanded="true" data-toggle="tab" role="tab" href="#tab-<?php echo esc_attr($_id);?>2" ><?php esc_html_e( 'New Arrivals', 'emarket'); ?></a>
		      </li>
		
		    </ul>
		  </div>
		  <div class="widget-content tab-content space-padding-20">
		    <div id="tab-<?php echo esc_attr($_id);?>1" class="tab-pane active">
		    	<?php 
					 $loop = emarket_fnc_woocommerce_query( 'best_selling', $per_page , array($ocategory->slug) );
					 if ( $loop->have_posts() ) : ?>
						<?php if ($layout_type == 'carousel') : ?>
							<div id="carousel-<?php echo esc_attr($_id); ?>" class="text-center owl-carousel-play" data-ride="owlcarousel">
								<div class="owl-carousel row-products" data-slide="<?php echo esc_attr( $columns );?>" data-pagination="false" data-navigation="true">
									 <?php $_count=0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
									 		<div class="product-wrapper product"><?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
									 <?php  $_count++ ; endwhile; ?>
									 
								</div>
								<?php if( $columns  < $loop->post_count) { ?>
								<div class="carousel-controls carousel-hidden">
									<a class="left carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
											<span class="fa fa-arrow-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="next">
											<span class="fa fa-arrow-right"></span>
									</a>
								</div>
							 <?php } ?>
							</div>
							<?php wp_reset_postdata(); ?>			
						<?php else : ?>
							<div class="row">
								<?php $_count=0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
							 		<div class="col-sm-<?php echo esc_attr( $scolumns );?> product"><?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
								<?php  $_count++ ; endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>	
						<?php endif; ?>
					<?php endif; ?>

		    </div>
		    <div id="tab-<?php echo esc_attr($_id);?>2" class="tab-pane">
		    	<?php 

					 $loop2 = emarket_fnc_woocommerce_query( 'recent_product', $per_page , array($ocategory->slug) );
					 if ( $loop2->have_posts() ) : ?>
						<?php if ($layout_type == 'carousel') : ?>	 
							<div id="carousel-<?php echo esc_attr($_id); ?>" class="text-center owl-carousel-play" data-ride="owlcarousel">
								<div class="owl-carousel row-products" data-slide="<?php echo esc_attr( $columns );?>" data-pagination="false" data-navigation="true">
									 <?php $_count=0; while ( $loop2->have_posts() ) : $loop2->the_post(); ?>
									 		<div class="product-wrapper product"><?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
									 <?php  $_count++ ; endwhile; ?>
									 
								</div>
								<?php if( $columns  < $loop2->post_count) { ?>
								<div class="carousel-controls carousel-hidden">
									<a class="left carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
											<span class="fa fa-arrow-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="next">
											<span class="fa fa-arrow-right"></span>
									</a>
								</div>
							 <?php } ?>
							</div>
							<?php wp_reset_postdata(); ?>			
						<?php else : ?>
							<div class="row">
								<?php $_count=0; while ( $loop2->have_posts() ) : $loop2->the_post(); ?>
								 		<div class="col-sm-<?php echo esc_attr( $scolumns );?> product"><?php wc_get_template_part( 'content', 'product-inner' ); ?></div>
								<?php  $_count++ ; endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
		    </div>
		  </div>
</div>
 
</div>
<?php endif; ?>