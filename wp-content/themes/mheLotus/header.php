<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="container">
        <header class="header">
            <div class="header-inner">
                <div class="header-row">
                    <div class="cus-row">
                        <div class="header-col" id="header">
                            <!--LOGO-->
                            <div class="header-logo col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12">
                                <a href="<?php echo site_url(''); ?>"><img id="header-logo"
                                        src="<?php echo get_template_directory_uri(); ?>/img/MHEDemag_Logo_colour-for-Website-1.png"></a>
                            </div>
                            <div class="navbardiv col-11 col-sm-11 col-md-11 col-lg-11 col-xl-12">
                                <!-- NAVIGATION BAR -->
                                <nav class="navbar navbar-expand-xl">
                                    <a href="<?php echo site_url(''); ?>"><img id="header-logo-res"
                                            src="<?php echo get_template_directory_uri(); ?>/img/MHEDemag_Logo_colour-for-Website-1.png"></a>
                                    <button type="button" class="navbar-toggler open-overlay" onclick="openNav()"><i
                                            class="fa fa-align-justify"></i></button>
                                    <div class="collapse navbar-collapse navbar-nav" id="navbarToggleExternalContent">
                                        <?php
                                        wp_nav_menu(
                                            array(
                                                'menu_id'        => 'primary-menu',
                                            )
                                        );
                                        ?>
                                    </div>
                                </nav>
                            </div>
                            <!-- REPONSIVE NAVIGATION BAR-->
                            <div class="col-12 col-sm-12 col-md-12">
                                <div id="mySidenav" class="sidenav">
                                    <div class="container">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-home"
                                            aria-current="page">Overhead Cranes Parts, Equipment Supplier & Manufacturer
                                            Company</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Products</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Services And
                                            Parts</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Refurbishment &
                                            Upgrading</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Rental</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Material Handling
                                            Solutions</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Contact Us</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">About Us</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">History</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Organisation</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Career</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Newsroom</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Demag Designer
                                            Tools</a>
                                        <a href="<?php echo site_url(''); ?>" class="sidenav-item">Downloads</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>