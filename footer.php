<footer id="colophon" class="site-footer">
    <div class="container footer-grid">

        <!-- Column 1: Brand & About -->
        <div class="footer-col brand-col">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="footer-logo-link">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_uscursosesc_blackbg.png" 
                     alt="<?php bloginfo('name'); ?>" 
                     class="footer-logo">
            </a>
            <p class="footer-desc"><?php bloginfo('description'); ?></p>
            <div class="social-links-footer">
                <!-- Demo Socials -->
                <a href="#">Twitter</a>
                <a href="#">LinkedIn</a>
                <a href="#">RSS</a>
            </div>
        </div>

        <!-- Column 2: Navigation -->
        <div class="footer-col nav-col">
            <h3 class="footer-title">Sections</h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'depth' => 1,
                'fallback_cb' => false,
            ));
            ?>
        </div>

        <!-- Column 3: Legal / Disclaimer -->
        <div class="footer-col legal-col">
            <h3 class="footer-title">Legal & Trust</h3>
            <p class="disclaimer-text">
                <strong>Disclaimer:</strong> Content on <?php bloginfo('name'); ?> is for informational purposes only
                and does not constitute financial advice. Always consult a certified professional before making
                financial decisions.
            </p>
            <div class="legal-links">
                <a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a>
                <a href="<?php echo home_url('/terms-of-service'); ?>">Terms of Service</a>
                <a href="<?php echo home_url('/editorial-guidelines'); ?>">Editorial Guidelines</a>
            </div>
        </div>

    </div>

    <!-- Trust Badges (Credibilidade) -->
    <div class="container trust-badges-container">
        <div class="trust-badges">
            <div class="trust-badge trust-badge--secure">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <span>SSL Secure</span>
            </div>
            <div class="trust-badge trust-badge--verified">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>Verified Content</span>
            </div>
            <div class="trust-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Expert Reviewed</span>
            </div>
        </div>
    </div>

    <div class="container site-bottom">
        <span class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights
            reserved.</span>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>