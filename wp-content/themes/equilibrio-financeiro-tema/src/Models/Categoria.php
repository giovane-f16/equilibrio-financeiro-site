<?php

namespace EquilibrioFinanceiro\Models;

class Categoria {
    private \WP_Term $categoria;
    private string $nome;
    private string $slug;
    private int $id;

    public function __construct(\WP_Term $categoria)
    {
        $this->categoria = $categoria;
        $this->nome      = $categoria->name ?? "";
        $this->slug      = $categoria->slug ?? "";
        $this->id        = $categoria->term_id ?? 0;
    }

    public function getNome(): string 
    {
        return $this->nome;
    }

    public function getSlug(): string 
    {
        return $this->slug;
    }

    public function getId(): int 
    {
        return $this->id;
    }

}