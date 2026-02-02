<?php
/**
 * Script para configurar Categorias e Menu Principal
 * Execute via browser: http://us-cursosesc.local/wp-content/themes/winup-finance/setup-categories-menu.php
 */

require_once dirname(__FILE__) . '/../../../wp-load.php';

// 1. Definição das Categorias
$categories_to_create = array(
    'Credit Card',
    'Insurance',
    'Investments',
    'Loan'
);

$cat_ids = array();

echo '<h2>1. Criando Categorias...</h2>';
foreach ($categories_to_create as $cat_name) {
    $term = term_exists($cat_name, 'category');
    
    if ($term !== 0 && $term !== null) {
        echo "Categoria '$cat_name' já existe (ID: " . $term['term_id'] . ").<br>";
        $cat_ids[$cat_name] = $term['term_id'];
    } else {
        $result = wp_insert_term($cat_name, 'category');
        if (!is_wp_error($result)) {
            echo "Categoria '$cat_name' CRIADA (ID: " . $result['term_id'] . ").<br>";
            $cat_ids[$cat_name] = $result['term_id'];
        } else {
            echo "Erro ao criar '$cat_name': " . $result->get_error_message() . "<br>";
        }
    }
}

// 2. Configurando Menu
echo '<h2>2. Configurando Menu Principal...</h2>';

$menu_name = 'Primary Menu';
$menu_location = 'primary';
$menu_exists = wp_get_nav_menu_object($menu_name);

// Se não existe, cria
if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($menu_name);
    echo "Menu '$menu_name' criado (ID: $menu_id).<br>";
} else {
    $menu_id = $menu_exists->term_id;
    echo "Menu '$menu_name' encontrado (ID: $menu_id).<br>";
}

// Limpa itens antigos para evitar duplicação (opcional, mas bom para reset)
$menu_items = wp_get_nav_menu_items($menu_id);
if ($menu_items) {
    foreach ($menu_items as $item) {
        wp_delete_post($item->ID);
    }
    echo "Itens de menu antigos removidos.<br>";
}

// Adiciona "Home"
wp_update_nav_menu_item($menu_id, 0, array(
    'menu-item-title'   => 'Home',
    'menu-item-url'     => home_url('/'),
    'menu-item-status'  => 'publish'
));
echo "Item 'Home' adicionado.<br>";

// Adiciona as Categorias
foreach ($categories_to_create as $cat_name) {
    if (isset($cat_ids[$cat_name])) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  => $cat_name,
            'menu-item-object-id' => $cat_ids[$cat_name],
            'menu-item-object' => 'category',
            'menu-item-type'   => 'taxonomy',
            'menu-item-status' => 'publish'
        ));
        echo "Item '$cat_name' adicionado ao menu.<br>";
    }
}

// Define o menu na localização 'primary'
$locations = get_theme_mod('nav_menu_locations');
$locations[$menu_location] = $menu_id;
set_theme_mod('nav_menu_locations', $locations);
echo "Menu definido na localização '$menu_location'.<br>";

echo '<h3>Configuração Concluída!</h3>';
echo '<p><a href="' . home_url() . '" target="_blank">Ver Site</a></p>';
?>
