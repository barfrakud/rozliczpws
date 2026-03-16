<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if (config('app.ga_measurement_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.ga_measurement_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', @json(config('app.ga_measurement_id')));
        </script>
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.display_name') }}</title>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/custom.css') }}" rel="stylesheet">

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
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.display_name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('krajowa') ? 'active' : '' }}" href="{{ route('krajowa') }}">Podróż krajowa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('zagraniczna') ? 'active' : '' }}" href="{{ route('zagraniczna') }}">Podróż zagraniczna</a>
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
                <a class="navbar-brand labelNumerWersji" href="#" id="idFooterText" data-app-name="{{ config('app.display_name') }}" data-footer-version="{{ config('rozliczpws.footer_version', '') }}">{{ config('app.display_name') }}</a>
                @if (config('app.facebook_url'))
                    <a target="_blank" title="follow me on facebook" href="{{ config('app.facebook_url') }}">
                        <img alt="follow me on facebook" src="{{ asset('images/flogo-HexRBG-Wht-58.png') }}" height="30" width="30" />
                    </a>
                @endif
            </div>
        </nav>
    </div>
</body>

</html>
