<nav  data-duration="<?php echo emarket_fnc_theme_options('megamenu-duration',400); ?>" class="hidden-xs hidden-sm pbr-megamenu <?php echo emarket_fnc_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
        
	    <?php
	        $args = array(  'theme_location' => 'primary',
	                        'container_class' => 'collapse navbar-collapse navbar-mega-collapse nopadding',
	                        'menu_class' => 'nav navbar-nav megamenu',
	                        'fallback_cb' => '',
	                        'menu_id' => 'primary-menu',
	                        'walker' => new Emarket_PBR_bootstrap_navwalker() );
	        wp_nav_menu($args);
	    ?>
</nav>