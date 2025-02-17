<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Providers\Post as PostProvider;

class Busca extends AbstractController
{
    protected string $criterio;
    protected $post_provider;

    public function __construct(Twig $twig, string $criterio, PostProvider $post_provider)
    {
        $this->criterio      = $criterio;
        $this->post_provider = $post_provider;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("busca-css", "{$this->path_views}/css/dist/busca.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        wp_enqueue_script("busca-js", "{$this->path_views}/javascript/dist/carregar-mais-busca.min.js", ["jquery"], $versao, true);
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("busca.html", [
            "path_views" => $this->path_views,
            "criterio"   => $this->criterio,
            "resultados" => $this->post_provider->getByCriterio($this->criterio)
        ]);
    }
}