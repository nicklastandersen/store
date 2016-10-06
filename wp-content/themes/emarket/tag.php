<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://www.wpopal.com/theme/emarket/
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

$emarket_page_layouts = apply_filters( 'emarket_fnc_get_page_sidebar_configs', null );

get_header( apply_filters( 'emarket_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'emarket_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('emarket_template_main_container_class','container');?> inner">
	<div class="row">
		<?php if( isset($emarket_page_layouts['sidebars']) && !empty($emarket_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>	
		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($emarket_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( esc_html__( 'Tag Archives: %s', 'emarket' ), single_tag_title( '', false ) ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					emarket_fnc_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php
get_footer();