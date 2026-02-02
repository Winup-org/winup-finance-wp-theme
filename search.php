<?php
/**
 * Search Results Template
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">

        <!-- Search Header -->
        <header class="archive-header search-header">
            <span class="archive-label">Search Results</span>
            <h1 class="archive-title">
                <?php printf(esc_html__('"%s"', 'winup-finance'), '<span>' . get_search_query() . '</span>'); ?>
            </h1>
            <p class="archive-description">
                <?php
                global $wp_query;
                $found = $wp_query->found_posts;
                printf(esc_html(_n('%s result found', '%s results found', $found, 'winup-finance')), number_format_i18n($found));
                ?>
            </p>
        </header>

        <?php if (have_posts()): ?>

            <!-- Posts Grid -->
            <div class="archive-grid">
                <?php
                while (have_posts()):
                    the_post();
                    $cats = get_the_category();
                    $cat_name = $cats ? $cats[0]->name : '';
                    ?>
                    <article <?php post_class('archive-card'); ?>>
                        <a href="<?php the_permalink(); ?>" class="archive-card-link">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="archive-card-thumb">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </div>
                            <?php else: ?>
                                <div class="archive-card-thumb placeholder-thumb"></div>
                            <?php endif; ?>

                            <div class="archive-card-content">
                                <?php if ($cat_name): ?>
                                    <span class="archive-card-cat">
                                        <?php echo esc_html($cat_name); ?>
                                    </span>
                                <?php endif; ?>
                                <h2 class="archive-card-title">
                                    <?php the_title(); ?>
                                </h2>
                                <p class="archive-card-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </p>
                                <span class="archive-card-date">
                                    <?php echo get_the_date('M j, Y'); ?>
                                </span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <nav class="archive-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                ));
                ?>
            </nav>

        <?php else: ?>

            <div class="no-posts search-no-results">
                <h2>No results found</h2>
                <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>

                <div class="search-form-wrapper">
                    <?php get_search_form(); ?>
                </div>

                <a href="<?php echo home_url(); ?>" class="btn-back-home">Back to Homepage</a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
