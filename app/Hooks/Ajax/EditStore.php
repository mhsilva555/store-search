<?php

namespace App\StoreSearch\Hooks\Ajax;

use App\StoreSearch\Models\Stores;
use App\StoreSearch\Providers\AjaxServiceProvider;

class EditStore extends AjaxServiceProvider
{
    public function action()
    {
        $this->verifyNonce();

        if (isset($_POST['dados'])) {
            $this->saveStore();
        }

        $store_id = $_REQUEST['store_id'] ?? null;

        if (!$store_id) {
            wp_send_json(400);
        }

        $store_data = (new Stores())->find('store_id', $store_id);

        if (empty($store_data) || is_wp_error($store_data)) {
            wp_send_json([
                'status' => 400
            ]);
        }

        wp_send_json([
            'status' => 200,
            'store_data' => $store_data
        ]);
    }

    private function saveStore()
    {
        $this->verifyNonce();

        $store_id = $_REQUEST['store_id'] ?? null;

        if (!$store_id) {
            wp_send_json([
                'status' => 400
            ]);
        }

        parse_str($_REQUEST['dados'], $dados);

        $update = (new Stores())->update($dados, 'store_id', $store_id);

        if (!$update) {
            wp_send_json([
                'status' => 400
            ]);
        }

        wp_send_json([
            'status' => 200
        ]);
    }
}