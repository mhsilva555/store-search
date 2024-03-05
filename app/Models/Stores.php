<?php

namespace App\StoreSearch\Models;

use App\StoreSearch\Providers\DatabaseServiceProvider;

class Stores extends DatabaseServiceProvider
{
    public $table = 'store_search';
}