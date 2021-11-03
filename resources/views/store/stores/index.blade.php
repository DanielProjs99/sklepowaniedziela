@extends('layouts.store')

@section('title', '- twoje sklepy')

@section('content')
<?php
    $hasStores = ! empty($stores);
?>

<div class="d-sm-flex align-items-center">
    <h1 class="d-sm-inline-block pb-2 pr-5 main-store-title">Twoje sklepy</h1>
    @if ($hasStores)
    <a type="button" href="{{action('Store\Stores\AddStoreController@index')}}" class="btn btn-primary mt-4 mt-sm-0 ml-sm-auto"><span class="oi oi-plus"></span><span class="ml-2">Dodaj sklep</span></a>
    @endif
</div>

<div>
@if ($hasStores)
    <div class="d-sm-flex flex-column">
    @foreach ($stores as $store)
    <div class="all-stores-store p-2 my-3">
        <h4>{{$store['full_name']}}</h4>
        <div>
            <p>{{$store['street']}} {{$store['post_code']}} {{$store['city']}}</p>
        </div>
        @if ($store['accepted'])
            @if(isset($store['reservations']) && ! empty($store['reservations']))
                <p>Zaplanowane wystawienia:</p>
                <ul>
                @foreach($store['reservations'] as $reservation)
                    <li>{{strftime('%d %b. %G', strtotime($reservation['date']))}} - od {{substr($reservation['time_from'], 0, 5)}} do {{substr($reservation['time_to'], 0, 5)}}
                    @if ($reservation['paid'] == '2')
                    <span class="text-danger"> - Nie opłacone</span>
                    @endif
                    </li>
                @endforeach
                </ul>
            @else
                <p>Brak zaplanowanych wystawień</p>
            @endif
            <a type="button" href="{{action('Store\Reservations\AddReservationController@index', ['shopId' => $store['id']])}}" class="btn btn-primary mt-2"><span class="oi oi-calendar"></span><span class="ml-2">Wystaw sklep</span></a>
        @else
            <p class="font-weight-bold text-warning">Oczekuje na weryfikację.</p>
        @endif
    </div>
    @endforeach
    </div>
@else
<h2>Nie dodano jeszcze żadnego sklepu</h2>
<a type="button" href="{{action('Store\Stores\AddStoreController@index')}}" class="btn btn-primary mt-4 mt-sm-3"><span class="oi oi-plus"></span><span class="ml-2">Dodaj sklep</span></a>
@endif
</div>
@endsection