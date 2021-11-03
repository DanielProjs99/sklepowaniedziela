@extends('layouts.dashboard')

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
            <form method="POST" action="{{action('Dashboard\Auth\LoginController@loginAttempt')}}">
                @csrf
                <div class="form-group">
                    <label for="login">Login</label>
                    <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input id="password" type="password" class="form-control" name="haslo" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Zaloguj się
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
