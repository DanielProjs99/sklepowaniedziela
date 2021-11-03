<?php

namespace App\Http\Controllers\Store\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Mail\UserRegistered;

class RegisterController extends AuthController
{
    public function index() {
        return view('store.auth.register');
    }

    public function registerAttempt(Request $request) {
        $request->validate([
            'email' => 'required|max:100|email|unique:users',
            'imie' => 'required|max:100',
            'nazwisko' => 'required|max:100',
            'telefon' => 'required|max:20',
            'haslo' => 'required|max:100|same:haslo_potwierdzenie|min:6',
            'haslo_potwierdzenie' => 'required|max:100|min:6',
        ]);

        $email = $request->input('email');
        $firstName = $request->input('imie');
        $lastName = $request->input('nazwisko');
        $phone = $request->input('telefon');
        $password = Hash::make($request->input('haslo'));
        $activationLink = '';

        $uniqeActivationLink = false;
        
        while (! $uniqeActivationLink) {
            $activationLink = str_random(30);

            $found = DB::table('users')
                ->select('id')
                ->where('activation_link', $activationLink)
                ->first();

            if (! $found) {
                $uniqeActivationLink = true;
            }
        }
        
        DB::table('users')
            ->insert([
                'email' => $email,
                'password' => $password,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'activation_link' => $activationLink,
            ]);

        Mail::to($email)->send(new UserRegistered($activationLink));
        
        return view('store.auth.registered');
    }

    public function activation(Request $request) {
        $activationCode = $request->input('activation');
        
        if (! $activationCode) {
            return view('store.auth.activation', ['code' => false]);
        }

        $user = DB::table('users')
            ->select('id', 'activated')
            ->where('activation_link', $activationCode)
            ->first();
            
        if (! $user) {
            return view('store.auth.activation', ['code' => true, 'success' => false]);
        }

        if ($user->activated) {
            return redirect()->action('Store\Auth\LoginController@index');
        }
        else {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'activated' => 1
                ]);

            Auth::loginUsingId($user->id);
            
            return view('store.auth.activation', ['code' => true, 'success' => true]);
        }
    }
}
