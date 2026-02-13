<?php

/**
 * Retorna posts do Site B via REST API
 *
 * @param string $site_b_url URL do site B, ex: https://siteb.com
 * @param int|string $categoria ID ou slug da categoria no Site B
 * @param int $quantidade Quantidade de posts a buscar
 * @return array
 */
function get_posts_site_b($site_b_url, $categoria = null, $quantidade = 5) {
    $endpoint = rtrim($site_b_url, '/') . '/wp-json/wp/v2/posts?per_page=' . $quantidade;

    // Filtra por categoria, se passado
    if ($categoria) {
        // remove espaços e garante que fique no formato "39,42,55"
        $categorias = array_map('trim', explode(',', $categoria));
        $endpoint .= '&categories=' . implode(',', $categorias);
    }
    $response = wp_remote_get($endpoint, [
        'timeout' => 20,
    ]);   

    if (is_wp_error($response)) {
        return []; // erro na requisição
    }

    $body = wp_remote_retrieve_body($response);
    $posts = json_decode($body, true);
    
    if (!$posts || !is_array($posts)) {
        return [];
    }

    $resultado = [];
    foreach ($posts as $p) {
        // imagem destacada
        $thumb = '';
        if (!empty($p['featured_media'])) {
            $media_resp = wp_remote_get($site_b_url . '/wp-json/wp/v2/media/' . $p['featured_media']);
            if (!is_wp_error($media_resp)) {
                $media_body = json_decode(wp_remote_retrieve_body($media_resp), true);
                if (!empty($media_body['media_details']['sizes'])) {
                    // verifica se existe o tamanho desejado, ex: 'medium'
                    if (isset($media_body['media_details']['sizes']['default-image'])) {
                        $thumb = $media_body['media_details']['sizes']['default-image']['source_url'];
                    } else {
                        // fallback para a URL original
                        $thumb = $media_body['source_url'];
                    }
                }
            }
        }

        $resultado[] = [
            'titulo' => $p['title']['rendered'] ?? '',
            'link'   => $p['link'] ?? '',
            'imagem' => $thumb,
        ];
    }

    return $resultado;
}

$site_b_url = get_sub_field('endereco');
$colunas = get_sub_field('colunas');
$quantidade = get_sub_field('qtd');
$categoria  = get_sub_field('categoria');
$posts = get_posts_site_b($site_b_url, $categoria, $quantidade);

if (empty($posts)) {
    echo '<div class="container"><div class="row"><div class="col-12 text-center"><p>Nenhum post encontrado.</p></div></div></div>';
    return;
} else {
    echo '<div class="container"><div class="row">';
        foreach ($posts as $p) {
            echo '<div class="col-sm-12 col-md-6 col-lg-' . esc_attr($colunas) . ' mb-4">';
                echo '<a href="' . esc_url($p['link']) . '">';
                echo '<img src="' . esc_url($p['imagem']) . '" alt="' . esc_attr($p['titulo']) . '" class="img-fluid mb-3">';
                echo '<h3>' . esc_html($p['titulo']) . '</h3>';
                echo '</a>';
            echo '</div>';
        }
    echo '</div></div>';
}