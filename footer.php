<?php
/**
 * The template for displaying the footer (Minimal Layout)
 *
 * @package Winup_Finance
 */
?>

<footer id="colophon" class="minimal-footer">
    <div class="container footer-stack">
        
        <!-- Logo Section -->
        <div class="minimal-footer-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="footer-logo-link">
                <?php bloginfo('name'); ?>
            </a>
        </div>

        <!-- Disclaimer Section -->
        <div class="minimal-disclaimer">
            <h5 class="disclaimer-label">Disclaimer</h5>
            <p>
                The information on <?php bloginfo('name'); ?> (<?php echo $_SERVER['HTTP_HOST']; ?>) is provided for informational purposes only. While we strive for accuracy, we do not guarantee the reliability of any data, including third-party data such as job offers or loan and credit card offers. We recommend that you check the information before making any decisions. <?php bloginfo('name'); ?> uses Google AdSense for personalized advertising. We do not endorse the products or services promoted. Use of the site implies acceptance of our terms and conditions and privacy policy.
            </p>
        </div>

        <!-- Links Section (Dynamic) -->
        <div class="minimal-footer-nav">
            <?php
            // Dynamic footer links - synced with auto-created pages
            $footer_pages = array(
                'about'            => 'About Us',
                'contact'          => 'Contact',
                'privacy-policy'   => 'Privacy Policy',
                'terms-of-service' => 'Terms of Service'
            );
            
            foreach ($footer_pages as $slug => $title) {
                $page = get_page_by_path($slug);
                if ($page) {
                    echo '<a href="' . get_permalink($page->ID) . '">' . esc_html($title) . '</a>';
                }
            }
            ?>
        </div>

        <!-- Copyright -->
        <div class="minimal-copyright">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
        </div>
    </div>
</footer>

</div><!-- #page -->

<script>
// Reading Progress Bar Script - Com curva psicológica de retenção
// A barra avança mais rápido no início e desacelera no final
document.addEventListener('DOMContentLoaded', function() {
    var progressBar = document.getElementById('winupProgressFill');
    if (!progressBar) return;
    
    // Função de easing: faz a barra parecer avançar mais rápido no início
    // Expoente < 1 = rápido no início, lento no fim
    function easeProgress(realPercent) {
        // Usando função de potência com expoente 0.55
        // Exemplos de mapeamento:
        // 10% real → ~24% visual
        // 25% real → ~42% visual
        // 50% real → ~63% visual
        // 75% real → ~82% visual
        // 100% real → 100% visual
        return 100 * Math.pow(realPercent / 100, 0.55);
    }
    
    window.addEventListener('scroll', function() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var realPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        
        // Aplicar a curva psicológica
        var visualPercent = easeProgress(realPercent);
        
        progressBar.style.width = visualPercent + '%';
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>