@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron shadow-lg p-3 mb-3 bg-white rounded justify-content-center">
            <div class="flex-column text-center justify-content-center">
                <h2>KALKULATOR DELEGACJI SŁUŻBOWEJ</h2>
                <h3>rozliczPWS.pl</h3>
                <h2>Polecenie Wyjazdu Służbowego</h2>
                <h2>Rachunek Kosztów Podróży</h2>

                <a class="btn btn-primary" href="{{ url('krajowa') }}" role="button">Podróż krajowa</a>
                <a class="btn btn-primary" href="{{ url('zagraniczna') }}" role="button">Podróż zagraniczna</a>
            </div>
        </div>
    </div>
@endsection
