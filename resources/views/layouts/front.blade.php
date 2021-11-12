<?php 
                                
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $cartQuantityDB = DB::table('reservations')
    ->join('stores', 'reservations.shop_id', '=', 'stores.id')
    ->where([
        ['stores.user_id', Auth::id()],
        ['reservations.paid', 0],
    ])
    ->count('reservations.id');
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>Sklepowa Niedziela @yield('title')</title>
    
    <script src="{{ mix('front/js/script.js') }}" async defer></script>
    @yield('scripts')
    <link href="{{ mix('front/css/style.css') }}" rel="stylesheet">
    @yield('styles')
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#aa0000",
          "text": "#ffdddd"
        },
        "button": {
          "background": "#ff0000"
        }
      },
      "showLink": false,
      "theme": "edgeless",
      "content": {
        "message": "Strona korzysta z plików cookies",
        "dismiss": "Rozumiem",
        "link": "."
      }
    })});
    </script>
</head>
<body>
    <div class="page-front">
        <nav class="navbar navbar-expand-md navbar-dark p-1 p-sm-0 navbar-tn ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Sklepowa Niedziela</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{action('Front\ContactController@index')}}">Kontakt</a></li>
                        <li><a class="nav-link" href="{{action('Front\OfferController@index')}}">Oferta</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li><a class="nav-link" href="{{action('Store\Auth\LoginController@index')}}">Zaloguj się</a></li>
                            <li><a class="nav-link" href="{{action('Store\Auth\RegisterController@index')}}">Zarejestuj się</a></li>
                        @else
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container p-0 bg-white main-front">
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="container">
                <div class="navbar navbar-dark navbar-expand-md p-0">
                    <span>&copy; Sklepowa Niedziela 2021</span>
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
