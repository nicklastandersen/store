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
/*
*Template Name: 404 Page
*/

get_header( apply_filters( 'emarket_fnc_get_header_layout', null ) ); ?>

<section id="main-container" class="<?php echo apply_filters('emarket_template_main_container_class','container');?> inner clearfix notfound-page">
	<div class="row">
		<div id="main-content" class="main-content col-lg-12 text-center space-padding-tb-100">
			<div id="primary" class="content-area">
				 <div id="content" class="site-content" role="main">
					<div class="title">
						<span>404</span>
						<span class="sub"><?php esc_html_e( 'Not Found', 'emarket' ); ?></span>
					</div>
					<div class="error-description">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'emarket' ); ?></p>
					</div><!-- .page-content -->

					<div class="page-action text-center">
						<a class="btn btn-lg btn-primary" href="javascript: history.go(-1)"><?php esc_html_e('Go back to previous page', 'emarket'); ?></a>
						<a class="btn btn-lg btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Return to homepage', 'emarket'); ?></a>
					</div>

				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

		 
		<?php get_sidebar(); ?>
	 
	</div>	
</section>
<?php

get_footer();

 