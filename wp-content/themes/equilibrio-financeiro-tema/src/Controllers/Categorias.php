<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Providers\Categoria as CategoriaProvider;
use EquilibrioFinanceiro\Providers\Post as PostProvider;

class Categorias extends AbstractController
{
    private $categoria_provider;
    private $post_provider;

    public function __construct(Twig $twig, CategoriaProvider $categoria_provider, PostProvider $post_provider)
    {
        $this->categoria_provider = $categoria_provider;
        $this->post_provider      = $post_provider;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("categorias.css", "{$this->path_views}/css/dist/categorias.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        wp_enqueue_script("carregar-mais", "{$this->path_views}/javascript/dist/carregar-mais-artigos.min.js", ["jquery"], $versao, true);
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("categorias.html", [
            "path_views" => $this->path_views,
            "categorias" => $this->categoria_provider->getTodas(),
            "artigos"    => $this->post_provider->getArtigos(10)
        ]);
    }
}