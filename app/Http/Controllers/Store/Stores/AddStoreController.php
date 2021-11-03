<?php

namespace App\Http\Controllers\Store\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Store\StoreController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddStoreController extends StoreController
{
    public function index() {
        return view('store.stores.add');
    }

    public function addAttempt(Request $request) {
        $request->validate([
            'nazwa' => 'required|max:100',
            'ulica' => 'required|max:100',
            'kod' => 'required|max:6',
            'miasto' => 'required|max:100',
        ]);

        $name = $request->input('nazwa');
        $street = $request->input('ulica');
        $post = $request->input('kod');
        $city = $request->input('miasto');

        DB::table('stores')
            ->insert([
                'user_id' => Auth::id(),
                'full_name' => $name,
                'category_id' => 1,
                'street' => $street,
                'post_code' => $post,
                'city' => $city
            ]);

        return view('store.stores.added');     
    }
}
