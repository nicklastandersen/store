<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


<div id="wrapper">
    <header id="header" class="site-header">
        <div class="site-branding">
            <div id="container">
                <a class="brand" href="<?php bloginfo('url'); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt=""></a>
            </div>
        </div>

        <nav id="menu-primary" class="menu-primary" role="navigation">
            <div id="container">
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

      <!--          <?php /*if (class_exists('woocommerce')) : */?>
                    <div id="cart">
                        <div class="cart-right">

                            <a class="cart-contents" href="<?php /*echo WC()->cart->get_cart_url(); */?>" title="<?php /*_e('View your shopping cart', 'store'); */?>">
                                <i class="fa fa-shopping-cart"></i>
                                <div class="total"> <?php /*echo WC()->cart->get_cart_total(); */?>
                                </div>
                            </a>
                        </div>
                    </div>
                --><?php /*endif; */?>
            </div>
        </nav>
    </header>
</div>

