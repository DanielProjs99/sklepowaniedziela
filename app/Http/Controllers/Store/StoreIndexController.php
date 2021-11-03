<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

class StoreIndexController extends StoreController
{
    public function index() {
        return redirect()->action('Store\Stores\StoresController@index');
    }
}
