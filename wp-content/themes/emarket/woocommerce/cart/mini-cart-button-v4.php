<?php   global $woocommerce; ?>
<div class="pbr-topcart">
 <div id="cart" class="dropdown version-4">
        
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'emarket'); ?>">
            <span class="text-skin cart-icon">
                <i class="icon-cart2"></i>
            </span>

            <span class="title-cart"><?php esc_html_e('My Cart ','emarket'); ?></span>
            <?php echo sprintf(_n(' <span class="mini-cart-items"> %d item</span> ', ' <span class="mini-cart-items"> %d item </span> ', $woocommerce->cart->cart_contents_count, 'emarket'), $woocommerce->cart->cart_contents_count);?><span class="mini-cart-total"> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?> </span>
            </a>            
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>    