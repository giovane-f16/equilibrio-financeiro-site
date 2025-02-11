<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Controllers\AbstractController;
use EquilibrioFinanceiro\Models\Categoria as CategoriaModel;
use EquilibrioFinanceiro\Providers\Post as PostProvider;

class Categoria extends AbstractController
{
    private object $categoria_model;
    private object $post_provider;

    public function __construct(Twig $twig, CategoriaModel $categoria_model, PostProvider $post_provider)
    {
        $this->categoria_model = $categoria_model;
        $this->post_provider   = $post_provider;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("categoria-css", "{$this->path_views}/css/dist/categoria.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        wp_enqueue_script("carregar-mais-categorias", "{$this->path_views}/javascript/dist/carregar-mais-categorias.min.js", ["jquery"], $versao, true);
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        $term_id = $this->categoria_model->getId();
        $posts   = $this->post_provider->getByCategoria($term_id, quantidade: 10);

        echo $this->twig->render("categoria.html", [
            "path_views" => $this->path_views,
            "categoria"  => $this->categoria_model,
            "posts"      => $posts
        ]);
    }
}