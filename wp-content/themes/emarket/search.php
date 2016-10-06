<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

get_header( apply_filters( 'emarket_fnc_get_header_layout', null ) ); ?>

<?php 
	echo '<section id="pbr-breadscrumb" class="pbr-breadscrumb"><div class="container">';
			emarket_fnc_breadcrumbs();
	echo '</div></section>';
?>

	<section id="primary" class="content-area container inner">
		<div id="content" class="site-content" role="main">
			<header>
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'emarket' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php if ( have_posts() ) : ?>

			
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
					// Previous/next post navigation.
					emarket_fnc_paging_nav();

				

				endif;
			?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
