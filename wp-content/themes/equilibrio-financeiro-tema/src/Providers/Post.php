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

    public function getArtigos(int $quantidade = -1, int $de = 0): array
    {
        if (isset($this->artigos)) {
            return $this->artigos;
        }

        $posts = get_posts([
            "numberposts" => $quantidade,
            "offset"      => $de
        ]);

        if (!$posts) {
            return [];
        }

        $this->artigos = array_map(function ($post) {
            return new PostModel($post);
        }, $posts);

        return $this->artigos;
    }

    public function getByCategoria(int $term_id, int $quantidade = -1, int $de = 0): array
    {
        $posts = get_posts([
            "category"    => $term_id,
            "numberposts" => $quantidade,
            "offset"      => $de
        ]);

        if (!$posts) {
            return [];
        }

        return array_map(function ($post) {
            return new PostModel($post);
        }, $posts);
    }

    public function getByCriterio(string $criterio, int $quantidade = 10, int $de = 0): array
    {
        $posts = get_posts([
            "numberposts" => $quantidade,
            "offset"      => $de,
            "s"           => $criterio
        ]);

        if (!$posts) {
            return [];
        }

        return array_map(function ($post) {
            return new PostModel($post);
        }, $posts);
    }
}