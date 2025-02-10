<?php

namespace EquilibrioFinanceiro\Providers;

use EquilibrioFinanceiro\Models\Post as PostModel;

class Post
{
    private array $destaques;
    private array $artigos;

    public function getDestaques(): array
    {
        if (isset($this->destaques)) {
            return $this->destaques;
        }

        $posts = get_posts([
            "numberposts" => 3
        ]);

        if (!$posts) {
            return [];
        }

        $this->destaques = array_map(function ($post) {
            return new PostModel($post);
        }, $posts);

        return $this->destaques;
    }

    public function getArtigos(): array
    {
        if (isset($this->artigos)) {
            return $this->artigos;
        }

        $posts = get_posts([
            "numberposts" => -1
        ]);

        if (!$posts) {
            return [];
        }

        $this->artigos = array_map(function ($post) {
            return new PostModel($post);
        }, $posts);

        return $this->artigos;
    }

    public function getByCategoria(int $term_id): array
    {
        $posts = get_posts([
            "category"    => $term_id,
            "numberposts" => -1
        ]);

        if (!$posts) {
            return [];
        }

        return array_map(function ($post) {
            return new PostModel($post);
        }, $posts);
    }
}