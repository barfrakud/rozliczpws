<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>rozliczPWS.pl</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">rozliczPWS.pl</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    {{-- <div class="d-flex"> --}}
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link {{ request()->is('krajowa') ? 'active' : '' }}" aria-current="page"
                                href="{{ url('krajowa') }}">Podróż krajowa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('zagraniczna') ? 'active' : '' }}"
                                href="{{ url('zagraniczna') }}">Podróż zagraniczna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('podstawa') ? 'active' : '' }}"
                                href="{{ url('podstawa') }}">Podstawa prawna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('kontakt') ? 'active' : '' }}"
                                href="{{ url('kontakt') }}">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pomoc') ? 'active' : '' }}"
                                href="{{ url('pomoc') }}">Pomoc</a>
                        </li>
                    </ul>
                    {{-- </div> --}}
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
                    <img alt="follow me on facebook" src="images/flogo-HexRBG-Wht-58.png" height="30"
                        width="30" />
                </a>
            </div>
        </nav>
    </div>

</body>

<script>
    console.log("Start");
</script>

</html>
