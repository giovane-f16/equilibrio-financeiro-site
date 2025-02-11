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

        $categorias = array_filter($categorias, function (\WP_Term $categoria) {
            return $categoria->term_id != 1;
        });

        $this->categorias = array_map(function(\WP_Term $categoria){
            return new CategoriaModel($categoria);
        }, $categorias);

        return $this->categorias;
    }
}