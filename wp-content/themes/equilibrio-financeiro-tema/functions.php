<?php

add_filter("show_admin_bar", "__return_false");

add_action("after_setup_theme", function () {
    add_theme_support("post-thumbnails");
});