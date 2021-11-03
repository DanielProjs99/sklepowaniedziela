<?php

namespace App\Http\Controllers\Store\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddReservationController extends StoreController
{
    public function index($shopId) {
        $store = DB::table('stores')
            ->select('id', 'full_name', 'user_id')
            ->where('id', $shopId)
            ->first();

        if(!$store || $store->user_id != Auth::id()) {
            return redirect()->route('home');
        }

        $sundays = DB::table('sundays')
            ->select('id', 'date')
            ->where('date', '>=', DB::raw('NOW() - INTERVAL 1 DAY'))
            ->take('4')
            ->get()
            ->all();

        $reservedSundays = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->join('sundays', 'reservations.sunday_id', '=', 'sundays.id')
            ->select('sundays.id')
            ->where([
                ['stores.id', $shopId],
                ['stores.user_id', Auth::id()],
                ['sundays.date', '>=', DB::raw('NOW() - INTERVAL 1 DAY')]
            ])
            ->get()
            ->all();

        foreach ($sundays as $sunKey => $sunday) {
            $found = false;

            foreach($reservedSundays as $reservedKey => $reservedSunday) {
                if ($sunday->id == $reservedSunday->id) {
                    $found = true;

                    unset($reservedSundays[$reservedKey]);
                    break;
                }
            }

            if ($found) {
                unset($sundays[$sunKey]);
                continue;
            }
            $sundays[$sunKey]->date = strftime('%d %b. %G', strtotime($sundays[$sunKey]->date));
        }

        return view('store.reservations.add', ['store' => $store, 'sundays' => $sundays]);
    }

    public function addAttempt(Request $request, $shopId) {
        $request->validate([
            'dzien' => 'required',
            'od-godz' => 'required|min:0|max:24',
            'od-min' => 'required|min:0|max:50',
            'do-godz' => 'required|min:0|max:24',
            'do-min' => 'required|min:0|max:50',
        ]);

        $chosenSunday = $request->input('dzien');
        $fromHours = $request->input('od-godz');
        $fromMinutes = $request->input('od-min');
        $toHours = $request->input('do-godz');
        $toMinutes = $request->input('do-min');

        $sundays = DB::table('sundays')
            ->select('id', 'date')
            ->where('date', '>=', DB::raw('NOW() - INTERVAL 1 DAY'))
            ->take('4')
            ->get()
            ->all();

        $reservedSundays = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->join('sundays', 'reservations.sunday_id', '=', 'sundays.id')
            ->select('sundays.id')
            ->where([
                ['stores.id', $shopId],
                ['stores.user_id', Auth::id()],
                ['sundays.date', '>=', DB::raw('NOW() - INTERVAL 1 DAY')]
            ])
            ->get()
            ->all();

        $found = false;
        $reserved = false;

        foreach ($sundays as $sunday) {
            if ($sunday->id == $chosenSunday) {
                $found = true;
                break;
            }
        }

        foreach ($reservedSundays as $sunday) {
            if ($sunday->id == $chosenSunday) {
                $reserved = true;
                break;
            }
        }
        
        if (! $found || $reserved) {
            return redirect()
                ->back()
                ->withErrors([
                    'badSunday' => 'Błędna niedziela'
                ])
                ->withInput();
        }
        
        $reservatiosInCart = DB::table('reservations')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->select('reservations.sunday_id')
            ->where([
                ['stores.id', $shopId],
                ['stores.user_id', Auth::id()],
                ['paid', 0]    
            ])
            ->get()
            ->all();
    
        $foundReservation = false;

        foreach ($reservatiosInCart as $reservation) {
            if ($reservation->sunday_id == $chosenSunday) {
                $foundReservation = true;

                break;
            }
        }

        if ($foundReservation) {
            return redirect()
                ->back()
                ->withErrors([
                    'badSunday' => 'Już masz rezerwację na dany dzień w koszyku.'
                ])
                ->withInput();
        }

        $fromTime = ($fromHours * 60) + $fromMinutes;
        $toTime = ($toHours * 60) + $toMinutes;

        if ($fromTime >= $toTime) {
            return redirect()
                ->back()
                ->withErrors([
                    'badTimes' => 'Godziny otwarcia muszą być przed godzinami zamknięcia.'
                ])
                ->withInput();
        }

        $finalTimeFrom = $fromHours . ":" . $fromMinutes . ":00";
        $finalTimeTo = $toHours . ":" . $toMinutes . ":00";

        DB::table('reservations')
            ->insert([
                'shop_id' => $shopId,
                'sunday_id' => $chosenSunday,
                'time_from' => $finalTimeFrom,
                'time_to' => $finalTimeTo,
                'paid' => 0,
            ]);

        return redirect()->route('cart');     
    }
}
