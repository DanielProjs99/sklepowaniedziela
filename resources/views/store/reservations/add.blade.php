@extends('layouts.store')

@section('title', '- dodaj wystawienie')

@section('content')
<div class="container page-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-3">Dodaj wystawienie</h1>
            <h5 class="mb-4">Sklep: {{$store->full_name}}</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{action('Store\Reservations\AddReservationController@addAttempt', ['shopId' => $store->id])}}">
                @csrf
                <div class="form-group">
                    <label for="sunday-select">Dzień niehandlowy:</label>
                    <select class="form-control" id="sunday-select" name="dzien" value={{old('dzien')}}>
                        @foreach ($sundays as $sunday)
                        <option value="{{$sunday->id}}"
                        @if ($sunday->id == old('dzien'))
                        selected
                        @endif    
                        >
                        {{$sunday->date}}</option>
                        @endforeach
                  </select>
                </div>
                <h5>Od:</h5>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="from-hours">Godzina:</label>
                        <select class="form-control" id="from-hours" name="od-godz" value={{old('od-godz')}}>
                            @for($i=0; $i<=24; $i++)
                            <option value="{{$i}}"
                            @if ($i == old('od-godz'))
                            selected
                            @endif
                            >
                            {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="from-minutes">Minuty:</label>
                        <select class="form-control" id="from-minutes" name="od-min" value={{old('od-min')}}>
                                @for($i=0; $i<=50; $i+=10)
                                @if ($i == 0)
                                <option value="00"
                                @if (00 == old('od-min'))
                                selected
                                @endif
                                >
                                00</option>
                                @else
                                <option value="{{$i}}"
                                @if ($i == old('od-min'))
                                selected
                                @endif
                                >
                                {{$i}}</option>
                                @endif
                                @endfor
                        </select>
                    </div>
                </div>
                <h5>Do:</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="to-hours">Godzina:</label>
                        <select class="form-control" id="to-hours" name="do-godz" value={{old('do-godz')}}>
                            @for($i=0; $i<=24; $i++)
                            <option value="{{$i}}"
                            @if ($i == old('do-godz'))
                            selected
                            @endif
                            >
                            {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="to-minutes">Minuty:</label>
                        <select class="form-control" id="to-minutes" name="do-min" value={{old('do-min')}}>
                                @for($i=0; $i<=50; $i+=10)
                                @if ($i == 0)
                                <option value="00"
                                @if (00 == old('do-min'))
                                selected
                                @endif
                                >
                                00</option>
                                @else
                                <option value="{{$i}}"
                                @if ($i == old('do-min'))
                                selected
                                @endif
                                >
                                {{$i}}</option>
                                @endif
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Cena: <span class="font-weight-bold text-success">0 zł</span></h4>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Dodaj do koszyka
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
