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
    global $woocommerce_loop; 

    
    add_action( 'woocommerce_before_shop_loop_item_title', 'emarket_fnc_woocommerce_before_shop_loop_item_title');
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );


    $woocommerce_loop['columns'] = $columns_count ;
    $deals = array();

    $loop = emarket_fnc_woocommerce_query('on_sale', $number);

    $_id = emarket_fnc_makeid();
 
    $_total =  $loop->found_posts;  

    $layout= 'product';


    if( $loop->have_posts()  ) { ?>
    <div id="pbr-filter" class="clearfix products-top-wrap woocommerce">
        <?php
            emarket_fnc_woocommerce_display_modes();
        ?>
        <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
             //woocommerce_show_messages();
          woocommerce_catalog_ordering();
        ?>
    </div>
    <div class="woocommerce products woo-onsale"> 
        <div class="products-list row-products row">
            <?php while ( $loop->have_posts() ) :   $loop->the_post(); $product = wc_get_product();;
                $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );
            ?>
            <?php
                wc_get_template_part( 'content', 'product' );
            ?>
            <?php
                endwhile; 
            ?>
        </div>
        <div class="clearfix"></div>
           <?php wp_reset_postdata(); ?>          
    </div>
    <div class="products-bottom-wrap clearfix">
        <?php echo emarket_fnc_pagination_nav( $number, $_total ); ?>
    </div>
    <?php } ?>
