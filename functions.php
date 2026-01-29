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
 * Customizer para Ads
 */
function winup_customize_register($wp_customize)
{
    // Seção de Ads
    $wp_customize->add_section('winup_ads_section', array(
        'title' => __('Gerenciar Anúncios', 'winup-finance'),
        'priority' => 30,
    ));

    // Placeholder Default (336x280)
    $placeholder_html = '<div style="background:#eee; width:336px; height:280px; display:flex; align-items:center; justify-content:center; margin:0 auto; border:1px solid #ccc; color:#666;">AD BLOCK (336x280)</div>';

    // Ad 1 (Antes do Parágrafo 1)
    $wp_customize->add_setting('winup_ad_1', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_1', array(
        'label' => __('Ad #1 (Antes do 1º Parágrafo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Deixe vazio para mostrar o placeholder de teste.'
    ));

    // Ad 2 (Após Parágrafo 3)
    $wp_customize->add_setting('winup_ad_2', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_2', array(
        'label' => __('Ad #2 (Após 3º Parágrafo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Deixe vazio para mostrar o placeholder de teste.'
    ));

    // Ad 3 (Manual - Fim do Post)
    $wp_customize->add_setting('winup_ad_4', array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_control('winup_ad_4', array(
        'label' => __('Ad #3 (Fim do Conteúdo)', 'winup-finance'),
        'section' => 'winup_ads_section',
        'type' => 'textarea',
        'description' => 'Este bloco aparece ao final do post.'
    ));
}
add_action('customize_register', 'winup_customize_register');

/**
 * Lógica de Inserção de Ads
 */
function winup_insert_ads($content)
{
    if (is_admin() || !is_single()) {
        return $content;
    }

    // Default Placeholder for Testing
    $placeholder = '<div class="winup-ad-placeholder" style="margin: 2rem auto; width: 336px; max-width: 100%;"><div style="background:#f4f4f4; width:336px; height:280px; display:flex; align-items:center; justify-content:center; border:1px dashed #999; color:#555; font-weight:bold; font-family:sans-serif; max-width:100%;">TEST AD (336x280)</div><span style="display:block; text-align:center; font-size:10px; color:#999; margin-top:5px;">ADVERTISEMENT</span></div>';

    $ad_1 = get_theme_mod('winup_ad_1', '');
    $ad_2 = get_theme_mod('winup_ad_2', '');

    // Use placeholder if empty, for immediate user feedback based on request
    if (empty($ad_1))
        $ad_1 = $placeholder;
    if (empty($ad_2))
        $ad_2 = $placeholder;

    // Logic: Prepend Ad 1
    $final_content = '<div class="winup-ad-slot winup-ad-1">' . $ad_1 . '</div>';

    $paragraphs = explode('</p>', $content);
    $p_count = 0;

    foreach ($paragraphs as $index => $paragraph) {
        if (trim($paragraph)) {
            $final_content .= $paragraph . '</p>';
            $p_count++;

            // Ad 2 (After Paragraph 3)
            if ($p_count === 3) {
                $final_content .= '<div class="winup-ad-slot winup-ad-2">' . $ad_2 . '</div>';
            }
        }
    }

    return $final_content;
}
add_filter('the_content', 'winup_insert_ads');

/**
 * Related Content function (Simple)
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
            'posts_per_page' => 3, // Minimalist list
            'ignore_sticky_posts' => 1
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) {
            echo '<div class="winup-related-posts">';
            echo '<h3>' . __('Você pode gostar também:', 'winup-finance') . '</h3>';
            echo '<ul>';
            while ($my_query->have_posts()) {
                $my_query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        wp_reset_query();
    }
}
