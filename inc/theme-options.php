<?php
/**
 * US Cursos Theme Options
 * Painel administrativo para gerenciar configurações do tema.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra o menu de opções
 */
function winup_options_menu() {
    add_menu_page(
        'Theme Settings',
        'Theme Options',
        'manage_options',
        'winup-options',
        'winup_options_page_html',
        'dashicons-chart-line',
        60
    );
}
add_action('admin_menu', 'winup_options_menu');

/**
 * Registra as configurações
 */
function winup_register_settings() {
    // Grupo: Ads
    register_setting('winup_options_group', 'winup_ad_1');
    register_setting('winup_options_group', 'winup_ad_2');
    register_setting('winup_options_group', 'winup_ad_4'); // Fim do post
    register_setting('winup_options_group', 'winup_ad_sidebar');
    register_setting('winup_options_group', 'winup_ad_sidebar_enabled');
    register_setting('winup_options_group', 'winup_ad_sticky_mobile');
    register_setting('winup_options_group', 'winup_ad_sticky_mobile_enabled');
    
    // Grupo: Scripts
    register_setting('winup_options_group', 'winup_scripts_header');
    register_setting('winup_options_group', 'winup_scripts_footer');
    
    // Grupo: Aparência
    register_setting('winup_options_group', 'winup_primary_color');
    register_setting('winup_options_group', 'winup_bg_color');
    register_setting('winup_options_group', 'winup_custom_css');
}
add_action('admin_init', 'winup_register_settings');

/**
 * Renderiza a página de opções no Admin
 */
function winup_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <style>
            .winup-admin-box {
                background: #fff;
                border: 1px solid #ccd0d4;
                box-shadow: 0 1px 1px rgba(0,0,0,.04);
                padding: 20px;
                margin-bottom: 20px;
                max-width: 800px;
            }
            .winup-textarea-code {
                font-family: monospace;
                width: 100%;
                min-height: 120px;
                background: #f7f7f7;
            }
            .winup-section-title {
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
                margin-top: 0;
            }
            /* Ad Block Container */
            .winup-ad-block {
                border: 1px solid #e0e0e0;
                border-radius: 6px;
                margin-bottom: 15px;
                background: #fafafa;
            }
            .winup-ad-header {
                display: flex;
                align-items: center;
                padding: 12px 15px;
                background: #f5f5f5;
                border-radius: 6px 6px 0 0;
            }
            .winup-ad-header h3 {
                margin: 0;
                flex: 1;
            }
            .winup-ad-content {
                padding: 15px;
                transition: all 0.3s ease;
            }
            .winup-ad-content.collapsed {
                display: none;
            }
            /* Toggle Switch */
            .winup-toggle {
                position: relative;
                display: inline-block;
                width: 44px;
                height: 24px;
            }
            .winup-toggle input {
                opacity: 0;
                width: 0;
                height: 0;
            }
            .winup-toggle-slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                transition: .3s;
                border-radius: 24px;
            }
            .winup-toggle-slider:before {
                position: absolute;
                content: "";
                height: 18px;
                width: 18px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                transition: .3s;
                border-radius: 50%;
            }
            .winup-toggle input:checked + .winup-toggle-slider {
                background-color: #2271b1;
            }
            .winup-toggle input:checked + .winup-toggle-slider:before {
                transform: translateX(20px);
            }
            /* Collapse Button */
            .winup-collapse-btn {
                background: none;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 4px 10px;
                cursor: pointer;
                font-size: 12px;
                color: #666;
                transition: all 0.2s;
            }
            .winup-collapse-btn:hover {
                background: #e0e0e0;
            }
        </style>

        <form action="options.php" method="post">
            <?php
            settings_fields('winup_options_group');
            do_settings_sections('winup-options');
            ?>

            <!-- Appearance Section -->
            <div class="winup-admin-box">
                <h2 class="winup-section-title">Theme Appearance</h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Primary Color</th>
                        <td>
                            <input type="text" name="winup_primary_color" value="<?php echo esc_attr(get_option('winup_primary_color', '#003366')); ?>" class="regular-text">
                            <p class="description">Main color for links, buttons and highlights. Default: #003366</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Background Color</th>
                        <td>
                            <input type="text" name="winup_bg_color" value="<?php echo esc_attr(get_option('winup_bg_color', '#ffffff')); ?>" class="regular-text">
                            <p class="description">Site background color. Default: #ffffff</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Custom CSS</th>
                        <td>
                            <textarea name="winup_custom_css" class="winup-textarea-code" style="min-height: 200px;"><?php echo esc_textarea(get_option('winup_custom_css')); ?></textarea>
                            <p class="description">Add custom CSS styles here. They will override the default styles.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Fixed Position Ads (Theme Managed) -->
            <div class="winup-admin-box">
                <h2 class="winup-section-title">Fixed Position Ads</h2>
                <p>These are fixed ad positions managed by the theme. For in-content ads (paragraphs, interstitials), use the <strong>Ad Inserter</strong> plugin.</p>

                <!-- Sidebar Ad -->
                <div class="winup-ad-block">
                    <div class="winup-ad-header">
                        <label class="winup-toggle">
                            <input type="checkbox" name="winup_ad_sidebar_enabled" value="1" <?php checked(get_option('winup_ad_sidebar_enabled'), '1'); ?>>
                            <span class="winup-toggle-slider"></span>
                        </label>
                        <h3 style="display:inline;margin-left:10px;">Sidebar Ad (Desktop - 300x600)</h3>
                        <button type="button" class="winup-collapse-btn" onclick="this.parentElement.nextElementSibling.classList.toggle('collapsed');this.textContent=this.textContent==='▼'?'▲':'▼'">▼</button>
                    </div>
                    <div class="winup-ad-content collapsed">
                        <p class="description">Displayed on the right sidebar in single posts (desktop only).</p>
                        <textarea name="winup_ad_sidebar" class="winup-textarea-code"><?php echo esc_textarea(get_option('winup_ad_sidebar')); ?></textarea>
                    </div>
                </div>

                <!-- Mobile Sticky Ad -->
                <div class="winup-ad-block">
                    <div class="winup-ad-header">
                        <label class="winup-toggle">
                            <input type="checkbox" name="winup_ad_sticky_mobile_enabled" value="1" <?php checked(get_option('winup_ad_sticky_mobile_enabled'), '1'); ?>>
                            <span class="winup-toggle-slider"></span>
                        </label>
                        <h3 style="display:inline;margin-left:10px;">Mobile Sticky Ad (320x50 Anchor)</h3>
                        <button type="button" class="winup-collapse-btn" onclick="this.parentElement.nextElementSibling.classList.toggle('collapsed');this.textContent=this.textContent==='▼'?'▲':'▼'">▼</button>
                    </div>
                    <div class="winup-ad-content collapsed">
                        <p class="description">Fixed at the bottom of the screen on mobile devices.</p>
                        <textarea name="winup_ad_sticky_mobile" class="winup-textarea-code"><?php echo esc_textarea(get_option('winup_ad_sticky_mobile')); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Scripts Section -->
            <div class="winup-admin-box">
                <h2 class="winup-section-title">Global Scripts</h2>
                
                <h3>Header Scripts (Before &lt;/head&gt;)</h3>
                <p class="description">Analytics, Pixel, verification meta tags, etc.</p>
                <textarea name="winup_scripts_header" class="winup-textarea-code"><?php echo esc_textarea(get_option('winup_scripts_header')); ?></textarea>

                <h3>Footer Scripts (Before &lt;/body&gt;)</h3>
                <p class="description">Chat scripts, async tracking, etc.</p>
                <textarea name="winup_scripts_footer" class="winup-textarea-code"><?php echo esc_textarea(get_option('winup_scripts_footer')); ?></textarea>
            </div>

            <?php submit_button('Save Changes'); ?>
        </form>
    </div>
    <?php
}

/**
 * Função Helper para obter opções (Compatibilidade com get_theme_mod)
 * Tenta buscar do novo painel, se vazio, tenta do customizer antigo
 */
function winup_get_option($key, $default = '') {
    // 1. Tenta option do novo painel
    $value = get_option($key);
    
    // 2. Se vazio, tenta theme_mod (Customizer)
    if (empty($value)) {
        $value = get_theme_mod($key);
    }
    
    // 3. Se ainda vazio, retorna default
    if (empty($value)) {
        return $default;
    }
    
    return $value;
}

/**
 * Injeta Scripts do Painel no Frontend
 */
function winup_inject_scripts() {
    $header_scripts = get_option('winup_scripts_header');
    if ($header_scripts) {
        echo "<!-- Winup Header Scripts -->\n" . $header_scripts . "\n";
    }
}
add_action('wp_head', 'winup_inject_scripts', 90);

function winup_inject_footer_scripts() {
    $footer_scripts = get_option('winup_scripts_footer');
    if ($footer_scripts) {
        echo "<!-- Winup Footer Scripts -->\n" . $footer_scripts . "\n";
    }
}
add_action('wp_footer', 'winup_inject_footer_scripts', 90);

/**
 * Injeta CSS Dinâmico (Cores + Custom CSS)
 */
function winup_inject_dynamic_css() {
    $primary_color = get_option('winup_primary_color', '#003366');
    $bg_color = get_option('winup_bg_color', '#ffffff');
    $custom_css = get_option('winup_custom_css');
    
    // Se nada foi alterado e não tem CSS custom, não faz nada
    if ($primary_color === '#003366' && $bg_color === '#ffffff' && empty($custom_css)) {
        return;
    }
    
    echo "<style id='winup-dynamic-css'>\n";
    echo ":root {\n";
    if ($primary_color !== '#003366') {
        echo "    --primary-color: " . esc_attr($primary_color) . ";\n";
    }
    if ($bg_color !== '#ffffff') {
        echo "    --bg-color: " . esc_attr($bg_color) . ";\n";
    }
    echo "}\n";
    
    if (!empty($custom_css)) {
        echo "/* Custom CSS */\n";
        echo wp_strip_all_tags($custom_css) . "\n";
    }
    echo "</style>\n";
}
add_action('wp_head', 'winup_inject_dynamic_css', 100);
