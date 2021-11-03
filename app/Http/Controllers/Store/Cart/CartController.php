<?php

namespace App\Http\Controllers\Store\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\WaitingForPayment;

class CartController extends StoreController
{
    public function index() {
        $cartReservations = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->join('sundays', 'reservations.sunday_id', '=', 'sundays.id')
            ->select(
                'sundays.date', 
                'stores.full_name', 
                'stores.street', 
                'stores.post_code', 
                'stores.city', 
                'reservations.id', 
                'reservations.time_from', 
                'reservations.time_to'
            )
            ->where([
                ['stores.user_id', Auth::id()],
                ['paid', 0]
            ])
            ->get()
            ->all();

        foreach ($cartReservations as $reservation) {
            $reservation->date = strftime('%d %b. %G', strtotime($reservation->date));
            $reservation->time_from = substr($reservation->time_from, 0, 5);
            $reservation->time_to = substr($reservation->time_to, 0, 5);
        }

        $price = count($cartReservations) * 0;

        return view('store.cart.index', ['price' => $price, 'reservations' => $cartReservations]);
    }

    public function pay() {
        $cartReservations = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->select(
                'reservations.id',
                'users.email'
            )
            ->where([
                ['stores.user_id', Auth::id()],
                ['paid', 0]
            ])
            ->get()
            ->all();

        if (empty($cartReservations)) {
            return redirect()->route('home');
        }

        $price = count($cartReservations) * 0;

        DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->where([
                ['stores.user_id', Auth::id()],
                ['reservations.paid', 0]
            ])
            ->update([
                'reservations.paid' => 1
            ]);
                
        return view('store.cart.payment', ['price' => $price]);
    }
}
