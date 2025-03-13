<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;

abstract class AbstractController
{
    protected $twig;
    protected string $path;
    protected string $path_views;
    protected string $versao;
    protected string $placeholder;
    protected string $ano;

    public function __construct(Twig $twig = null)
    {
        $this->twig        = $twig;
        $this->path        = get_template_directory_uri();
        $this->path_views  = get_template_directory_uri() . "/views";
        $this->placeholder = "{$this->path_views}/img/placeholder.webp";
    }

    public function enqueueStylesComum(string $versao): void
    {
        wp_enqueue_style("geral-css", "{$this->path_views}/css/dist/geral.min.css", [], $versao);
    }

    public function enqueueScriptsComum(string $versao): void
    {
    }

    public function getVersao(): string
    {
        if (isset($this->versao)) {
            return $this->versao;
        }

        $tema = wp_get_theme();
        $this->versao = $tema->get("Version") ?? "";
        return $this->versao;
    }

    public function getAnoAtual(): string
    {
        if (isset($this->ano)) {
            return $this->ano;
        }
        $this->ano = date("Y");
        return $this->ano;
    }
}