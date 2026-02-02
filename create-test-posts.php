<?php
/**
 * Script para criar artigos de teste no WordPress
 * Execute este arquivo uma única vez através do browser ou WP-CLI
 * URL: http://us-cursosesc.local/wp-content/themes/winup-finance/create-test-posts.php
 */

// Carrega o WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

// Verifica se já foi executado (Removido temporariamente para popular)
// if (get_option('winup_test_posts_created')) { ... }

// Diretório de imagens do tema (RESTAURADO)
$images_dir = get_template_directory() . '/assets/images/';
$images_url = get_template_directory_uri() . '/assets/images/';

// Mapeia os nomes das imagens (Busca flexível)
$images = array(
    'investment' => glob($images_dir . 'finance_investment_*.png')[0] ?? null,
    'savings' => glob($images_dir . 'savings_money_*.png')[0] ?? null,
    'crypto' => glob($images_dir . 'crypto_bitcoin_*.png')[0] ?? null,
    'real_estate' => glob($images_dir . 'real_estate_*.png')[0] ?? null,
    'retirement' => glob($images_dir . 'retirement_planning_*.png')[0] ?? null,
    'credit_cards' => glob($images_dir . 'credit_cards_*.png')[0] ?? null,
);

// Dados dos artigos de teste
$articles = array(
    // 1. Ações
    array(
        'title' => 'Como Começar a Investir na Bolsa de Valores em 2026',
        'image_key' => 'investment',
        'category' => 'Investimentos',
        'excerpt' => 'Um guia completo para iniciantes que desejam dar os primeiros passos no mercado de ações brasileiro.',
        'content' => '<p>O mercado de ações pode parecer intimidador...</p><p>Estratégias fundamentais para 2026 incluem...</p><h2>Diversificando a Carteira</h2><p>Nunca coloque todos os ovos na mesma cesta...</p>'
    ),
    // 2. Economia
    array(
        'title' => 'As 7 Melhores Estratégias para Economizar Dinheiro',
        'image_key' => 'savings',
        'category' => 'Economia',
        'excerpt' => 'Descubra técnicas comprovadas para poupar mais e construir sua reserva de emergência.',
        'content' => '<p>Economizar é o primeiro passo...</p><h2>Regra 50-30-20</h2><p>Uma regra de ouro...</p>'
    ),
    // 3. Cripto
    array(
        'title' => 'Bitcoin e Criptomoedas: Guia para Iniciantes',
        'image_key' => 'crypto',
        'category' => 'Criptomoedas',
        'excerpt' => 'Entenda o que são criptomoedas, como funcionam e se vale a pena investir.',
        'content' => '<p>As criptos vieram para ficar...</p><h2>Blockchain Explicado</h2><p>A tecnologia por trás...</p>'
    ),
    // 4. Imóveis
    array(
        'title' => 'Investir em Imóveis vs FIIs: Qual a Melhor Opção?',
        'image_key' => 'real_estate',
        'category' => 'Imóveis',
        'excerpt' => 'Uma comparação detalhada entre comprar imóveis físicos ou investir em fundos imobiliários.',
        'content' => '<p>O sonho da casa própria vs a liquidez dos fundos...</p><h2>Rentabilidade Mensal</h2><p>Os FIIs pagam dividendos mensais isentos...</p>'
    ),
    // 5. Aposentadoria
    array(
        'title' => 'Planejamento de Aposentadoria: O Poder dos Juros Compostos',
        'image_key' => 'retirement',
        'category' => 'Aposentadoria',
        'excerpt' => 'Entenda como o tempo é seu maior aliado na construção de patrimônio.',
        'content' => '<p>Começar cedo faz toda a diferença...</p><h2>Calculadora de Juros</h2><p>Se você investir R$ 500 por mês...</p>'
    ),
    // 6. Cartões
    array(
        'title' => 'Top 5 Cartões Black com Melhores Salas VIP',
        'image_key' => 'credit_cards',
        'category' => 'Cartões',
        'excerpt' => 'Viaje com conforto e exclusividade usando os benefícios dos melhores cartões do mercado.',
        'content' => '<p>Acesso a lounges exclusivos transforma sua viagem...</p><h2>Visa Infinite vs Mastercard Black</h2><p>As principais diferenças...</p>'
    ),
    // Novos Artigos para popular
    array(
        'title' => 'Dividendos: Como Criar uma Renda Passiva Mensal',
        'image_key' => 'investment',
        'category' => 'Investimentos',
        'excerpt' => 'Aprenda a selecionar empresas que pagam bons dividendos e viva de renda.',
        'content' => '<p>Viver de renda é o sonho de muitos...</p><h2>O que é Dividend Yield?</h2><p>Indicador fundamental...</p>'
    ),
    array(
        'title' => 'Tesouro Direto: Ainda Vale a Pena com a Selic Atual?',
        'image_key' => 'savings',
        'category' => 'Economia',
        'excerpt' => 'Análise da rentabilidade dos títulos públicos no cenário econômico de 2026.',
        'content' => '<p>A segurança dos títulos públicos...</p><h2>Tesouro Selic vs IPCA+</h2><p>Proteção contra inflação...</p>'
    ),
    array(
        'title' => 'NFTs e Metaverso: O Futuro ou Apenas Hype?',
        'image_key' => 'crypto',
        'category' => 'Criptomoedas',
        'excerpt' => 'Uma análise sóbria sobre as novas tecnologias digitais e seu potencial de investimento.',
        'content' => '<p>O mercado de arte digital...</p><h2>Riscos Envolvidos</h2><p>Alta volatilidade...</p>'
    ),
    array(
        'title' => 'Como Avaliar um Imóvel na Planta',
        'image_key' => 'real_estate',
        'category' => 'Imóveis',
        'excerpt' => 'Cuidados essenciais antes de assinar contrato com construtoras.',
        'content' => '<p>Comprar na planta pode ser vantajoso...</p><h2>INCC e Correções</h2><p>Fique atento ao índice...</p>'
    ),
    array(
        'title' => 'Previdência Privada: PGBL ou VGBL?',
        'image_key' => 'retirement',
        'category' => 'Aposentadoria',
        'excerpt' => 'Saiba qual modalidade é a mais indicada para o seu perfil tributário.',
        'content' => '<p>A escolha errada pode custar caro no IR...</p><h2>Benefício Fiscal</h2><p>Quem faz declaração completa...</p>'
    ),
    array(
        'title' => 'Milhas Aéreas: Do Básico ao Viajante Profissional',
        'image_key' => 'credit_cards',
        'category' => 'Cartões',
        'excerpt' => 'Como acumular, multiplicar e vender suas milhas para lucrar ou viajar de graça.',
        'content' => '<p>Milhas são dinheiro...</p><h2>Clubes de Fidelidade</h2><p>Vale a pena assinar?...</p>'
    ),
    array(
        'title' => 'Day Trade vs Buy and Hold: Qual Seu Perfil?',
        'image_key' => 'investment',
        'category' => 'Investimentos',
        'excerpt' => 'Entenda as diferenças brutais entre especulação de curto prazo e investimento de longo prazo.',
        'content' => '<p>A adrenalina do mercado...</p><h2>Estatísticas de Day Trade</h2><p>A maioria perde dinheiro...</p>'
    ),
    array(
        'title' => 'Educação Financeira para Crianças',
        'image_key' => 'savings',
        'category' => 'Economia',
        'excerpt' => 'Como ensinar seus filhos a lidar com dinheiro desde cedo.',
        'content' => '<p>O exemplo vem de casa...</p><h2>Mesada Educativa</h2><p>Como implementar...</p>'
    ),
);

// Função para fazer upload de imagem e definir como thumbnail
function winup_upload_image_from_file($file_path, $post_id) {
    if (!file_exists($file_path)) {
        return false;
    }
    
    $file_name = basename($file_path);
    $upload_dir = wp_upload_dir();
    $new_file_path = $upload_dir['path'] . '/' . $file_name;
    
    // Copia o arquivo para a pasta de uploads
    copy($file_path, $new_file_path);
    
    // Prepara os dados do attachment
    $file_type = wp_check_filetype($file_name);
    $attachment = array(
        'guid' => $upload_dir['url'] . '/' . $file_name,
        'post_mime_type' => $file_type['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', $file_name),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    // Insere o attachment
    $attach_id = wp_insert_attachment($attachment, $new_file_path, $post_id);
    
    // Gera os metadados
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $new_file_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    
    return $attach_id;
}

// Cria as categorias se não existirem
$categories_map = array();
$category_names = array('Investimentos', 'Economia', 'Criptomoedas', 'Imóveis', 'Aposentadoria', 'Cartões');

foreach ($category_names as $cat_name) {
    $cat = get_term_by('name', $cat_name, 'category');
    if (!$cat) {
        $result = wp_insert_term($cat_name, 'category');
        if (!is_wp_error($result)) {
            $cat_id = $result['term_id'];
        } else {
            $cat_id = 1; // Fallback para Uncategorized
        }
    } else {
        $cat_id = $cat->term_id;
    }
    $categories_map[$cat_name] = $cat_id;
}

// Cria ou atualiza os posts
$created_posts = array();

echo '<div style="font-family: monospace; background: #f0f0f0; padding: 20px; border: 1px solid #ddd;">';
echo '<h2>Log de Execução</h2>';

foreach ($articles as $article) {
    // Tenta encontrar post existente pelo título
    $existing_post = get_page_by_title($article['title'], OBJECT, 'post');
    
    $post_data = array(
        'post_title'   => $article['title'],
        'post_content' => $article['content'],
        'post_excerpt' => $article['excerpt'],
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_author'  => 1,
        'post_category' => array($categories_map[$article['category']]),
    );
    
    if ($existing_post) {
        $post_id = $existing_post->ID;
        // Atualiza conteúdo se necessário (opcional, aqui só garantimos a imagem)
        echo "Post existente encontrado: [{$post_id}] {$article['title']}<br>";
    } else {
        $post_id = wp_insert_post($post_data);
        echo "Novo post criado: [{$post_id}] {$article['title']}<br>";
    }
    
    if ($post_id && !is_wp_error($post_id)) {
        // Lógica de Imagem
        $image_key = $article['image_key'];
        $image_path = $images[$image_key] ?? null;
        
        echo "&nbsp;&nbsp;> Procurando imagem '{$image_key}'... ";
        
        if ($image_path && file_exists($image_path)) {
            echo "Encontrada em: " . basename($image_path) . "<br>";
            
            // Verifica se já tem thumbnail
            if (!has_post_thumbnail($post_id)) {
                $attach_id = winup_upload_image_from_file($image_path, $post_id);
                if ($attach_id) {
                    set_post_thumbnail($post_id, $attach_id);
                    echo "&nbsp;&nbsp;> <strong>Imagem definida com sucesso!</strong> Attach ID: {$attach_id}<br>";
                } else {
                    echo "&nbsp;&nbsp;> <span style='color:red'>Erro ao fazer upload da imagem.</span><br>";
                }
            } else {
                echo "&nbsp;&nbsp;> <span style='color:blue'>Post já possui imagem destacada. Ignorando upload.</span><br>";
            }
        } else {
            echo "<span style='color:red'>Não encontrada ou caminho inválido.</span><br>";
            echo "&nbsp;&nbsp;> Caminho tentado: " . ($image_path ? $image_path : 'NULL') . "<br>";
        }
        
        $created_posts[] = array(
            'id' => $post_id,
            'title' => $article['title'],
            'url' => get_permalink($post_id),
        );
    }
    echo "<hr>";
}
echo '</div>';
echo '<p><strong>Total:</strong> ' . count($created_posts) . ' artigos criados.</p>';
echo '<p><a href="' . home_url() . '">Voltar para a Home</a></p>';
