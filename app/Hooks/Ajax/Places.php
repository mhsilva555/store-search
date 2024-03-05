<?php

namespace App\StoreSearch\Hooks\Ajax;

use App\StoreSearch\Helpers\CepApi;
use App\StoreSearch\Models\Stores;
use App\StoreSearch\Providers\AjaxServiceProvider;

class Places extends AjaxServiceProvider
{
    public function action()
    {
        $this->verifyNonce();
        $zipcode = str_replace('-', '', $_REQUEST['zipcode']);
        $api = CepApi::getData($zipcode);
        $cidade = $api->localidade ?? null;

        if (!isset($cidade)) {
            wp_send_json([
                'status' => 404
            ]);
        }

        $query = (new Stores())->where(['store_city' => $cidade]);

        wp_send_json([
            'data' => $query,
            'city' => $api->localidade,
            'status' => 200
        ]);
    }
}