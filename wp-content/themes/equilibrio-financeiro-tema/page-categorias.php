<?php

require_once "vendor/autoload.php";

$loader             = new Twig\Loader\FilesystemLoader(__DIR__ . "/views");
$twig               = new Twig\Environment($loader);
$categoria_provider = new EquilibrioFinanceiro\Providers\Categoria;
$post_provider      = new EquilibrioFinanceiro\Providers\Post;
$controller         = new EquilibrioFinanceiro\Controllers\Categorias($twig, $categoria_provider, $post_provider);

$versao = $controller->getVersao();
$controller->enqueueStyles($versao);
$controller->enqueueScripts($versao);

get_header();
$controller->render();
get_footer();