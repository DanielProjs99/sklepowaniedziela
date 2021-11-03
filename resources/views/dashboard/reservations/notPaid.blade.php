@extends('layouts.dashboard')

@section('title', '- nieopłacone wystawienia')

@section('content')
<?php
    $anyReservations = ! empty($notPaidReservations);
?>
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Niezapłacone wystawienia</h1>
        </div>
        @if ($anyReservations)
            @foreach ($notPaidReservations as $reservation)
            <div class="col-md-12 my-2 p-2 dashboard-store">
                <h2 class="mb-4">{{$reservation->full_name}}</h2>
                <h4>Kiedy:</h4>
                <div>Dzień: <b>{{$reservation->date}}</b></div>
                <div>Od: <b>{{$reservation->time_from}}</b></div>
                <div>Do: <b>{{$reservation->time_to}}</b></div>
                <h4>Właściciel:</h4>
                <div>E-mail: <b>{{$reservation->email}}</b></div>
                <div>Imię: <b>{{$reservation->first_name}}</b></div>
                <div>Nazwisko: <b>{{$reservation->last_name}}</b></div>
                <div>Telefon: <b>{{$reservation->phone}}</b></div>
                <h4>Adres:</h4>
                <div>Ulica: <b>{{$reservation->street}}</b></div>
                <div>Kod pocztowy: <b>{{$reservation->post_code}}</b></div>
                <div>Miasto: <b>{{$reservation->city}}</b></div>
                <div class="mt-2">
                    <a href="{{action('Dashboard\Reservations\ReservationsController@paid', ['reservationId' => $reservation->id])}}" type="button" class="btn btn-success">Zapłacone</a>
                </div>
            </div>
            @endforeach
        @else
            <h2>Brak wystawień</h2>
        @endif
    </div>
</div>
@endsection
