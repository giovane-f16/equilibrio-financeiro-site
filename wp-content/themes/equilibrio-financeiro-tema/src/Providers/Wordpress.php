<?php

namespace EquilibrioFinanceiro\Providers;

class Wordpress
{
    public function getWpHead(): string
    {
        ob_start();
        wp_head();
        $wp_head = ob_get_contents();
        ob_end_clean();
        return $wp_head;
    }

    public function getWpFooter(): string
    {
        ob_start();
        wp_footer();
        $wp_footer = ob_get_contents();
        ob_end_clean();
        return $wp_footer;
    }
}