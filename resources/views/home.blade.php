@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron shadow-lg p-3 mb-3 bg-white rounded justify-content-center">
            <div class="flex-column text-center justify-content-center">
                <h2>KALKULATOR DELEGACJI SLUZBOWEJ</h2>
                <h3>rozliczPWS.pl</h3>
                <h2>Polecenie Wyjazdu Sluzbowego</h2>
                <h2>Rachunek Kosztow Podrozy</h2>

                <a class="btn btn-primary" href="{{ route('krajowa') }}" role="button">Podroz krajowa</a>
                <a class="btn btn-primary" href="{{ route('zagraniczna') }}" role="button">Podroz zagraniczna</a>
            </div>
        </div>
    </div>
@endsection
