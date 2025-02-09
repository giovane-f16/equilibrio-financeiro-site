<?php

add_filter("show_admin_bar", "__return_false");

add_action("after_setup_theme", function () {
    add_theme_support("post-thumbnails");
    add_theme_support("wp-block-styles"); // Suporte aos estilos de blocos
    add_theme_support("align-wide"); // Suporte para alinhamento amplo
    add_theme_support("editor-styles"); // Permite estilos no editor Gutenberg
    add_theme_support("responsive-embeds"); // Suporte para embeds responsivos
    add_theme_support("custom-spacing"); // Permite espaçamentos personalizados
});