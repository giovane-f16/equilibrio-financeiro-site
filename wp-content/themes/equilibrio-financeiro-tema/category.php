<?php

require_once "vendor/autoload.php";

$categoria = get_queried_object();

$loader          = new Twig\Loader\FilesystemLoader(__DIR__ . "/views");
$twig            = new Twig\Environment($loader);
$categoria_model = new EquilibrioFinanceiro\Models\Categoria($categoria);
$post_provider   = new EquilibrioFinanceiro\Providers\Post();
$controller      = new EquilibrioFinanceiro\Controllers\Categoria($twig, $categoria_model, $post_provider);

$versao = $controller->getVersao();
$controller->enqueueStyles($versao);
$controller->enqueueScripts($versao);

get_header();
$controller->render();
get_footer();