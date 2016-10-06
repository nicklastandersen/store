<?php
/**
 * The Header for our theme: Main Darker Background. Logo left + Main menu and Right sidebar. Below Category Search + Mini Shopping basket.
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"><div class="pbr-page-inner row-offcanvas row-offcanvas-left">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header" class="hidden-xs hidden-sm">
		<a href="<?php echo esc_url( get_option('header_image_link','#') ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>

	<header id="pbr-masthead" class="site-header pbr-header-market-v1" role="banner">
	<?php do_action( 'emarket_template_header_before' ); ?>
		<div class="<?php echo emarket_fnc_theme_options('keepheader') ? 'has-sticky' : ''; ?> hidden-xs hidden-sm">
			<div class="container">
				<div class="container-inner">
				<div class="header-main row">
					<div class="col-md-3">
			 			<div class="call-top pull-left" style="display: block;">
	              			<?php if ( is_active_sidebar( 'header-left-sidebar' ) ) : ?>
								<?php dynamic_sidebar('header-left-sidebar'); ?>
							<?php endif; ?> 
	              		</div>
	              		<div id="widget-call-content" class="vertical-none top-verticalmenu"></div>
					</div>

					<div class="col-md-7 hidden-xs">
						<div id="search-container" class="search-box-wrapper">
								<div class="search-box search-box-simple">
									<?php emarket_fnc_categories_searchform() ?>
								</div>
							</div>
					</div>
					<div class="col-md-2 hidden-sm hidden-xs nopadding">
						<div class="pbr-header-right">
							<?php do_action( "emarket_template_header_right" ); ?>
						</div>
					</div>
				</div>
				</div>
			</div>	
		</div>
	<section class="pbr-massbottom-head"><div class="inner">
		<div class="container">
			<div class="row">
				<?php if(is_active_sidebar('vertical-menu')){ ?>
					<div class="col-lg-3 col-md-3 menu-vertical-hidden hidden-sm hidden-xs">
						<?php get_template_part( 'page-templates/parts/vertical' ); ?>
					</div>
				<?php } ?>

				<div class="col-lg-9 col-md-9">
					<div class="inner navbar-mega-simple"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
				</div>

				</div>
			</div>	
		</div>
	</section>



	</header><!-- #masthead -->
	
	

	<?php do_action( 'emarket_template_header_after' ); ?>
	
	<section id="main" class="site-main">
