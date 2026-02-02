<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#003366">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Source+Sans+3:wght@300;400;600&family=Source+Serif+4:ital,wght@0,400;1,400&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <!-- Currency Ticker - Real-time USD Rates -->
        <div class="ticker-bar">
            <div class="ticker-wrapper">
                <div class="ticker-content" id="ticker-content">
                    <!-- Loading placeholder - JS will populate with real data -->
                    <span class="ticker-item">
                        <span class="ticker-label">Loading rates...</span>
                    </span>
                </div>
            </div>
        </div>

        <script>
            // Fetch real-time currency rates from Frankfurter API
            (function () {
                const currencies = [
                    { code: 'EUR', flag: '🇪🇺', name: 'EUR/USD' },
                    { code: 'GBP', flag: '🇬🇧', name: 'GBP/USD' },
                    { code: 'JPY', flag: '🇯🇵', name: 'USD/JPY' },
                    { code: 'CAD', flag: '🇨🇦', name: 'USD/CAD' },
                    { code: 'AUD', flag: '🇦🇺', name: 'AUD/USD' },
                    { code: 'CHF', flag: '🇨🇭', name: 'USD/CHF' }
                ];

                async function fetchRates() {
                    try {
                        // Get current rates
                        const response = await fetch('https://api.frankfurter.app/latest?from=USD&to=EUR,GBP,JPY,CAD,AUD,CHF');
                        const data = await response.json();

                        // Get yesterday's rates for comparison
                        const yesterday = new Date();
                        yesterday.setDate(yesterday.getDate() - 1);
                        const dateStr = yesterday.toISOString().split('T')[0];
                        const responseYesterday = await fetch(`https://api.frankfurter.app/${dateStr}?from=USD&to=EUR,GBP,JPY,CAD,AUD,CHF`);
                        const dataYesterday = await responseYesterday.json();

                        updateTicker(data.rates, dataYesterday.rates);
                    } catch (error) {
                        console.error('Error fetching rates:', error);
                        // Fallback to static values
                        document.getElementById('ticker-content').innerHTML = generateFallbackTicker();
                    }
                }

                function updateTicker(current, previous) {
                    let html = '';

                    currencies.forEach(curr => {
                        const rate = current[curr.code];
                        const prevRate = previous[curr.code];
                        const change = ((rate - prevRate) / prevRate * 100).toFixed(2);
                        const isUp = change >= 0;

                        // Format display based on currency pair convention
                        let displayRate;
                        if (curr.code === 'JPY') {
                            displayRate = (1 / rate).toFixed(2); // USD/JPY shows how many JPY per USD
                        } else if (curr.code === 'EUR' || curr.code === 'GBP' || curr.code === 'AUD') {
                            displayRate = (1 / rate).toFixed(4); // These are quoted as XXX/USD
                        } else {
                            displayRate = rate.toFixed(4); // USD/XXX
                        }

                        html += `
                        <span class="ticker-item">
                            <span class="ticker-label">${curr.flag} ${curr.name}</span>
                            <span class="ticker-value">${displayRate}</span>
                            <span class="ticker-change ${isUp ? 'ticker-up' : 'ticker-down'}">${isUp ? '▲' : '▼'} ${Math.abs(change)}%</span>
                        </span>
                    `;
                    });

                    // Duplicate for infinite scroll effect
                    html += html;

                    document.getElementById('ticker-content').innerHTML = html;
                }

                function generateFallbackTicker() {
                    return `
                    <span class="ticker-item"><span class="ticker-label">🇪🇺 EUR/USD</span><span class="ticker-value">1.0850</span><span class="ticker-change ticker-up">▲ 0.12%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇬🇧 GBP/USD</span><span class="ticker-value">1.2715</span><span class="ticker-change ticker-up">▲ 0.08%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇯🇵 USD/JPY</span><span class="ticker-value">148.25</span><span class="ticker-change ticker-down">▼ 0.15%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇨🇦 USD/CAD</span><span class="ticker-value">1.3425</span><span class="ticker-change ticker-up">▲ 0.05%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇦🇺 AUD/USD</span><span class="ticker-value">0.6580</span><span class="ticker-change ticker-down">▼ 0.22%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇨🇭 USD/CHF</span><span class="ticker-value">0.8645</span><span class="ticker-change ticker-up">▲ 0.10%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇪🇺 EUR/USD</span><span class="ticker-value">1.0850</span><span class="ticker-change ticker-up">▲ 0.12%</span></span>
                    <span class="ticker-item"><span class="ticker-label">🇬🇧 GBP/USD</span><span class="ticker-value">1.2715</span><span class="ticker-change ticker-up">▲ 0.08%</span></span>
                `;
                }

                // Fetch on load
                fetchRates();

                // Refresh every 5 minutes
                setInterval(fetchRates, 5 * 60 * 1000);
            })();
        </script>

        <!-- Main Header -->
        <header id="masthead" class="site-header">
            <div class="container header-inner">
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="Open menu" aria-expanded="false">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_uscursosesc.png"
                            alt="<?php bloginfo('name'); ?>" class="site-logo site-logo--mobile">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_uscursosesc_desktop.png"
                            alt="<?php bloginfo('name'); ?>" class="site-logo site-logo--desktop">
                    </a>
                </div>

                <!-- Spacer para alinhar o título -->
                <div class="header-spacer"></div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div class="mobile-nav-drawer" id="mobile-nav">
                <div class="mobile-nav-header">
                    <span class="mobile-nav-title"><?php bloginfo('name'); ?></span>
                    <button class="mobile-nav-close" aria-label="Close menu">&times;</button>
                </div>

                <!-- Search Mobile (Inside Drawer) -->
                <div class="mobile-search-box">
                    <form role="search" method="get" class="mobile-search-form"
                        action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="mobile-search-field" placeholder="Search..."
                            value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="mobile-search-submit" aria-label="Search">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
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

                <!-- Newsletter no Menu Mobile -->
                <div class="mobile-nav-newsletter">
                    <div class="newsletter-box">
                        <span class="newsletter-icon">📧</span>
                        <div class="newsletter-text">
                            <strong>Free Newsletter</strong>
                            <small>Get finance tips in your inbox</small>
                        </div>
                    </div>
                    <a href="#newsletter" class="mobile-newsletter-btn">Subscribe Now</a>
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

                    <div class="header-tools">
                        <!-- Desktop Inline Search -->
                        <div class="desktop-search-wrapper">
                            <form role="search" method="get" class="desktop-search-form"
                                action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="search" class="desktop-search-field" placeholder="Search..."
                                    value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                                <button type="submit" class="desktop-search-submit" aria-label="Search">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reading Progress Bar (Mobile Only) - Fixo na base do header -->
            <div id="winupProgressWrap"
                style="position:absolute;bottom:0;left:0;right:0;width:100%;height:3px;background:rgba(0,0,0,0.1);z-index:1001;display:none;overflow:hidden;pointer-events:none;">
                <div id="winupProgressFill"
                    style="display:block;position:absolute;top:0;left:0;height:100%;width:0%;background:#002244;transition:width 0.05s linear;">
                </div>
            </div>
            <script>
                // Mostrar barra apenas no mobile
                (function () {
                    var wrap = document.getElementById('winupProgressWrap');
                    function checkMobile() {
                        if (wrap) {
                            wrap.style.display = window.innerWidth <= 768 ? 'block' : 'none';
                        }
                    }
                    checkMobile();
                    window.addEventListener('resize', checkMobile);
                })();
            </script>
        </header>

        <script>
            (function () {
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

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') closeMenu();
                });

                // Fechar menu ao clicar em links
                var menuLinks = drawer.querySelectorAll('a');
                menuLinks.forEach(function (link) {
                    link.addEventListener('click', closeMenu);
                });
            })();
        </script>