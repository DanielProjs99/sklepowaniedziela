<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends AuthController
{
    public function index() {
        return view('dashboard.auth.login');
    }

    public function loginAttempt(Request $request) {
        $request->validate([
            'login' => 'required|max:100',
            'haslo' => 'required|min:6|max:100',
        ]);

        $email = $request->input('login');
        $password = $request->input('haslo');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'is_admin' => 1], true)) {
            return redirect()->action('Dashboard\DashboardIndexController@index');
        }
        else {
            return redirect()->back()->withErrors(['badAttempt' => 'Błędny login lub hasło.'])->withInput();    
        }
    }
}
