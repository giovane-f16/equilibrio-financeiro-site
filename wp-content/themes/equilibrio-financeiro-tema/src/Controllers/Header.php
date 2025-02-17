<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Providers\Wordpress;

class Header extends AbstractController
{
    public $wordpress_provider;
    private array $args;

    public function __construct(Wordpress $wordpress_provider, Twig $twig, $args)
    {
        $this->wordpress_provider = $wordpress_provider;
        $this->args               = $args;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("header.css", "{$this->path_views}/css/dist/header.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        $criterio = (isset($this->args["criterio"])) ? $this->args["criterio"] : null;

        echo $this->twig->render("header.html", [
            "wp_head"    => $this->wordpress_provider->getWpHead(),
            "path_views" => $this->path_views,
            "criterio"   => $criterio
        ]);
    }
}