<?php

namespace App\Http\Controllers\Store\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RemoveUnpaidReservationController extends StoreController
{
    public function remove($reservationId) {
        $reservation = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->select('user_id', 'paid')
            ->where('reservations.id', $reservationId)
            ->first();

        if (! $reservation || $reservation->paid || $reservation->user_id != Auth::id()) {
            return redirect()->route('home');
        }

        DB::table('reservations')
            ->where('id', $reservationId)
            ->delete();

        return redirect()->route('cart');
    }
}
