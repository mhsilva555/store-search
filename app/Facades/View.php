<?php

namespace App\StoreSearch\Facades;

use Fiskhandlarn\Blade;

class View
{
    public static function render($template, $data = [])
    {
        $blade = new Blade(STORE_SEARCH_PLUGIN_PATH . '/resources/views', STORE_SEARCH_PLUGIN_PATH . '/storage/cache');
        echo $blade->render($template, $data);
    }
}