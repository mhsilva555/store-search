<?php

namespace App\StoreSearch\Shortcodes;

use App\StoreSearch\Facades\View;

class StoreSearchShortcode
{
    public function __construct()
    {
        add_shortcode('store-search', [$this, 'render']);
    }

    public function render($atts = [])
    {
//        $default = shortcode_atts(['id' => ''], $atts);
//
//        if($default['id'] == '') {
//            return;
//        }

        ob_start();
        View::render('shortcode');
        return ob_get_clean();
    }
}