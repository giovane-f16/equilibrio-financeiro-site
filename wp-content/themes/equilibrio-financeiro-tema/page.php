<?php

require_once "vendor/autoload.php";

global $post;

$loader     = new Twig\Loader\FilesystemLoader(__DIR__ . "/views");
$twig       = new Twig\Environment($loader);
$post_model = new EquilibrioFinanceiro\Models\Post($post);
$controller = new EquilibrioFinanceiro\Controllers\Page($twig, $post_model);

$versao = $controller->getVersao();
$controller->enqueueStyles($versao);
$controller->enqueueScripts($versao);

get_header();
$controller->render();
get_footer();