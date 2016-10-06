<div id="pbr-logo" class="logo">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ): ?>
	    	<?php the_custom_logo(); ?>
	    <?php elseif( emarket_fnc_theme_options('logo') ):  ?>
	        <img src="<?php echo emarket_fnc_theme_options('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>">
	    <?php else: ?>
	    	<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		<?php endif; ?>
    </a>
</div>
