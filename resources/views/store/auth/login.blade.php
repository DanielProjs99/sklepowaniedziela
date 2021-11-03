@extends('layouts.front')

@section('title', '- zaloguj się')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-2">Logowanie</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{action('Store\Auth\LoginController@loginAttempt')}}">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input id="password" type="password" class="form-control" name="haslo" required>
                </div>
                <div class="form-check mb-2">
                  <input type="checkbox" class="form-check-input" id="zapamietaj" name="remember">
                  <label class="form-check-label" for="zapamietaj">Zapamiętaj mnie</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Zaloguj się
                    </button>
                </div>
            </form>
            <a href="{{action('Store\Auth\ForgotPasswordController@index')}}">Nie pamiętam hasła</a>
        </div>
    </div>
</div>
@endsection
