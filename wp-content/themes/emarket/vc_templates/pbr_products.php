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

switch ($columns_count) {
	case '6': 
		$class_column = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
		break;
	case '4':
		$class_column='col-md-3 col-sm-6';
		break;
	case '3':
		$class_column='col-md-4 col-sm-4';
		break;
	case '2':
		$class_column='col-md-6 col-sm-6';
		break;
	default:
		$class_column='col-md-12 col-sm-12';
		break;
}

if($type=='') return;


global $woocommerce;

$_id = emarket_fnc_makeid();
$_count = 1;

if (isset($categories) && !empty($categories))
    $categories = array_map('trim', explode(',', $categories));
else
	$categories = '';
$loop = emarket_fnc_woocommerce_query($type, $number, $categories);

echo "<div class='widget woocommerce widget-".esc_attr($style) . "".(!empty($el_class)?" ".esc_attr( $el_class):'')."'>";

if($title!=''){ ?>
	<h3 class="widget-title visual-title">
      <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
	</h3>
<?php }

if ( $loop->have_posts() ) : ?>
	<div class="widget-content">
		<div class="<?php echo esc_attr( $style ); ?>-wrapper">
			<?php wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number ) ); ?>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php echo "</div>" ?>
