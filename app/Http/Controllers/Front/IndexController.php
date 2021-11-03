<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use \DateTime as DateTime;

class IndexController extends Controller
{
    public function index() {
        return view('front.index');
    }

    public function frontJson() {
        $nextSundays = DB::table('sundays')
            ->select('sundays.id')
            ->where('sundays.date', '>=', DB::raw('NOW() - INTERVAL 1 DAY'))
            ->take(4)
            ->get()
            ->all();

        $nextSundaysIds = [];

        foreach ($nextSundays as $sunday) {
            array_push($nextSundaysIds, $sunday->id);
        }

        $sundaysAndReservations = DB::table('sundays')
            ->leftJoin('reservations', function($join){
                $join->on('sundays.id', '=', 'reservations.sunday_id')
                    ->where('reservations.paid', 1);
            })
            ->leftJoin('stores', 'reservations.shop_id', '=', 'stores.id')
            ->select(
                'sundays.id as sunday_id', 
                'sundays.date', 
                'reservations.id as reservation_id',
                'reservations.time_from',
                'reservations.time_to',
                'stores.full_name',
                'stores.street',
                'stores.post_code',
                'stores.city',
                'stores.lat',
                'stores.lng'
            )
            ->whereIn('sundays.id', $nextSundaysIds)
            ->get()
            ->all();

        $mergedSundays = [];

        foreach ($sundaysAndReservations as $sunday) {
            $mergedSundays[$sunday->sunday_id]['id'] = $sunday->sunday_id;
            $mergedSundays[$sunday->sunday_id]['date'] = $sunday->date;
            if ($sunday->reservation_id !== null) {
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['id'] = $sunday->reservation_id;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['full_name'] = $sunday->full_name;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['street'] = $sunday->street;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['post_code'] = $sunday->post_code;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['city'] = $sunday->city;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['lat'] = $sunday->lat;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['lng'] = $sunday->lng;
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['time_from'] = substr($sunday->time_from, 0, 5);
                $mergedSundays[$sunday->sunday_id]['reservations'][$sunday->reservation_id]['time_to'] = substr($sunday->time_to, 0, 5);
            }
        }

        $mergedSundays = array_values($mergedSundays);

        $isNextSunday = $mergedSundays[0]['date'] == date("Y-m-d", strtotime('next sunday'));

        $todaySunday = date('N') == 7;

        $todayNT = false;

        if ($todaySunday) {
            $todayNT =  date("Y-m-d") == $mergedSundays[0]['date'];
        }
        
        foreach ($mergedSundays as $key => $sunday) {
            $mergedSundays[$key]['date'] = strftime('%d %b. %G', strtotime($sunday['date']));
            if (isset($mergedSundays[$key]['reservations'])) {
                $mergedSundays[$key]['reservations'] = array_values($sunday['reservations']);
            }
        }

        $data = new \stdClass();

        $data->sundays = $mergedSundays;
        $data->nextSunday = $isNextSunday;
        $data->todaySunday = $todaySunday;
        $data->todayNT = $todayNT;

        return json_encode($data);
    }
}
