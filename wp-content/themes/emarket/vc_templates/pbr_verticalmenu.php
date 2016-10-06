<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$nav_menu = ( $menu !='' ) ? wp_get_nav_menu_object( $menu ) : false;
if(!$nav_menu) return false;
$postion_class = ($postion=='left')?'menu-left':'menu-right';
$args = array(  'menu' => $nav_menu,
                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse pbr-vertical-menu '.$postion_class,
                'menu_class' => 'nav navbar-nav navbar-vertical-mega',
                'fallback_cb' => '',
                'walker' => new Emarket_PBR_bootstrap_navwalker());

?>

<aside class="widget <?php echo esc_attr( $el_class ) ; ?>">
    <?php if($title!=''): ?>
        <h3 class="widget-title visual-title"><span><span><?php echo  $title; ?></span></span></h3>
    <?php endif; ?>
    <div class="widget-content">
        <?php wp_nav_menu($args); ?>
    </div>
</aside>
