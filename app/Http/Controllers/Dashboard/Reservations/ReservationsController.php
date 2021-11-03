<?php

namespace App\Http\Controllers\Dashboard\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\ReservationPaid;

class ReservationsController extends DashboardController
{
    public function index() {
        $notPaidReservations = DB::table('reservations')
            ->join('sundays', 'reservations.sunday_id', '=', 'sundays.id')
            ->join('stores', 'reservations.shop_id', '=', 'stores.id')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->select(
                'reservations.id',
                'sundays.date',
                'reservations.time_from',
                'reservations.time_to',
                'stores.full_name', 
                'stores.street', 
                'stores.post_code', 
                'stores.city',
                'users.email',
                'users.first_name',
                'users.last_name',
                'users.phone'
            )
            ->where([
                ['reservations.paid', 2]
            ])
            ->get()
            ->all();

        foreach ($notPaidReservations as $key => $reservation) {
            $notPaidReservations[$key]->date = strftime('%d %b. %G', strtotime($notPaidReservations[$key]->date));
            $notPaidReservations[$key]->time_from = substr($notPaidReservations[$key]->time_from, 0, 5);
            $notPaidReservations[$key]->time_to = substr($notPaidReservations[$key]->time_to, 0, 5);
        }

        return view('dashboard.reservations.notPaid', ['notPaidReservations' => $notPaidReservations]);
    }

    public function paid($reservationId) {
        DB::table('reservations')
            ->where('reservations.id', $reservationId)
            ->update([
                'paid' => 1
            ]);

        return redirect()->back();
    }
}
