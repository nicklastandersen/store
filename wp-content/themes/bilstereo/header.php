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

        <div id="header_inner">
<!-- Shows Service Menu-->
            <nav id="service_menu">
                <div class="container">
                <?php wp_nav_menu( array(
                    'theme_location' => is_user_logged_in() ? 'service-menu-logged-in' : 'service-menu-logged-out',
                    'menu_class'        => 'service_menu',
                    'fallback_cb'    => false, // Prevents Fallback to wp_page_menu()
                ) );
                ?>
                </div>
            </nav>

            <!-- Shows Primary Menu-->
            <nav id="primary_menu">
                <div class="container">
                   <?php wp_nav_menu( array(
                       'menu' => 'primary',
                       'theme_location' => 'primary',
                       'menu_class' => 'primary_menu',
                       'fallback_cb'    => false, // Prevents Fallback to wp_page_menu()
                   ) );
                    ?>
                </div>
            </nav>
        </div>

        <div class="masthead" role="banner">
            <div class="inner container   header-offset-size">
            <div class="navbar top" role="navigation">
                <div class="inner header-offset-nav">
                    <ul id="nav-breadcrumbs" class="linklist navlinks has-social-links" role="menubar">
                        <li class="small-icon icon-home breadcrumbs">
                            <?php if ( function_exists('yoast_breadcrumb') )
                            {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header-bg"></div>
        </div>

    </header>


<section id="main" role="main">
    <div class="container">
      


