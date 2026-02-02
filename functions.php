<?php
/**
 * Winup Finance functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Setup do Tema
 */
/**
 * Theme Options Panel
 */
require get_template_directory() . '/inc/theme-options.php';

function winup_setup()
{
    // Suporte a Título da Página automático
    add_theme_support('title-tag');

    // Suporte a Imagens destacados
    add_theme_support('post-thumbnails');

    // Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'winup-finance'),
    ));

    // HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
}
add_action('after_setup_theme', 'winup_setup');

/**
 * Auto-create essential pages on theme activation
 */
function winup_create_pages() {
    // Define pages to create
    $pages = array(
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'page-contact.php',
            'content'  => '<!-- Add your contact form shortcode here (Contact Form 7, WPForms, etc.) -->'
        ),
        array(
            'title'    => 'About Us',
            'slug'     => 'about',
            'template' => 'page-about.php',
            'content'  => ''
        ),
        array(
            'title'    => 'Privacy Policy',
            'slug'     => 'privacy-policy',
            'template' => 'page-privacy.php',
            'content'  => ''
        ),
        array(
            'title'    => 'Terms of Service',
            'slug'     => 'terms-of-service',
            'template' => 'page-terms.php',
            'content'  => ''
        )
    );

    foreach ($pages as $page) {
        // Check if page already exists
        $existing = get_page_by_path($page['slug']);
        
        if (!$existing) {
            // Create the page
            $page_id = wp_insert_post(array(
                'post_title'   => $page['title'],
                'post_name'    => $page['slug'],
                'post_content' => $page['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1
            ));

            // Set page template
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        }
    }
}
add_action('after_switch_theme', 'winup_create_pages');

/**
 * Enqueue Scripts e Styles
 */
function winup_scripts()
{
    wp_enqueue_style('winup-style', get_stylesheet_uri());
    wp_enqueue_style('winup-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.1.0');

    // Google Fonts: Frank Ruhl Libre (Titles) & Inter (Body/UI)
    wp_enqueue_style('winup-fonts', 'https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@400;500;700;900&family=Inter:wght@400;500;600;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'winup_scripts');

/**
 * Setup Custom Sizes & Title Tag
 */
function winup_config_setup()
{
    add_theme_support('post-thumbnails');
    add_image_size('winup-hero', 1200, 600, true); // Main Highlight
    add_image_size('winup-grid', 600, 400, true); // Grid items
    add_image_size('winup-thumb', 150, 150, true); // Sidebar/List items
}
add_action('after_setup_theme', 'winup_config_setup');

/**
 * Register Sidebar
 */
function winup_widgets_init()
{
    register_sidebar(array(
        'name' => __('Main Sidebar', 'winup-finance'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'winup-finance'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    // Footer Widgets
    register_sidebar(array(
        'name' => __('Footer Column 1', 'winup-finance'),
        'id' => 'footer-1',
        'description' => __('Appears in the first column of footer.', 'winup-finance'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'winup_widgets_init');

/**
 * Limpeza do Head (Otimização)
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Lazy Loading para Imagens (Performance)
 * Adiciona loading="lazy" em todas as imagens do conteúdo
 */
function winup_add_lazy_loading($content)
{
    if (is_admin()) {
        return $content;
    }
    
    // Adiciona loading="lazy" em imagens que não têm o atributo
    $content = preg_replace(
        '/<img((?!loading=)[^>]*)>/i',
        '<img$1 loading="lazy">',
        $content
    );
    
    return $content;
}
add_filter('the_content', 'winup_add_lazy_loading', 99);
add_filter('post_thumbnail_html', 'winup_add_lazy_loading', 99);

/**
 * Breadcrumb Helper
 */
function winup_breadcrumb()
{
    if (is_front_page())
        return;

    echo '<div class="winup-breadcrumb">';
    echo '<a href="' . home_url() . '">Home</a>';
    if (is_category() || is_single()) {
        echo ' &raquo; ';
        $cats = get_the_category();
        if ($cats) {
            echo '<a href="' . get_category_link($cats[0]->term_id) . '">' . $cats[0]->name . '</a>';
        }
    }
    if (is_single()) {
        echo ' &raquo; <span class="current">Article</span>';
    } elseif (is_page()) {
        echo ' &raquo; <span class="current">' . get_the_title() . '</span>';
    }
    echo '</div>';
}

/**
 * Customizer para Ads - Configuração expandida
 */
function winup_customize_register($wp_customize)
{
    // Seção de Ads
    $wp_customize->add_section('winup_ads_section', array(
        'title' => __('Manage Ads', 'winup-finance'),
        'priority' => 30,
    ));

    // Ad 1 (Após 2º Parágrafo - Melhor posição para viewability)
    $wp_customize->add_setting('winup_ad_1', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_1', array(
        'label' => __('Ad #1 (Após 2º Parágrafo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Melhor posição para viewability. Deixe vazio para placeholder.'
    ));

    // Ad 2 (Após 5º Parágrafo)
    $wp_customize->add_setting('winup_ad_2', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_2', array(
        'label' => __('Ad #2 (Após 5º Parágrafo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Deixe vazio para mostrar o placeholder de teste.'
    ));

    // Ad 3 (Fim do Post)
    $wp_customize->add_setting('winup_ad_4', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_4', array(
        'label' => __('Ad #3 (Fim do Conteúdo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Este bloco aparece ao final do post.'
    ));

    // Ad Sidebar (Desktop - 300x600 Skyscraper)
    $wp_customize->add_setting('winup_ad_sidebar', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_sidebar', array(
        'label' => __('Ad Sidebar (Desktop)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Formato recomendado: 300x600 (skyscraper). Aparece na sidebar em desktop.'
    ));

    // Ad Sticky Mobile (320x50 Anchor)
    $wp_customize->add_setting('winup_ad_sticky_mobile', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_sticky_mobile', array(
        'label' => __('Ad Sticky Mobile (Anchor)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Formato: 320x50. Fica fixo no bottom em dispositivos móveis.'
    ));
}
add_action('customize_register', 'winup_customize_register');

/**
 * In-Content Ads are managed by Ad Inserter plugin
 * Theme handles only fixed positions: Sidebar, Mobile Sticky, Header/Footer scripts
 */

/**
 * Related Content function - Cards Visuais com Thumbnails
 */
function winup_related_posts()
{
    global $post;
    $categories = get_the_category($post->ID);

    if ($categories) {
        $cat_ids = array();
        foreach ($categories as $individual_category)
            $cat_ids[] = $individual_category->term_id;

        $args = array(
            'category__in' => $cat_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 4,
            'ignore_sticky_posts' => 1
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) {
            echo '<div class="winup-related-posts">';
            echo '<h3 class="related-posts-title">' . __('You May Also Like:', 'winup-finance') . '</h3>';
            echo '<div class="related-posts-grid">';
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $cats = get_the_category();
                $cat_name = $cats ? $cats[0]->name : '';
                ?>
                <article class="related-post-card">
                    <a href="<?php the_permalink(); ?>" class="related-post-link">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="related-post-thumb">
                                <?php the_post_thumbnail('winup-grid'); ?>
                            </div>
                        <?php else: ?>
                            <div class="related-post-thumb placeholder-thumb"></div>
                        <?php endif; ?>
                        <div class="related-post-content">
                            <?php if ($cat_name): ?>
                                <span class="related-post-cat"><?php echo esc_html($cat_name); ?></span>
                            <?php endif; ?>
                            <h4 class="related-post-title"><?php the_title(); ?></h4>
                            <span class="related-post-date"><?php echo get_the_date('M j, Y'); ?></span>
                        </div>
                    </a>
                </article>
                <?php
            }
            echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
    }
}

/**
 * Calcula tempo de leitura baseado na contagem de palavras
 * @param int $post_id ID do post (opcional)
 * @return string Tempo formatado (ex: "5 min")
 */
function winup_reading_time($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 palavras por minuto
    
    if ($reading_time < 1) {
        $reading_time = 1;
    }
    
    return $reading_time . ' min';
}

/**
 * Progress Bar de Leitura - Renderiza HTML e JS
 */
function winup_reading_progress_bar()
{
    if (!is_single()) {
        return;
    }
    ?>
    <div id="winup-progress-bar" class="reading-progress-bar">
        <div class="reading-progress-fill"></div>
    </div>
    <script>
    (function() {
        var progressBar = document.querySelector('.reading-progress-fill');
        var article = document.querySelector('.entry-content');
        if (!progressBar || !article) return;
        
        function updateProgress() {
            var articleTop = article.offsetTop;
            var articleHeight = article.offsetHeight;
            var windowHeight = window.innerHeight;
            var scrollTop = window.scrollY || document.documentElement.scrollTop;
            
            var start = articleTop - windowHeight;
            var end = articleTop + articleHeight - windowHeight;
            var progress = ((scrollTop - start) / (end - start)) * 100;
            
            progress = Math.max(0, Math.min(100, progress));
            progressBar.style.width = progress + '%';
        }
        
        window.addEventListener('scroll', updateProgress);
        updateProgress();
    })();
    </script>
    <?php
}
