<?php

require_once "vendor/autoload.php";

$wordpress_provider = new EquilibrioFinanceiro\Providers\Wordpress;
$loader             = new Twig\Loader\FilesystemLoader(__DIR__ . "/views");
$twig               = new Twig\Environment($loader, []);
$controller         = new EquilibrioFinanceiro\Controllers\Footer($wordpress_provider, $twig);

$versao = $controller->getVersao();
$controller->enqueueStyles($versao);
$controller->enqueueScripts($versao);
$controller->render();