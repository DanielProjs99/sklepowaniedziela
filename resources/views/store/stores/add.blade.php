@extends('layouts.store')

@section('title', '- dodaj sklep')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Dodaj sklep</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Pełna nazwa sklepu<span class="text-danger font-weight-bold">*</span></label>
                    <input id="name" type="name" class="form-control" name="nazwa" value="{{ old('nazwa') }}" required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="street" class="col-form-label text-md-right">Ulica i numer<span class="text-danger font-weight-bold">*</span></label>
                        <input id="street" type="text" class="form-control" name="ulica" value="{{ old('ulica') }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="post" class="col-form-label text-md-right">Kod pocztowy<span class="text-danger font-weight-bold">*</span></label>
                        <input id="post" type="text" class="form-control" name="kod" value="{{ old('kod') }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="city" class="col-form-label text-md-right">Miasto<span class="text-danger font-weight-bold">*</span></label>
                        <input id="city" type="text" class="form-control" name="miasto" value="{{ old('miasto') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Cena: <span class="font-weight-bold text-success">9,99zł</span></h4>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Dodaj sklep
                    </button>
                    <small class="form-text text-danger">
                        Twój sklep będzie musiał przejść weryfikację przez administrację.
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
