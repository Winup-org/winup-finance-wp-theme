<?php
get_header();

// Renderiza a barra de progresso de leitura
if (function_exists('winup_reading_progress_bar')) {
    winup_reading_progress_bar();
}
?>

<div class="site-content-wrapper container single-layout-wrapper">
    
    <!-- Main Content Column -->
    <main id="primary" class="site-main article-column">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header wsj-header">
                    <!-- 1. Categoria -->
                    <div class="wsj-category">
                        <?php the_category(' '); ?>
                    </div>
                    
                    <!-- 2. Título (40px - DM Serif Display) -->
                    <?php the_title('<h1 class="wsj-title">', '</h1>'); ?>
                    
                    <!-- 3. Subtítulo (20px - Source Sans 3 Light) -->
                    <?php if (has_excerpt()): ?>
                        <p class="wsj-subtitle"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                    
                    <!-- 4. Escritor (Source Serif 4 Italic) -->
                    <div class="wsj-byline">
                        <span class="wsj-author">By <?php the_author(); ?></span>
                    </div>
                    
                    <!-- 5. Data do Post (Source Serif 4 Regular) -->
                    <div class="wsj-date">
                        <?php echo get_the_date('F j, Y'); ?> at <?php echo get_the_time('g:i A'); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    // Ads are injected via filter in functions.php
                    the_content();
                    ?>
                </div>

                <?php
                // Note: In-content ads (end of post, between paragraphs) are managed by Ad Inserter plugin
                ?>

            </article>

            <!-- Post Navigation (Prev/Next) -->
            <nav class="post-navigation">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post): ?>
                        <div class="nav-previous">
                            <span class="nav-subtitle">&larr; Previous Article</span>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="nav-title">
                                <?php echo get_the_title($prev_post); ?>
                            </a>
                        </div>
                    <?php endif;
                    
                    if ($next_post): ?>
                        <div class="nav-next">
                            <span class="nav-subtitle">Next Article &rarr;</span>
                            <a href="<?php echo get_permalink($next_post); ?>" class="nav-title">
                                <?php echo get_the_title($next_post); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Newsletter Box (Mobile Only) -->
            <div class="mobile-newsletter-section">
                <div class="sidebar-newsletter-box" id="newsletter-mobile">
                    <div class="newsletter-header">
                        <span class="newsletter-emoji">📧</span>
                        <h3 class="newsletter-title">Free Newsletter</h3>
                    </div>
                    <p class="newsletter-desc">Get the best personal finance tips delivered to your inbox.</p>
                    <form class="newsletter-form" action="#" method="post">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                    <small class="newsletter-privacy">🔒 Your data is safe. No spam.</small>
                </div>
            </div>



            <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

    <!-- Sidebar (Desktop Only) -->
    <aside id="secondary" class="single-sidebar">
        
        <?php
        // Ad Sidebar (Desktop) - Only show if enabled
        $ad_sidebar_enabled = get_option('winup_ad_sidebar_enabled', '0');
        $ad_sidebar = winup_get_option('winup_ad_sidebar', '');
        if ($ad_sidebar_enabled === '1' && !empty($ad_sidebar)): ?>
            <div class="winup-ad-slot winup-ad-sidebar">
                <?php echo $ad_sidebar; ?>
            </div>
        <?php endif; ?>

        <!-- Newsletter Box - After advertising -->
        <div class="sidebar-newsletter-box" id="newsletter">
            <div class="newsletter-header">
                <span class="newsletter-emoji">📧</span>
                <h3 class="newsletter-title">Free Newsletter</h3>
            </div>
            <p class="newsletter-desc">Get the best personal finance tips delivered to your inbox.</p>
            <form class="newsletter-form" action="#" method="post">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
            <small class="newsletter-privacy">🔒 Your data is safe. No spam.</small>
        </div>
    </aside>

</div><!-- .site-content-wrapper -->

<!-- Related Posts - Full Width -->
<div class="container related-posts-full-width">
    <?php
    // Related Content - 4 posts em grid
    if (function_exists('winup_related_posts')) {
        winup_related_posts();
    }
    ?>
</div>

<?php
// Sticky Anchor Ad (Mobile Only) - Only show if enabled
$ad_sticky_mobile_enabled = get_option('winup_ad_sticky_mobile_enabled', '0');
$ad_sticky_mobile = winup_get_option('winup_ad_sticky_mobile', '');

if ($ad_sticky_mobile_enabled === '1' && !empty($ad_sticky_mobile)):
?>
<div class="winup-sticky-anchor-ad">
    <?php echo $ad_sticky_mobile; ?>
    <button class="sticky-ad-close" aria-label="Close ad">&times;</button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var closeBtn = document.querySelector('.sticky-ad-close');
    var stickyAd = document.querySelector('.winup-sticky-anchor-ad');
    if (closeBtn && stickyAd) {
        closeBtn.addEventListener('click', function() {
            stickyAd.style.display = 'none';
        });
    }
});
</script>
<?php endif; ?>

<?php
get_footer();
