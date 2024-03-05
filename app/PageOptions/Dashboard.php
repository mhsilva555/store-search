<?php

namespace App\StoreSearch\PageOptions;

use App\StoreSearch\Facades\View;
use App\StoreSearch\Models\Stores;
use App\StoreSearch\Providers\OptionsServiceProvider;

class Dashboard extends OptionsServiceProvider
{
    public $menu_title = 'Store Search';
    public $page_title = 'Store Search';
    public $capability = 'administrator';
    public $menu_slug = 'store-search-dashboard';
    public $icon_url = 'dashicons-store';

    public function callbackPageOption()
    {
        $stores = (new Stores())->getAll();
        View::render('dashboard',['stores' => $stores]);
    }
}