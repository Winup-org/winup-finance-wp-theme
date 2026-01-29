<footer id="colophon" class="site-footer">
    <div class="container footer-grid">

        <!-- Column 1: Brand & About -->
        <div class="footer-col brand-col">
            <h3 class="footer-title"><?php bloginfo('name'); ?></h3>
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

    <div class="container site-bottom">
        <span class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights
            reserved.</span>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>