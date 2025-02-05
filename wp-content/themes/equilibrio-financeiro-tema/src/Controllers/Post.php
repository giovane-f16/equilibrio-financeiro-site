<?php

namespace EquilibrioFinanceiro\Controllers;

use Twig\Environment as Twig;
use EquilibrioFinanceiro\Models\Post as PostModel;

class Post extends AbstractController
{
    private PostModel $post_model;

    public function __construct(Twig $twig, PostModel $post)
    {
        $this->post_model = $post;
        parent::__construct($twig);
    }

    public function enqueueStyles($versao): void
    {
        // toDo - Minify CSS
        wp_enqueue_style("post-css", "{$this->path_views}/css/src/post.css", [], $versao);
        $this->enqueueStylesComum($versao);
    }

    public function enqueueScripts($versao): void
    {
        $this->enqueueScriptsComum($versao);
    }

    public function render(): void
    {
        echo $this->twig->render("post.html", [
            "path_views" => $this->path_views,
            "post"       => $this->post_model
        ]);
    }
}