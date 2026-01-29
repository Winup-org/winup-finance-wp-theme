<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <!-- Top Bar: Date & Utility -->
        <div class="top-bar">
            <div class="container top-bar-inner">
                <div class="date-display">
                    <?php echo date_i18n('l, F j, Y'); ?>
                </div>
                <div class="top-menu">
                    <!-- Hardcoded demo links for 'Newspaper' feel -->
                    <a href="#">Subscribe</a>
                    <a href="#">Log In</a>
                </div>
            </div>
        </div>

        <!-- Main Header: Logo Area -->
        <header id="masthead" class="site-header">
            <div class="container header-inner">
                <div class="site-branding">
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                            rel="home"><?php bloginfo('name'); ?></a></h1>
                    <p class="site-description"><?php bloginfo('description'); ?></p>
                </div>
            </div>

            <!-- Navbar: Separated row -->
            <div class="nav-container-wrapper">
                <div class="container nav-container">
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => false,
                                'fallback_cb' => false,
                            )
                        );
                        ?>
                    </nav>
                    <div class="header-tools">
                        <a href="#" class="search-toggle" aria-label="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </header>