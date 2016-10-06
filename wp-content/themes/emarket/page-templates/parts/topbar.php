<section id="pbr-topbar" class="pbr-topbar">
	<div class="container"><div class="inner">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="logo-wrapper">
                    <?php get_template_part( 'page-templates/parts/logo' ); ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-xs hidden-sm">
                
                <?php 
                     // WPML - Custom Languages Menu
                    emarket_fnc_wpml_language_buttons();
                ?>
                <?php if(has_nav_menu( 'topmenu' )): ?>
     
                <nav class="pbr-topmenu" role="navigation">
                    <?php
                        $args = array(
                            'theme_location'  => 'topmenu',
                            'menu_class'      => 'pbr-menu-top list-inline links',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-topmenu'
                        );
                        wp_nav_menu($args);
                    ?>
                </nav>
       
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 header-right pull-right  hidden-xs hidden-sm">
                 <div class="user-login pull-right">
                    <ul class="list-inline">
                        <?php if( !is_user_logged_in() ){ ?>
                            <?php do_action('emarket-account-buttons'); ?> 
                        <?php }else{ ?>
                            <?php $current_user = wp_get_current_user(); ?>
                          <li>  <span><?php esc_html_e('Welcome ','emarket'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
                        <?php } ?>
                    </ul>                 
                </div>                           
            </div>
        </div>
	</div></div>	
</section>