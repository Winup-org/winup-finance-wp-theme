<?php
/**
 * 404 Error Page Template
 * 
 * @package Winup_Finance
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <div class="error-404-wrapper">
            <div class="error-404-content">
                <span class="error-404-code">404</span>
                <h1 class="error-404-title">Page Not Found</h1>
                <p class="error-404-message">
                    Sorry, the page you're looking for doesn't exist or has been moved.
                </p>
                <a href="<?php echo home_url(); ?>" class="error-404-btn">
                    &larr; Back to Homepage
                </a>
            </div>

            <!-- Suggested Articles -->
            <div class="error-404-suggestions">
                <h2>You might be interested in:</h2>
                <div class="suggestions-grid">
                    <?php
                    $recent_posts = new WP_Query(array(
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    if ($recent_posts->have_posts()) :
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            $cats = get_the_category();
                            $cat_name = $cats ? $cats[0]->name : '';
                    ?>
                        <article class="suggestion-card">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="suggestion-thumb">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="suggestion-content">
                                    <?php if ($cat_name) : ?>
                                        <span class="suggestion-cat"><?php echo esc_html($cat_name); ?></span>
                                    <?php endif; ?>
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();
