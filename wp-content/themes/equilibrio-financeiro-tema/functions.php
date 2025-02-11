<?php

add_filter("show_admin_bar", "__return_false");

add_action("after_setup_theme", function () {
    add_theme_support("post-thumbnails");
});

function carregar_mais_artigos() {
    header("Content-Type: application/json");
    $quantidade = 5;
    $de         = isset($_GET["de"]) ? intval($_GET["de"]) : 0;

    require_once "vendor/autoload.php";
    $post_provider = new EquilibrioFinanceiro\Providers\Post();
    $artigos     = $post_provider->getArtigos($quantidade, $de);

    $artigos_formatados = array_map(function($artigo) {
        return [
            "titulo"           => $artigo->getTitulo(),
            "resumo"           => $artigo->getResumo(),
            "imagem"           => $artigo->getImagem(),
            "url"              => $artigo->getUrl(),
            "creditoDaImagem"  => $artigo->getCreditoDaImagem(),
            "dataDePublicacao" => $artigo->getDataDePublicacaoFormatada()
        ];
    }, $artigos);

    echo json_encode($artigos_formatados);
    wp_die();
}

add_action("wp_ajax_carregar_mais_artigos", "carregar_mais_artigos");
add_action("wp_ajax_nopriv_carregar_mais_artigos", "carregar_mais_artigos");