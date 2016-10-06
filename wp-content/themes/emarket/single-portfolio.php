<?php
/**
 * The Template for displaying all single posts
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

$emarket_page_layouts = apply_filters( 'emarket_fnc_get_single_sidebar_configs', null );

get_header( apply_filters( 'emarket_fnc_get_header_layout', null ) );

do_action( 'emarket_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters( 'emarket_template_main_content_class', 'container' ); ?> inner">
	<div class="row">
		<?php if( isset($emarket_page_layouts['sidebars']) && !empty($emarket_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($emarket_page_layouts['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							$format = get_post_meta(get_the_ID(), 'portfolio_layout',true);

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
						//	get_template_part( 'portfolio/content', get_post_format()  );
							get_template_part( 'portfolio/content', $format );
						
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
							
						endwhile;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
 
	</div>	
</section>
<?php
get_footer();
