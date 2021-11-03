<?php

namespace App\Http\Controllers\Store\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function index() {
        Auth::logout();

        return redirect()->action('Front\IndexController@index');
    }
}
