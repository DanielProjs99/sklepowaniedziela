<?php

namespace App\Http\Controllers\Store\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoresController extends StoreController
{
    public function index() {
        $stores = DB::table('stores')
            ->leftJoin('reservations', function($join) {
                $join->on('stores.id', '=', 'reservations.shop_id')
                ->where('reservations.paid', '!=', '0');
            })
            ->leftJoin('sundays', 'reservations.sunday_id', '=', 'sundays.id')
            ->select(
                'stores.id as store_id', 
                'full_name', 
                'street', 
                'post_code', 
                'city', 
                'accepted',
                'reservations.id as reservation_id',
                'reservations.paid',
                'reservations.time_from',
                'reservations.time_to',
                'sundays.date'
            )
            ->where([
                ['user_id', Auth::id()],
                ['deleted', 0],
                ['accepted', '!=', 2]
            ])
            ->get()
            ->all();

        $mergedStores = [];

        foreach ($stores as $store) {
            $mergedStores[$store->store_id]['id'] = $store->store_id;
            $mergedStores[$store->store_id]['full_name'] = $store->full_name;
            $mergedStores[$store->store_id]['street'] = $store->street;
            $mergedStores[$store->store_id]['post_code'] = $store->post_code;
            $mergedStores[$store->store_id]['city'] = $store->city;
            $mergedStores[$store->store_id]['accepted'] = $store->accepted;
            if ($store->reservation_id && (strtotime($store->date) + 24 * 60 * 60) > time()) {
                $mergedStores[$store->store_id]['reservations'][$store->reservation_id]['id'] = $store->reservation_id;
                $mergedStores[$store->store_id]['reservations'][$store->reservation_id]['time_from'] = $store->time_from;
                $mergedStores[$store->store_id]['reservations'][$store->reservation_id]['time_to'] = $store->time_to;
                $mergedStores[$store->store_id]['reservations'][$store->reservation_id]['date'] = $store->date;
                $mergedStores[$store->store_id]['reservations'][$store->reservation_id]['paid'] = $store->paid;
            }
        }

        return view('store.stores.index', ['stores' => $mergedStores]);
    }
}
