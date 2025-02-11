<?php

namespace EquilibrioFinanceiro\Providers;

use EquilibrioFinanceiro\Models\Categoria as CategoriaModel;

class Categoria
{
    private array $categorias;

    public function getTodas(): array
    {
        if (isset($this->categorias)) {
            return $this->categorias;
        }

        $categorias = get_categories();

        $this->categorias = array_map(function(\WP_Term $categoria){
            return new CategoriaModel($categoria);
        }, $categorias);

        return $this->categorias;
    }
}