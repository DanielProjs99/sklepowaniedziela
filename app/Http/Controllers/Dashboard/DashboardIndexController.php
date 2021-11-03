<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class DashboardIndexController extends DashboardController
{
    public function index() {
        return redirect()->action('Dashboard\Stores\StoresController@index');
    }
}
