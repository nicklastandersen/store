<?php   global $woocommerce; ?>
<div class="pbr-topcart">
 <div id="cart" class="dropdown version-2">
        
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'emarket'); ?>">
        	<i class="icon-cart"></i>
        	<div class="wrap-cart">
	            <span class="title-cart"><?php esc_html_e('Shopping Cart ','emarket'); ?></span>
	            <?php echo sprintf(_n(' <span class="mini-cart-items"> %d item </span> ', ' <span class="mini-cart-items"> %d item </span> ', $woocommerce->cart->cart_contents_count, 'emarket'), $woocommerce->cart->cart_contents_count);?> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?>
            </div>
            </a>            
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div> 
