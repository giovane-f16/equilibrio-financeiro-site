<?php

/**
 * Plugin Name: Conversor de imagens para WebP
 * Description: Converte as imagens que são subidas no Wordpress para webp
 * Version: 1.0.3
 * Author: giovanef16
 */

add_filter("wp_handle_upload", function (array $file) {
    $filetype = $file["type"] ?? null;
    if (!in_array($filetype, ["image/jpeg", "image/png"])) {
        return $file;
    }

    try {
        require __DIR__ . "/vendor/autoload.php";
        $path_parts = pathinfo($file["file"]);
        $webp_file  = $path_parts["dirname"] . "/" . $path_parts["filename"] . ".webp";
        \WebPConvert\WebPConvert::convert($file["file"], $webp_file, []);
        unlink($file["file"]);
        $file["file"] = $webp_file;
        $file["type"] = "image/webp";
        return $file;
    } catch (\WebPConvert\Convert\Exceptions\ConversionFailedException $e) {
        $data = (new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")))->format("d/m/Y H:i:s");
        file_put_contents(__DIR__ . "/error.txt", "[$data] " . $e->getMessage() . "\n", FILE_APPEND);
        return $file;
    }
}, 5);
