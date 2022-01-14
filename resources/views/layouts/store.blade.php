<?php 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$cartQuantityDB = DB::table('reservations')
    ->join('stores', 'reservations.shop_id', '=', 'stores.id')
    ->where([
        ['stores.user_id', Auth::id()],
        ['reservations.paid', 0],
    ])
    ->count('reservations.id');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>Sklepowa Niedziela - panel sklepu @yield('title')</title>
    
    <script src="{{ mix('store/js/script.js') }}" async defer></script>
    @yield('scripts')
    <link href="{{ mix('store/css/style.css') }}" rel="stylesheet">
    @yield('styles')
    <link rel="shortcut icon" href="/favicon.ico">

</head>
<body>
    <div class="page-store">
        <nav class="navbar navbar-expand-md navbar-dark p-0 navbar-tn">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Sklepowa Niedziela</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <a class="nav-link" href="{{action('Store\Cart\CartController@index')}}" >
                                Koszyk ({{$cartQuantityDB}})
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{action('Store\StoreIndexController@index')}}" >
                                Panel sklepu
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{action('Store\Auth\LogoutController@index')}}" >
                                Wyloguj się
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container p-4 bg-white main-store">
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="container">
                <div class="navbar navbar-dark navbar-expand-md p-0">
                    <span>&copy; Twoja Niedziela 2021</span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFooter" aria-controls="navbarFooter" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    
                        <div class="collapse navbar-collapse" id="navbarFooter">
                        <ul class="navbar-nav ml-auto">
                            <li><a class="nav-link" href="{{action('Front\RegulationsController@index')}}">Regulamin</a></li>
                            <li><a class="nav-link" href="{{action('Front\PrivacyController@index')}}">Polityka prywatności</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122645585-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-122645585-1');
    </script>
</body>
</html>