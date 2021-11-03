@extends('layouts.front')

@section('title', '- zmień hasło')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (! $token)
            <h1>Brak kodu resetującego</h1>            
            @elseif (! $success) 
            <h1>Błędny link</h1>
            @elseif ($expired)
            <h1>Link wygasł</h1>
            @else 
            <h1>Zmiana hasła</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{action('Store\Auth\ForgotPasswordController@changePasswordAttempt', ['token' => $token])}}">
                @csrf
                <div class="form-group mb-2">
                    <label for="password">Podaj nowe hasło</label>
                    <input id="password" type="password" class="form-control" name="haslo" required autofocus>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Haslo musi zawierać przynajmniej 6 znaków.
                    </small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Zmień hasło
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection