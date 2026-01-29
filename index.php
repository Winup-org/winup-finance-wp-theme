<?php
get_header();
?>

<div class="site-content-wrapper container">
    <main id="primary" class="site-main">

        <?php if (have_posts()): ?>
            <div class="posts-grid-wrapper">
                <?php
                $post_count = 0;

                while (have_posts()):
                    the_post();
                    $post_count++;

                    // First post is Featured Hero
                    if ($post_count === 1):
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-hero'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('winup-hero'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="hero-content">
                                <span class="cat-label"><?php the_category(' / '); ?></span>
                                <?php the_title(sprintf('<h2 class="entry-title hero-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                                <div class="entry-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="entry-meta">
                                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                                    <span class="byline"> by <?php the_author(); ?></span>
                                </div>
                            </div>
                        </article>
                        <div class="secondary-grid"> <!-- Start Grid for subsequent posts -->

                        <?php else:  // Standard Grid Posts ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-grid-item'); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('winup-grid'); ?>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <!-- Fallback placeholder for grid consistency -->
                                    <div class="post-thumbnail placeholder-thumb"></div>
                                <?php endif; ?>

                                <header class="entry-header">
                                    <span
                                        class="cat-label-small"><?php $cats = get_the_category();
                                        echo $cats ? $cats[0]->name : ''; ?></span>
                                    <?php the_title(sprintf('<h3 class="entry-title grid-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                                    <div class="entry-meta-small">
                                        <span class="posted-on"><?php echo get_the_date('M j, Y'); ?></span>
                                    </div>
                                </header>
                            </article>

                        <?php endif; ?>

                    <?php endwhile; ?>
                </div> <!-- End secondary-grid -->
            </div> <!-- End posts-grid-wrapper -->

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&larr; Previous', 'winup-finance'),
                'next_text' => __('Next &rarr;', 'winup-finance'),
            ));

        else:
            // Empty state...
        endif;
        ?>
    </main>
</div> <!-- .site-content-wrapper -->

<?php
get_footer();
