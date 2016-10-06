	</div>

	<?php get_sidebar('footer'); ?>

	<footer class="site-footer">
		<div class="site-info container">
			<?php printf( __( 'Powered by %1$s.', 'store' ), '<a rel="nofollow" href="'.esc_url("https://rohitink.com/2015/05/21/store-woocommerce-theme/").'">Store Theme</a>' ); ?>
			<span class="sep"></span>
			<?php echo ( get_theme_mod('store_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','store')) : esc_html( get_theme_mod('store_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
