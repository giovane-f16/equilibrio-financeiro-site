<?php

require_once "vendor/autoload.php";

$criterio = sanitize_text_field($_GET["s"]);

$loader        = new Twig\Loader\FilesystemLoader(__DIR__ . "/views");
$twig          = new Twig\Environment($loader);
$post_provider = new \EquilibrioFinanceiro\Providers\Post;
$controller    = new EquilibrioFinanceiro\Controllers\Busca($twig, $criterio, $post_provider);

$versao = $controller->getVersao();
$controller->enqueueStyles($versao);
$controller->enqueueScripts($versao);

get_header("", ["criterio" => $criterio]);
$controller->render();
get_footer();