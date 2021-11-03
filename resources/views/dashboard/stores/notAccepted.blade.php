@extends('layouts.dashboard')

@section('title', '- sklepy do zaakceptowania')

@section('content')
<?php
    $anyStores = ! empty($notAcceptedStores);
?>
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Sklepy do zaakceptowania</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($anyStores)
            @foreach ($notAcceptedStores as $store)
            <div class="col-md-12 my-2 p-2 dashboard-store">
                <h2 class="mb-4">{{$store->full_name}}</h2>
                <h4>Właściciel:</h4>
                <div>E-mail: <b>{{$store->email}}</b></div>
                <div>Imię: <b>{{$store->first_name}}</b></div>
                <div>Nazwisko: <b>{{$store->last_name}}</b></div>
                <div>Telefon: <b>{{$store->phone}}</b></div>
                <h4>Adres:</h4>
                <div>Ulica: <b>{{$store->street}}</b></div>
                <div>Kod pocztowy: <b>{{$store->post_code}}</b></div>
                <div>Miasto: <b>{{$store->city}}</b></div>
                <div class="mt-2">
                    <a href="javascript:void(0)" type="button" class="btn btn-success mr-2 store-accept-button">Zaakceptuj</a>
                    <a href="javascript:void(0)" type="button" class="btn btn-danger store-reject-button">Odrzuć</a>
                    <form class="store-accept-form mt-3" method="POST" action="{{action('Dashboard\Stores\StoresController@accept', ['storeId' => $store->id])}}">
                        @csrf
                        <h3>Podaj koordynaty z mapy google:</h3>
                        <div class="form-group">
                            <label for="first">Pierwsze</label>
                            <input id="first" type="text" class="form-control" name="pierwsze" required>
                        </div>
                        <div class="form-group">
                            <label for="secodn">Drugie</label>
                            <input id="secodn" type="text" class="form-control" name="drugie" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Zatwierdź
                            </button>
                        </div>
                    </form>
                    <form class="store-reject-form mt-3" method="POST" action="{{action('Dashboard\Stores\StoresController@reject', ['storeId' => $store->id])}}">
                        @csrf
                        <div class="form-group">
                            <label for="reason">Powód</label>
                            <input id="reason" type="text" class="form-control" name="powod" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Zatwierdź
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <h2>Brak sklepów</h2>
        @endif
    </div>
</div>
@endsection
