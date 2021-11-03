@extends('layouts.front')

@section('title', '- znajdź otwarte sklepy w niehandlowe niedziele!')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
<script src="https://cdn.ravenjs.com/3.26.2/raven.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('front/js/map.js') }}" defer></script>
@endsection

@section('styles')
<link href="{{ asset('front/css/map.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="front-map-app"></div>
@endsection