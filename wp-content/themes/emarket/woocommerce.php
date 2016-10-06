<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

$emarket_page_layouts = apply_filters( 'emarket_fnc_get_woocommerce_sidebar_configs', null );

get_header( apply_filters( 'emarket_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'emarket_woo_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('emarket_template_woocommerce_main_container_class','container');?>">
	
	<div class="row">
		
		<?php if( isset($emarket_page_layouts['sidebars']) && !empty($emarket_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($emarket_page_layouts['main']['class']); ?>">

	 
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					 <?php  emarket_fnc_woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->


			<?php    get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

	</div>	
</section>
<?php

get_footer();
