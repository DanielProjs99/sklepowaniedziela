@extends('layouts.front')

@section('title', '- zarejestruj się')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Rejestracja</h1>
            <p>Jesteś właścicielem sklepu i jesteś zainteresowany wystawieniem go na naszej stronie?</p>
            <p><b>Zarejestruj się już teraz!</b></p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{action('Store\Auth\RegisterController@registerAttempt')}}">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail<span class="text-danger font-weight-bold">*</span></label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name" class="col-form-label text-md-right">Imię<span class="text-danger font-weight-bold">*</span></label>
                        <input id="name" type="text" class="form-control" name="imie" value="{{ old('imie') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname" class="col-form-label text-md-right">Nazwisko<span class="text-danger font-weight-bold">*</span></label>
                        <input id="lname" type="text" class="form-control" name="nazwisko" value="{{ old('nazwisko') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Numer telefonu<span class="text-danger font-weight-bold">*</span></label>
                    <input id="phone" type="text" class="form-control" name="telefon" value="{{ old('telefon') }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło<span class="text-danger font-weight-bold">*</span></label>
                    <input id="password" type="password" class="form-control" name="haslo" required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Haslo musi zawierać przynajmniej 6 znaków.
                    </small>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Potwierdź hasło<span class="text-danger font-weight-bold">*</span></label>
                    <input id="password-confirm" type="password" class="form-control" name="haslo_potwierdzenie" required>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="regulations" required>
                        <label class="form-check-label" for="regulations">Akceptuję <a href="{{action('Front\RegulationsController@index')}}">regulamin</a> i <a href="{{action('Front\PrivacyController@index')}}">politykę prywatności</a></label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Zarejestruj się
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
