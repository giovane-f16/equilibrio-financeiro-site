<?php

namespace EquilibrioFinanceiro\Models;

use \DateTime;
use EquilibrioFinanceiro\Controllers\AbstractController;

class Post extends AbstractController
{
    protected \WP_Post $wp_post;
    protected int $id;
    protected string $titulo;
    protected string $conteudo;
    protected string $resumo;
    protected string $imagem;
    protected string $url;
    protected string $data_de_publicacao_traduzida;
    protected string $credito_da_imagem;
    protected ?DateTime $data_de_publicacao;
    protected ?DateTime $data_de_atualizacao;
    protected ?string $tempo_desde_ultima_atualizacao;
    protected ?string $tag;
    protected ?array $wp_post_meta;
    protected array $categorias;
    protected array $relacionadas;

    public function __construct(\WP_Post $wp_post)
    {
        $this->wp_post      = $wp_post;
        $this->id           = $wp_post->ID                  ?? 0;
        $this->titulo       = $wp_post->post_title          ?? "";
        $this->conteudo     = $wp_post->post_content        ?? "";
        $this->resumo       = $wp_post->post_excerpt        ?? "";
        $this->wp_post_meta = get_post_meta($this->getId()) ?? null;
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getConteudo(): string
    {
        return do_shortcode($this->conteudo);
    }

    public function getResumo(): string
    {
        return $this->resumo;
    }

    public function getImagem(): string
    {
        if (isset($this->imagem)) {
            return $this->imagem;
        }

        $this->imagem = $this->placeholder;

        $thumbnail_id = get_post_thumbnail_id($this->getId());
        if (!$thumbnail_id) {
            return $this->imagem;
        }

        $tamanhos = ["full", "medium_large", "post-thumbnail"];

        foreach ($tamanhos as $tamanho) {
            $attachment_image = wp_get_attachment_image_src($thumbnail_id, $tamanho);
            if (!is_array($attachment_image)) {
                continue;
            }

            if (empty($attachment_image[0])) {
                continue;
            }

            $this->imagem = $attachment_image[0];
            break;
        }

        return $this->imagem;
    }

    public function getUrl(): string
    {
        if (isset($this->url)) {
            return $this->url;
        }

        $url = get_permalink($this->getId()) ?? "#";
        $this->url = $url;
        return $this->url;
    }

    public function getDataDePublicacao(): ?\DateTime
    {
        if (isset($this->data_de_publicacao)) {
            return $this->data_de_publicacao;
        }

        $data_de_publicacao = $this->wp_post->post_date ?? "";

        try {
            $this->data_de_publicacao = new \DateTime($data_de_publicacao);
        } catch (\Throwable $th) {
            $this->data_de_publicacao = null;
        }

        return $this->data_de_publicacao;
    }

    public function getDataDeAtualizacao(): ?\DateTime
    {
        if (isset($this->data_de_atualizacao)) {
            return $this->data_de_atualizacao;
        }

        $data_de_atualizacao = $this->wp_post->post_modified ?? "";

        try {
            $this->data_de_atualizacao = new \DateTime($data_de_atualizacao);
        } catch (\Throwable $th) {
            $this->data_de_atualizacao = null;
        }

        return $this->data_de_atualizacao;
    }

    public function getDataDePublicacaoTraduzida(): string
    {
        if (isset($this->data_de_publicacao_traduzida)) {
            return $this->data_de_publicacao_traduzida;
        }

        $this->data_de_publicacao_traduzida = "";
        $data_de_publicacao = $this->getDataDePublicacao();

        if (!$data_de_publicacao instanceof \DateTime) {
            return $this->data_de_publicacao_traduzida;
        }

        $meses = [
            1  => "Janeiro",
            2  => "Fevereiro",
            3  => "Março",
            4  => "Abril",
            5  => "Maio",
            6  => "Junho",
            7  => "Julho",
            8  => "Agosto",
            9  => "Setembro",
            10 => "Outubro",
            11 => "Novembro",
            12 => "Dezembro"
        ];

        $dia = $data_de_publicacao->format("d");
        $mes = $meses[(int)$data_de_publicacao->format("m")];
        $ano = $data_de_publicacao->format("Y");

        $this->data_de_publicacao_traduzida = "{$dia} de {$mes} de {$ano}";

        return $this->data_de_publicacao_traduzida;
    }

    public function getTempoDesdeUltimaAtualizacao(): ?string
    {
        if (isset($this->tempo_desde_ultima_atualizacao)) {
            return $this->tempo_desde_ultima_atualizacao;
        }

        $data_de_atualizacao = $this->getDataDeAtualizacao();

        if (!$data_de_atualizacao) {
            return null;
        }

        $data_atual      = current_time("timestamp");
        $data_atualizado = $data_de_atualizacao->getTimestamp() ?? 0;
        $diferenca       = human_time_diff($data_atualizado, $data_atual);

        $this->tempo_desde_ultima_atualizacao = $diferenca;

        return $this->tempo_desde_ultima_atualizacao;
    }

    public function getTag(): ?string
    {
        if (isset($this->tag)) {
            return $this->tag;
        }

        $id   = $this->getId();
        $tags = get_the_tags($id);

        if (!is_array($tags)) {
            return null;
        }

        // Filtro para trazer Imprensa ou Novidades
        $tag = array_values(array_filter($tags, function($tag) {
            return in_array($tag->slug, ["imprensa", "novidades"]);
        }));

        $this->tag = $tag[0]->name ?? null;

        return $this->tag;
    }

    public function getCategorias(): array
    {
        if (isset($this->categorias)) {
            return $this->categorias;
        }

        $categorias = get_the_category($this->getId());

        if (!is_array($categorias)) {
            return [];
        }

        $this->categorias = $categorias;

        return $this->categorias;
    }

    public function getRelacionadas(): array
    {
        if (isset($this->relacionadas)) {
            return $this->relacionadas;
        }

        $categorias_ids = array_map(function ($categoria) {
            return $categoria->term_id;
        }, $this->getCategorias());

        $posts = get_posts([
            "category__in" => $categorias_ids,
            "numberposts"  => 3,
            "exclude"      => $this->getId()
        ]);

        if (!$posts) {
            return [];
        }

        $this->relacionadas = array_map(function ($post) {
            return new Post($post);
        }, $posts);

        return $this->relacionadas;
    }

    public function getCreditoDaImagem(): string
    {
        if (isset($this->credito_da_imagem)) {
            return $this->credito_da_imagem;
        }

        $this->credito_da_imagem = "";

        $id_da_imagem = get_post_thumbnail_id($this->getId());

        if (!$id_da_imagem) {
            return $this->credito_da_imagem;
        }

        $dados_da_imagem = get_post($id_da_imagem);

        if (!$dados_da_imagem instanceof \WP_Post) {
            return $this->credito_da_imagem;
        }

        $this->credito_da_imagem = $dados_da_imagem->post_excerpt ?? "";

        return $this->credito_da_imagem;
    }
}