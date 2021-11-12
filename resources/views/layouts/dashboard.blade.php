<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>Sklepowa Niedziela - panel @yield('title')</title>
    
    <script src="{{ mix('dashboard/js/script.js') }}" async defer></script>
    @yield('scripts')
    <link href="{{ mix('dashboard/css/style.css') }}" rel="stylesheet">
    @yield('styles')
    <link rel="shortcut icon" href="/favicon.ico">

</head>
<body>
    <div class="page-store">
        <nav class="navbar navbar-expand-md navbar p-1 navbar-tn">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/panel') }}">Panel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <a class="nav-link" href="{{action('Dashboard\Stores\StoresController@index')}}" >
                                Sklepy
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{action('Store\Auth\LogoutController@index')}}" >
                                Wyloguj się
                            </a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="container p-2 bg-white main-dashboard">
            @yield('content')
        </main>
    </div> 
</body>
</html>
