<?php

namespace App\StoreSearch\Providers;

abstract class OptionsServiceProvider
{
    public $page_title = '';
    public $menu_title = '';
    public $capability = '';
    public $menu_slug = '';
    public $icon_url = '';
    public $position = 5;

    public function __construct()
    {
        $this->create();
    }

    public function create()
    {
        add_action('admin_menu', function () {
            add_menu_page(
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                [$this, 'callbackPageOption'],
                $this->icon_url,
                $this->position
            );
        });
    }

    abstract public function callbackPageOption();
}