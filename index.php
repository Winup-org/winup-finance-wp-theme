<?php
get_header();
?>

<div class="site-content-wrapper container">
    <main id="primary" class="site-main">

        <?php if (have_posts()) : ?>
            
            <div class="wsj-grid-wrapper">
                
                <?php
                $post_count = 0;
                while (have_posts()) {
                    the_post();
                    $post_count++;

                    // 1. Destaque Principal (Hero)
                    if ($post_count === 1) {
                        get_template_part('template-parts/content', 'hero');
                    }
                    
                    // 2. Abertura do Grid Secundário (Highlights)
                    elseif ($post_count === 2) {
                        echo '<div class="wsj-secondary-grid">';
                        get_template_part('template-parts/content', 'highlight');
                    }

                    // 3. Grid Secundário (Continuação)
                    elseif ($post_count > 2 && $post_count <= 4) {
                        get_template_part('template-parts/content', 'highlight');
                        
                        // Fechamento da Section Highlights
                        if ($post_count === 4 || $post_count === $wp_query->post_count) {
                            echo '</div><!-- .wsj-secondary-grid -->';
                            echo '<div class="wsj-divider-fat"></div>';
                        }
                    }

                    // 4. Abertura da Lista de Notícias (Feed + Sidebar)
                    elseif ($post_count === 5) {
                        if ($post_count === 5 && $wp_query->post_count < 5) { /* Caso não tenha atingido 5 posts */ }
                        
                        echo '<div class="wsj-main-content-area">';
                        echo '<div class="wsj-news-feed">';
                        echo '<h4 class="section-label">Latest News</h4>';
                        get_template_part('template-parts/content', 'list-item');
                    }

                    // 5. Lista de Notícias (Continuação)
                    else {
                        get_template_part('template-parts/content', 'list-item');
                    }

                }

                // Fechamento das áreas se o loop terminar
                if ($post_count >= 5) {
                    echo '</div><!-- .wsj-news-feed -->';
                    
                    // Sidebar Área (Integrada no Grid)
                    echo '<aside class="wsj-main-sidebar">';
                    // Sidebar Customizada (Lista de Posts)
                    echo '<aside class="wsj-main-sidebar">';
                    get_template_part('template-parts/sidebar-posts-list');
                    echo '</aside>';
                    
                    echo '</div><!-- .wsj-main-content-area -->';
                }
                
                // Caso raríssimo de ter entre 2 e 4 posts apenas e não fechar a div corretamente acima
                if ($post_count > 1 && $post_count < 4) {
                     echo '</div><!-- .wsj-secondary-grid (fallback close) -->';
                }

                ?>

            </div> <!-- .wsj-grid-wrapper -->

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&larr; Previous', 'winup-finance'),
                'next_text' => __('Next &rarr;', 'winup-finance'),
            ));

        else :
            // Empty state
            echo '<p>No contents found.</p>';
        endif;
        ?>
    </main>
</div> <!-- .site-content-wrapper -->

<?php
get_footer();
