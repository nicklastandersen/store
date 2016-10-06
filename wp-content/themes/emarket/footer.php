<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */
$footer_profile =  apply_filters( 'emarket_fnc_get_footer_profile', 'default' );
?>

		</section><!-- #main -->
		<?php do_action( 'emarket_template_main_after' ); ?>
		<?php do_action( 'emarket_template_footer_before' ); ?>
		<footer id="pbr-footer" class="pbr-footer" role="contentinfo">
			<div class="inner">				
				<?php if( $footer_profile && $footer_profile != 'default' ) : ?>
					<div class="pbr-footer-profile">
						<?php emarket_fnc_render_post_content( $footer_profile ); ?>
					</div>
				<?php else: ?>
					<?php get_sidebar( 'footer' ); ?>
				<?php endif; ?>


				<?php get_sidebar( 'mass-footer-body' );  ?>	

				<section class="pbr-copyright">
					<div class="container">
						<a href="#" class="scrollup"><span class="fa fa-angle-up"></span></a>
						<?php do_action( 'emarket_fnc_credits' ); ?>
						<?php 
							$copyright_text =  emarket_fnc_theme_options('copyright_text', '');
							if(!empty($copyright_text)){
								echo do_shortcode($copyright_text);
							}else{
								$devby = '<a target="_blank" href="http://wpopal.com">WpOpal Team</a>';
								printf( esc_html__( 'Proudly powered by %s. Developed by %s', 'emarket' ), 'WordPress', $devby );   
							}
						?>
					</div>	
				</section>
			</div>
		</footer><!-- #colophon -->
		

		<?php do_action( 'emarket_template_footer_after' ); ?>
		<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
	<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>