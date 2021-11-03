<?php

namespace App\Http\Controllers\Store\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('RedirectIfAuthenticated');
    }
}
