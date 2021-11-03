<?php

namespace App\Http\Controllers\Store\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Mail\ForgotPassword;

class ForgotPasswordController extends AuthController
{
    public function index() {
        return view('store.auth.forgotPassword');
    }

    public function sendEmail(Request $request) {
        $request->validate([
            'email' => 'required|max:100|email'
        ]);

        $email = $request->input('email');
        
        $user = DB::table('users')
            ->select('id')
            ->where('email', $email)
            ->first();

        if (! $user) {
            return redirect()
                ->back()
                ->withErrors([
                    'badEmail' => 'Nie znaleziono adresu email'
                ]);
        }

        $submitedAlready = DB::table('password_resets')
            ->select('id', 'created_at')
            ->where('email', $email)
            ->orderBy('id', 'DESC')
            ->first();

        if ($submitedAlready) {
            if (time() < strtotime($submitedAlready->created_at) + 3 * 60 * 60) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'alreadySent' => 'Na ten adres email wysłano już link resetujący hasło.'
                    ]);
            }
        }

        $resetToken = '';
        $uniqueResetToken = false;

        while (! $uniqueResetToken) {
            $resetToken = str_random(30);

            $found = DB::table('password_resets')
                ->select('id')
                ->where('token', $resetToken)
                ->first();

            if (! $found) {
                $uniqueResetToken = true;
            }
        }

        DB::table('password_resets')
            ->insert([
                'email' => $email,
                'token' => $resetToken,
            ]);

        Mail::to($email)->send(new ForgotPassword($resetToken));
        //return (new ForgotPassword($resetToken))->render();

        $request->session()->put('forgotPasswordSent', true);

        return view('store.auth.forgotPasswordSent');
    }

    public function changePassword(Request $request) {
        $resetToken = $request->input('token');
        
        if (! $resetToken) {
            return view('store.auth.resetPassword', ['token' => false]);
        }

        $email = DB::table('password_resets')
            ->select('email', 'created_at')
            ->where('token', $resetToken)
            ->first();
            
        if (! $email) {
            return view('store.auth.resetPassword', ['token' => true, 'success' => false]);
        }

        if (time() > strtotime($email->created_at) + 3 * 60 * 60) {
            return view('store.auth.resetPassword', ['token' => true, 'success' => true, 'expired' => true]);
        }

        return view('store.auth.resetPassword', ['token' => true, 'success' => true, 'expired' => false, 'token' => $resetToken]);
    }

    public function changePasswordAttempt(Request $request) {
        $resetToken = $request->input('token');
        
        if (! $resetToken) {
            return view('store.auth.resetPassword', ['token' => false]);
        }

        $email = DB::table('password_resets')
            ->select('email', 'created_at')
            ->where('token', $resetToken)
            ->first();
            
        if (! $email) {
            return view('store.auth.resetPassword', ['token' => true, 'success' => false]);
        }

        if (time() > strtotime($email->created_at) + 3 * 60 * 60) {
            return view('store.auth.resetPassword', ['token' => true, 'success' => true, 'expired' => true]);
        }

        $request->validate([
            'haslo' => 'required|min:6|max:100'
        ]);

        $password = $request->input('haslo');

        DB::table('users')
            ->where('email', $email->email)
            ->update([
                'password' => Hash::make($password)
            ]);

        return view('store.auth.changedPassword');
    }
}
