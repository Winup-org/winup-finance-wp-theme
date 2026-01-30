<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#003366">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Source+Sans+3:wght@300;400;600&family=Source+Serif+4:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <!-- Ticker de Cotações - Moedas Globais -->
        <div class="ticker-bar">
            <div class="ticker-wrapper">
                <div class="ticker-content" id="ticker-content">
                    <span class="ticker-item">
                        <span class="ticker-label">🇺🇸 USD/BRL</span>
                        <span class="ticker-value">R$ 5,12</span>
                        <span class="ticker-change ticker-up">▲ 0,42%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇪🇺 EUR/BRL</span>
                        <span class="ticker-value">R$ 5,58</span>
                        <span class="ticker-change ticker-down">▼ 0,18%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇬🇧 GBP/BRL</span>
                        <span class="ticker-value">R$ 6,45</span>
                        <span class="ticker-change ticker-up">▲ 0,31%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇯🇵 JPY/BRL</span>
                        <span class="ticker-value">R$ 0,034</span>
                        <span class="ticker-change ticker-down">▼ 0,08%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇨🇭 CHF/BRL</span>
                        <span class="ticker-value">R$ 5,82</span>
                        <span class="ticker-change ticker-up">▲ 0,15%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇨🇦 CAD/BRL</span>
                        <span class="ticker-value">R$ 3,78</span>
                        <span class="ticker-change ticker-up">▲ 0,22%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇦🇺 AUD/BRL</span>
                        <span class="ticker-value">R$ 3,35</span>
                        <span class="ticker-change ticker-down">▼ 0,11%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇨🇳 CNY/BRL</span>
                        <span class="ticker-value">R$ 0,71</span>
                        <span class="ticker-change ticker-up">▲ 0,05%</span>
                    </span>
                    <!-- Duplicado para scroll infinito -->
                    <span class="ticker-item">
                        <span class="ticker-label">🇺🇸 USD/BRL</span>
                        <span class="ticker-value">R$ 5,12</span>
                        <span class="ticker-change ticker-up">▲ 0,42%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇪🇺 EUR/BRL</span>
                        <span class="ticker-value">R$ 5,58</span>
                        <span class="ticker-change ticker-down">▼ 0,18%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇬🇧 GBP/BRL</span>
                        <span class="ticker-value">R$ 6,45</span>
                        <span class="ticker-change ticker-up">▲ 0,31%</span>
                    </span>
                    <span class="ticker-item">
                        <span class="ticker-label">🇯🇵 JPY/BRL</span>
                        <span class="ticker-value">R$ 0,034</span>
                        <span class="ticker-change ticker-down">▼ 0,08%</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <header id="masthead" class="site-header">
            <div class="container header-inner">
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="Abrir menu" aria-expanded="false">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_uscursosesc.png" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="site-logo site-logo--mobile">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_uscursosesc_desktop.png" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="site-logo site-logo--desktop">
                    </a>
                </div>
                
                <!-- Spacer para alinhar o título -->
                <div class="header-spacer"></div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div class="mobile-nav-drawer" id="mobile-nav">
                <div class="mobile-nav-header">
                    <span class="mobile-nav-title"><?php bloginfo('name'); ?></span>
                    <button class="mobile-nav-close" aria-label="Fechar menu">&times;</button>
                </div>
                
                <!-- Menu Principal -->
                <nav class="mobile-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id' => 'mobile-menu',
                            'container' => false,
                            'fallback_cb' => 'winup_fallback_menu',
                        )
                    );
                    ?>
                </nav>
                
                <!-- Links Úteis do Blog -->
                <div class="mobile-nav-section">
                    <span class="mobile-nav-section-title">Sobre</span>
                    <ul class="mobile-nav-links">
                        <li><a href="<?php echo home_url('/sobre'); ?>">Quem Somos</a></li>
                        <li><a href="<?php echo home_url('/contato'); ?>">Contato</a></li>
                        <li><a href="<?php echo home_url('/politica-de-privacidade'); ?>">Privacidade</a></li>
                        <li><a href="<?php echo home_url('/termos-de-uso'); ?>">Termos de Uso</a></li>
                    </ul>
                </div>
                
                <!-- Newsletter no Menu Mobile -->
                <div class="mobile-nav-newsletter">
                    <div class="newsletter-box">
                        <span class="newsletter-icon">📧</span>
                        <div class="newsletter-text">
                            <strong>Newsletter Gratuita</strong>
                            <small>Receba dicas de finanças no seu e-mail</small>
                        </div>
                    </div>
                    <a href="#newsletter" class="mobile-newsletter-btn">Quero Receber</a>
                </div>
            </div>
            <div class="mobile-nav-overlay" id="mobile-nav-overlay"></div>

            <!-- Desktop Navbar -->
            <div class="nav-container-wrapper desktop-only">
                <div class="container nav-container">
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => false,
                                'fallback_cb' => 'winup_fallback_menu',
                            )
                        );
                        ?>
                    </nav>
                    <div class="nav-secondary-links">
                        <a href="<?php echo home_url('/sobre'); ?>">Sobre</a>
                        <a href="<?php echo home_url('/contato'); ?>">Contato</a>
                    </div>
                </div>
            </div>
        </header>

        <script>
        (function() {
            var toggle = document.querySelector('.mobile-menu-toggle');
            var drawer = document.getElementById('mobile-nav');
            var overlay = document.getElementById('mobile-nav-overlay');
            var closeBtn = document.querySelector('.mobile-nav-close');
            var body = document.body;
            
            function openMenu() {
                drawer.classList.add('is-open');
                overlay.classList.add('is-visible');
                body.classList.add('menu-open');
                toggle.setAttribute('aria-expanded', 'true');
            }
            
            function closeMenu() {
                drawer.classList.remove('is-open');
                overlay.classList.remove('is-visible');
                body.classList.remove('menu-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
            
            if (toggle) toggle.addEventListener('click', openMenu);
            if (closeBtn) closeBtn.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeMenu();
            });
            
            // Fechar menu ao clicar em links
            var menuLinks = drawer.querySelectorAll('a');
            menuLinks.forEach(function(link) {
                link.addEventListener('click', closeMenu);
            });
        })();
        </script>