<?php

namespace App\StoreSearch\Hooks\Ajax;

use App\StoreSearch\Providers\AjaxServiceProvider;

class Cities extends AjaxServiceProvider
{
    public function action()
    {
        $json = STORE_SEARCH_PLUGIN_PATH . "/storage/json/cidades.json";

        if (!file_exists($json)) {
            wp_send_json(404);
        }

        $content = file_get_contents($json);
        $content = json_decode($content);

        wp_send_json($content);
    }
}