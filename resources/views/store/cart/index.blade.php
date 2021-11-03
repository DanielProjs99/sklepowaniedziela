@extends('layouts.store')

@section('title', '- koszyk')

@section('content')
<?php
    $hasReservations = ! empty($reservations);
?>

<h1 class="d-sm-inline-block pb-2 pr-5 main-store-title">Koszyk</h1>

<div>
@if ($hasReservations)
    @foreach ($reservations as $reservation)
        <div class="p-2 my-2 cart-reservation">
            <h3>{{$reservation->full_name}}</h3>
            <h6>{{$reservation->street}} {{$reservation->post_code}} {{$reservation->city}}</h6>
            <h6>{{$reservation->date}}</h6>
            <h6>{{$reservation->time_from}} - {{$reservation->time_to}}</h6>
            <a type="button" href="{{action('Store\Reservations\RemoveUnpaidReservationController@remove', ['reservationId' => $reservation->id])}}" class="btn btn-danger"><span class="oi oi-x mr-1"></span> Usuń</a>
        </div>
    @endforeach

    <div class="float-sm-right">
        <h4>Do zapłaty: <span class="text-success font-weight-bold">{{$price}} zł</span></h4>
        <a type="button" href="{{action('Store\Cart\CartController@pay')}}" class="btn btn-primary mt-2 float-sm-right"><span class="oi oi-cart mr-2"></span>Dodaj</a>
    </div>
@else
<h2>Nie masz żadnych rezerwacji w koszyku</h2>
@endif
</div>
@endsection