@extends('layouts.front')

@section('title', '- zmieniono hasło')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Hasło pomyślnie zmienione.</h1> 
            <a class="btn btn-primary" href="{{action('Store\Auth\LoginController@index')}}" role="button">Zaloguj się</a>            
        </div>
    </div>
</div>
@endsection