<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$_id = emarket_fnc_makeid();
$args = array(
	'post_type' => 'brands',
	'posts_per_page'=> $number
);
$loop = new WP_Query($args);
if ( $loop->have_posts() ) :
	$_count = 1; 
?>
	<div class="widget widget-brand-logo<?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
		<?php if(!empty($title)){ ?>
			<h4 class="widget-title-v2 text-center">
				<span><?php echo trim($title); ?></span>
				<?php if(!empty($descript)){ ?>
		            <span class="widget-desc">
		                <?php echo trim($descript); ?>
		            </span>
		        <?php } ?>
			</h4>
		<?php } ?>

		<div class="widget-content">
			<div class="widget-brands-inner owl-carousel-play" id="productcarouse-<?php echo esc_attr($_id); ?>" data-ride="carousel">
				<?php   if( $loop->post_count > $columns_count ) { ?>
				<div class="carousel-controls">
					<a href="#productcarouse-<?php echo esc_attr($_id); ?>" data-slide="prev" class="left carousel-control carousel-xs">
						<i class="fa fa-chevron-left"></i>
					</a>
					<a href="#productcarouse-<?php echo esc_attr($_id); ?>" data-slide="next" class="right carousel-control carousel-xs">
						<i class="fa fa-chevron-right"></i>
					</a>
				</div>
				<?php } ?>
				<div class="owl-carousel" data-slide="<?php echo esc_attr($columns_count);?>"  data-singleItem="true" data-navigation="true" data-pagination="false">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php   echo '<div class="item">'; ?>
						<?php
							$link = get_post_meta(get_the_ID(),'brands__brank_link',true) ? get_post_meta(get_the_ID(),'brands__brank_link',true): '#';
						?>
						<!-- Product Item -->
						<div class="item-brand text-center">
							<a href="<?php echo esc_url($link); ?>" target="_blank" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'brand-logo' ); ?>
							</a>
						</div>
						<!-- End Product Item -->

					<?php  echo '</div>'; ?>
					<?php $_count++; ?>
				<?php endwhile; ?>
				</div>
			</div>
		</div>

	</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>