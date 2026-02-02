<?php
/**
 * Archive Template - Categories, Tags, Dates
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <?php
            if (is_category()) {
                echo '<span class="archive-label">Category</span>';
                echo '<h1 class="archive-title">' . single_cat_title('', false) . '</h1>';
                if (category_description()) {
                    echo '<div class="archive-description">' . category_description() . '</div>';
                }
            } elseif (is_tag()) {
                echo '<span class="archive-label">Tag</span>';
                echo '<h1 class="archive-title">#' . single_tag_title('', false) . '</h1>';
                if (tag_description()) {
                    echo '<div class="archive-description">' . tag_description() . '</div>';
                }
            } elseif (is_date()) {
                echo '<span class="archive-label">Archive</span>';
                if (is_day()) {
                    echo '<h1 class="archive-title">' . get_the_date() . '</h1>';
                } elseif (is_month()) {
                    echo '<h1 class="archive-title">' . get_the_date('F Y') . '</h1>';
                } elseif (is_year()) {
                    echo '<h1 class="archive-title">' . get_the_date('Y') . '</h1>';
                }
            } else {
                echo '<h1 class="archive-title">Archives</h1>';
            }
            ?>
        </header>

        <?php if (have_posts()) : ?>
            
            <!-- Posts Grid -->
            <div class="archive-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    $cats = get_the_category();
                    $cat_name = $cats ? $cats[0]->name : '';
                ?>
                    <article <?php post_class('archive-card'); ?>>
                        <a href="<?php the_permalink(); ?>" class="archive-card-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="archive-card-thumb">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="archive-card-thumb placeholder-thumb"></div>
                            <?php endif; ?>
                            
                            <div class="archive-card-content">
                                <?php if ($cat_name) : ?>
                                    <span class="archive-card-cat"><?php echo esc_html($cat_name); ?></span>
                                <?php endif; ?>
                                <h2 class="archive-card-title"><?php the_title(); ?></h2>
                                <p class="archive-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <span class="archive-card-date"><?php echo get_the_date('M j, Y'); ?></span>
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

        <?php else : ?>
            
            <div class="no-posts">
                <h2>No posts found</h2>
                <p>There are no posts in this archive yet.</p>
                <a href="<?php echo home_url(); ?>" class="btn-back-home">Back to Homepage</a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
