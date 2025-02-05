<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Controllers\AbstractController;

class Page extends AbstractController
{
    private object $post_model;

    public function __construct(Twig $twig, $post_model)
    {
        $this->post_model = $post_model;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("page-css", "{$this->path_views}/css/dist/page.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("page.html", [
            "path_views" => $this->path_views,
            "post"       => $this->post_model
        ]);
    }
}