<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('sidebar-1'); ?>

    <!-- Hardcoded "Trending" Widget if sidebar is empty (Fallback) -->
    <?php if (!is_active_sidebar('sidebar-1')): ?>
        <section class="widget widget_recent_entries">
            <h2 class="widget-title">Trending Stories</h2>
            <ul>
                <?php
                $args = array('posts_per_page' => 5, 'ignore_sticky_posts' => 1);
                $trending = new WP_Query($args);
                if ($trending->have_posts()):
                    while ($trending->have_posts()):
                        $trending->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                            <span class="post-date">
                                <?php echo get_the_date('M j'); ?>
                            </span>
                        </li>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </ul>
        </section>

        <section class="widget widget_categories">
            <h2 class="widget-title">Market Sectors</h2>
            <ul>
                <?php wp_list_categories(array('title_li' => '')); ?>
            </ul>
        </section>
    <?php endif; ?>
</aside><!-- #secondary -->