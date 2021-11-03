<?php

namespace App\Http\Controllers\Store\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends AuthController
{
    public function index() {
        return view('store.auth.login');
    }

    public function loginAttempt(Request $request) {
        $request->validate([
            'email' => 'required|email|max:100',
            'haslo' => 'required|min:6|max:100',
        ]);

        $email = $request->input('email');
        $password = $request->input('haslo');
        $remember = $request->input('remember') ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'activated' => 1, 'deleted' => 0], $remember)) {
            return redirect()->action('Store\StoreIndexController@index');
        }
        else {
            return redirect()->back()->withErrors(['badAttempt' => 'Błędny email lub hasło.'])->withInput();    
        }
    }
}
