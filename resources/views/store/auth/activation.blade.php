@extends('layouts.front')

@section('title', '- aktywacja')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (! $code)
            <h1>Brak kodu aktywacyjnego</h1>            
            @elseif ($success) 
            <h1>Konto zostało aktywowane</h1>
            <a class="btn btn-primary" href="{{action('Store\StoreIndexController@index')}}" role="button">Przejdź do serwisu</a>
            @else 
            <h1>Błędny kod aktywacyjny</h1>
            @endif
        </div>
    </div>
</div>
@endsection