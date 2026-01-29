<?php
get_header();
?>

<div class="site-content-wrapper container single-centered">

    <!-- Main Content Column (Centered) -->
    <main id="primary" class="site-main article-column">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <!-- Breadcrumbs -->
            <?php if (function_exists('winup_breadcrumb'))
                winup_breadcrumb(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header centered-header">
                    <div class="header-meta">
                        <span class="cat-label"><?php the_category(', '); ?></span>
                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                    </div>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <div class="entry-subhead">
                        <?php if (has_excerpt())
                            echo '<p class="lead-text">' . get_the_excerpt() . '</p>'; ?>
                    </div>

                    <div class="author-meta-row centered-meta">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                        </div>
                        <div class="author-details">
                            <span class="author-name">By <?php the_author_posts_link(); ?></span>
                            <span class="read-time">5 min read</span>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="feature-image-wrapper">
                            <?php the_post_thumbnail('winup-hero'); ?>
                            <?php if (get_post_thumbnail_id()):
                                $caption = wp_get_attachment_caption(get_post_thumbnail_id());
                                if ($caption)
                                    echo '<figcaption class="wp-caption-text">' . $caption . '</figcaption>';
                            endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php
                    // Ads are injected via filter in functions.php
                    the_content();
                    ?>
                </div>

                <?php
                // Manual Ad Slot #4
                $ad_4 = get_theme_mod('winup_ad_4', '');
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

    <!-- No Sidebar for Single Post per user request -->

</div><!-- .site-content-wrapper -->
<?php
get_footer();
