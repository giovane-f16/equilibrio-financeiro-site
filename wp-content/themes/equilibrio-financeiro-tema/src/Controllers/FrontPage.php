<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Controllers\AbstractController;
use EquilibrioFinanceiro\Providers\Post as PostProvider;

class FrontPage extends AbstractController
{
    private object $post_provider;

    public function __construct(Twig $twig, PostProvider $post_provider)
    {
        $this->post_provider = $post_provider;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("front-page-css", "{$this->path_views}/css/dist/front-page.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("front-page.html", [
            "path_views" => $this->path_views,
            "destaques"  => $this->post_provider->getDestaques()
        ]);
    }
}