<?php

namespace App\Http\Controllers\Dashboard\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\ShopAccepted;
use App\Mail\ShopRejected;

class StoresController extends DashboardController
{
    public function index() {
        $notAcceptedStores = DB::table('stores')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->select(
                'stores.id', 
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
                ['stores.accepted', 0],
                ['stores.deleted', 0]
            ])
            ->get()
            ->all();

        return view('dashboard.stores.notAccepted', ['notAcceptedStores' => $notAcceptedStores]);
    }

    public function accept(Request $request, $shopId) {
        $request->validate([
            'pierwsze' => 'required',
            'drugie' => 'required',
        ]);

        $lat = $request->input('pierwsze');
        $lng = $request->input('drugie');

        DB::table('stores')
            ->where('id', $shopId)
            ->update([
                'accepted' => 1,
                'lat' => $lat,
                'lng' => $lng,
                'accepted_on' => DB::raw('NOW()')
            ]);

        $data = DB::table('stores')
                ->join('users', 'stores.user_id', '=', 'users.id')
                ->select('users.email', 'stores.full_name')
                ->where('stores.id', $shopId)
                ->first();

        Mail::to($data->email)->send(new ShopAccepted($data->full_name));        

        return redirect()->action('Dashboard\Stores\StoresController@index');
    }

    public function reject(Request $request, $shopId) {
        $request->validate([
            'powod' => 'required|max:150'
        ]);

        $reason = $request->input('powod');

        DB::table('stores')
            ->where('id', $shopId)
            ->update([
                'accepted' => '2',
            ]);

        $data = DB::table('stores')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->select('users.email', 'stores.full_name')
            ->where('stores.id', $shopId)
            ->first();

        Mail::to($data->email)->send(new ShopRejected($data->full_name, $reason)); 

        return redirect()->action('Dashboard\Stores\StoresController@index');
    }
}
