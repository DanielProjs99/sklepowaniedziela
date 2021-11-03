@extends('layouts.front')

@section('title', '- reset hasła')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Resetowanie hasła</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{action('Store\Auth\ForgotPasswordController@sendEmail')}}">
                @csrf
                <div class="form-group">
                    <label for="email">Podaj adres e-mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Wyślij
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
