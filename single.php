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
                        <span class="wsj-author">Por <?php the_author(); ?></span>
                    </div>
                    
                    <!-- 5. Data do Post (Source Serif 4 Regular) -->
                    <div class="wsj-date">
                        <?php echo get_the_date('j \d\e F, Y'); ?> às <?php echo get_the_time('H:i'); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    // Ads are injected via filter in functions.php
                    the_content();
                    ?>
                </div>

                <?php
                // Manual Ad Slot #4 (Fim do Post)
                $ad_4 = winup_get_option('winup_ad_4', '');
                if (!empty($ad_4)): ?>
                    <div class="winup-ad-slot winup-ad-4">
                        <?php echo $ad_4; ?>
                    </div>
                <?php endif; ?>

                <!-- Author Box (E-E-A-T) -->
                <div class="author-box">
                    <div class="author-bio-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-bio-content">
                        <h4>About <?php the_author(); ?></h4>
                        <p><?php the_author_meta('description'); ?></p>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">View all posts
                            &rarr;</a>
                    </div>
                </div>

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

            <?php
            // Related Content
            if (function_exists('winup_related_posts')) {
                winup_related_posts();
            }
            ?>

            <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

    <!-- Sidebar (Desktop Only) -->
    <aside id="secondary" class="single-sidebar">
        
        <!-- Newsletter Box -->
        <div class="sidebar-newsletter-box" id="newsletter">
            <div class="newsletter-header">
                <span class="newsletter-emoji">📧</span>
                <h3 class="newsletter-title">Newsletter Gratuita</h3>
            </div>
            <p class="newsletter-desc">Receba as melhores dicas de finanças pessoais diretamente no seu e-mail.</p>
            <form class="newsletter-form" action="#" method="post">
                <input type="email" name="email" placeholder="Seu melhor e-mail" required>
                <button type="submit">Inscrever-se</button>
            </form>
            <small class="newsletter-privacy">🔒 Seus dados estão seguros. Sem spam.</small>
        </div>

        <?php
        // Ad Sidebar (Desktop)
        $ad_sidebar = winup_get_option('winup_ad_sidebar', '');
        if (!empty($ad_sidebar)): ?>
            <div class="winup-ad-slot winup-ad-sidebar sticky-sidebar-ad">
                <?php echo $ad_sidebar; ?>
            </div>
        <?php else: ?>
            <div class="winup-ad-slot winup-ad-sidebar sticky-sidebar-ad">
                <div style="background:#f4f4f4; width:300px; height:600px; display:flex; align-items:center; justify-content:center; border:1px dashed #999; color:#555; font-weight:bold; font-family:sans-serif;">
                    SIDEBAR AD (300x600)
                </div>
            </div>
        <?php endif; ?>
    </aside>

</div><!-- .site-content-wrapper -->

<?php
// Sticky Anchor Ad (Mobile Only)
$ad_sticky_mobile = winup_get_option('winup_ad_sticky_mobile', '');
?>
<div class="winup-sticky-anchor-ad">
    <?php if (!empty($ad_sticky_mobile)): ?>
        <?php echo $ad_sticky_mobile; ?>
    <?php else: ?>
        <div class="sticky-ad-placeholder">
            <span>MOBILE AD (320x50)</span>
        </div>
    <?php endif; ?>
    <button class="sticky-ad-close" aria-label="Fechar anúncio">&times;</button>
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

<?php
get_footer();
