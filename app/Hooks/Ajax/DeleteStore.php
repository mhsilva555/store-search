<?php

namespace App\StoreSearch\Hooks\Ajax;

use App\StoreSearch\Models\Stores;
use App\StoreSearch\Providers\AjaxServiceProvider;

class DeleteStore extends AjaxServiceProvider
{
    public function action()
    {
        $this->verifyNonce();

        $store_id = $_REQUEST['store_id'];
        (new Stores())->delete($store_id, 'store_id');
    }
}