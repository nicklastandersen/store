<nav  data-duration="<?php echo emarket_fnc_theme_options('megamenu-duration',400); ?>" class="hidden-xs hidden-sm pbr-vertical-menu <?php echo emarket_fnc_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
        <h3 class="widget-title"><span class="pull-left"><?php esc_html_e('All Category', 'emarket');?></span><span class="fa fa-angle-right text-primary"></span></h3>
	    <?php
	        $args = array(  'theme_location' => 'secondary',
	                        'container_class' => 'collapse navbar-collapse navbar-mega-collapse vertical-menu',
	                        'menu_class' => 'nav navbar-nav megamenu',
	                        'fallback_cb' => '',
	                        'menu_id' => 'secondary',
	                        'walker' => new Emarket_PBR_bootstrap_navwalker() );
	        wp_nav_menu($args);
	    ?>
</nav>