@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <h3>Formularz kontaktowy</h3>
                <p class="mt-3">
                    Jeśli znalazłeś błąd lub masz pomysł co można lepiej zrobić, to proszę napisz do mnie
                    poprzez formularz poniżej lub przez <a href="https://github.com/barfrakud/rozliczpws">GitHub</a>.
                </p>
                <p>
                    Podając email będę mógł z Tobą nawiązać kontakt, aby ewentualnie wyjaśnić problem i w przyszłości
                    powiadomić Cię, że rozliczpws.pl działa już poprawnie!
                </p>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Formularz kontaktowy</h5>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <form method="post" action="kontakt-uj">
                                {{ csrf_field() }}
                                <x-honey />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Imię </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Imię" name="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Wiadomość </label>
                                            <textarea class="form-control textarea @error('message') is-invalid @enderror" placeholder="Wiadomość" name="message"></textarea>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="update ml-auto mr-auto">
                                        <button type="submit" class="btn btn-block przycisk4">Wyślij
                                            wiadomość</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
