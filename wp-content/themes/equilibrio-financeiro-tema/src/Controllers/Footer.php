<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Providers\Wordpress;

class Footer extends AbstractController
{
    public $wordpress_provider;

    public function __construct(Wordpress $wordpress_provider, Twig $twig)
    {
        $this->wordpress_provider = $wordpress_provider;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        wp_enqueue_style("footer-css", "{$this->path_views}/css/dist/footer.min.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("footer.html", [
            "wp_footer"  => $this->wordpress_provider->getWpFooter(),
            "path_views" => $this->path_views,
            "ano"        => $this->getAnoAtual()
        ]);
    }
}