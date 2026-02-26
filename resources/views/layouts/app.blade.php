<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8DK59LG2E0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-8DK59LG2E0');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>rozliczPWS.pl</title>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    {!! htmlScriptTagJsApi([
        'action' => 'homepage',
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">rozliczPWS.pl</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('krajowa') ? 'active' : '' }}" href="{{ route('krajowa') }}">Podroz krajowa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('zagraniczna') ? 'active' : '' }}" href="{{ route('zagraniczna') }}">Podroz zagraniczna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('podstawa') ? 'active' : '' }}" href="{{ route('podstawa') }}">Podstawa prawna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kontakt') ? 'active' : '' }}" href="{{ route('kontakt') }}">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pomoc') ? 'active' : '' }}" href="{{ route('pomoc') }}">Pomoc</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div>
        @yield('content')
    </div>

    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark rounded">
            <div class="container-fluid">
                <a class="navbar-brand labelNumerWersji" href="#" id="idFooterText">rozliczPWS.pl</a>
                <a target="_blank" title="follow me on facebook" href="https://www.facebook.com/rozliczpws">
                    <img alt="follow me on facebook" src="{{ asset('images/flogo-HexRBG-Wht-58.png') }}" height="30" width="30" />
                </a>
            </div>
        </nav>
    </div>
</body>

</html>
