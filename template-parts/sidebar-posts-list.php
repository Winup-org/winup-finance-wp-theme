<?php
/**
 * Custom Sidebar with Post List (No images)
 */

// Query para posts populares ou recentes (ignora os atuais se possível, mas aqui faremos query simples)
$sidebar_args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'ignore_sticky_posts' => true,
    'orderby' => 'date',
    'order' => 'DESC',
    // 'offset' => 5 // Opcional: pular os que já estão no main loop
);

$sidebar_query = new WP_Query($sidebar_args);

if ($sidebar_query->have_posts()) :
?>
    <div class="wsj-sidebar-list">
        <h3 class="wsj-sidebar-title">More Stories</h3>
        <ul class="wsj-sidebar-items">
            <?php while ($sidebar_query->have_posts()) : $sidebar_query->the_post(); ?>
                <li class="wsj-sidebar-item">
                    <span class="wsj-sidebar-cat"><?php 
                        $cats = get_the_category();
                        echo $cats ? esc_html($cats[0]->name) : 'News';
                    ?></span>
                    <a href="<?php the_permalink(); ?>" class="wsj-sidebar-link">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="#" class="wsj-sidebar-view-all">View All Archives &rarr;</a>
    </div>
<?php
    wp_reset_postdata();
endif;
?>
