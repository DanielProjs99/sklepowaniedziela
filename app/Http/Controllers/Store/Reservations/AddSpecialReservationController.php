<?php

namespace App\Http\Controllers\Store\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddSpecialReservationController extends Controller
{
    public function index() {
        return view('store.reservations.addSpecial', ['store' => $store]);
    }

    public function addAttempt(Request $request, $shopId) {
        $request->validate([
            'od-godz' => 'required|min:0|max:24',
            'od-min' => 'required|min:0|max:50',
            'do-godz' => 'required|min:0|max:24',
            'do-min' => 'required|min:0|max:50',
        ]);

        $fromHours = $request->input('od-godz');
        $fromMinutes = $request->input('od-min');
        $toHours = $request->input('do-godz');
        $toMinutes = $request->input('do-min');
        
        return redirect()->route('cart');     
    }
}
