<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

$emarket_page_layouts = apply_filters( 'emarket_fnc_sidebars_others_configs', null );

if( isset($emarket_page_layouts['sidebars']) ): $sidebars = $emarket_page_layouts['sidebars']; 
?> 
	<?php if ( $sidebars['left']['active'] ) : ?>
	<div class="<?php echo esc_attr($sidebars['left']['class']) ;?> pull-left">
	  <aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	   	<?php dynamic_sidebar( $sidebars['left']['sidebar'] ); ?>
	  </aside>
	</div>
	<?php endif; ?>
 	
 	<?php if ( $sidebars['right']['active'] ) : ?>
	<div class="<?php echo esc_attr($sidebars['right']['class']) ;?> pull-right">
	  <aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	   	<?php dynamic_sidebar( $sidebars['right']['sidebar'] ); ?>
	  </aside>
	</div>
	<?php endif; ?>
<?php endif; ?> 

