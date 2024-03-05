<?php

namespace App\StoreSearch\Hooks\Ajax;

use App\StoreSearch\Models\Stores;
use App\StoreSearch\Providers\AjaxServiceProvider;

class NewStore extends AjaxServiceProvider
{
    public function action()
    {
        $this->verifyNonce();

        if (!isset($_REQUEST['dados']) || empty($_REQUEST['dados'])) {
            wp_send_json(40);
        }

        parse_str($_REQUEST['dados'], $dados);
        $create = (new Stores())->create($dados);

        if (!$create) {
            wp_send_json(400);
        }

        wp_send_json(200);
    }
}