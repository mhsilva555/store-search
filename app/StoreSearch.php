<?php

namespace App\StoreSearch;

use App\StoreSearch\PageOptions\Dashboard;
use App\StoreSearch\Shortcodes\StoreSearchShortcode;

class StoreSearch
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
    }

    public function __construct()
    {
        (new \App\StoreSearch\Assets());
        (new Dashboard())->create();

        $this->loadShortcodes();
        $this->loadAjax();
        $this->makeDatabse();
    }

    private function loadShortcodes()
    {
        (new StoreSearchShortcode())->render();
    }

    private function loadAjax()
    {
        (new \App\StoreSearch\Hooks\Ajax\Places())->register('places');
        (new \App\StoreSearch\Hooks\Ajax\NewStore())->register('new-store');
        (new \App\StoreSearch\Hooks\Ajax\DeleteStore())->register('delete-store');
        (new \App\StoreSearch\Hooks\Ajax\EditStore())->register('edit-store');
        (new \App\StoreSearch\Hooks\Ajax\Cities())->register('list-cities');
    }

    private function makeDatabse()
    {
        Database::create(DATABASE);
    }
}