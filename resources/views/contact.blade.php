@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <h3>Formularz kontaktowy</h3>
                <p class="mt-3">
                    Jesli znalazles blad lub masz pomysl co mozna poprawic, napisz przez formularz ponizej
                    albo przez <a href="https://github.com/barfrakud/rozliczpws">GitHub</a>.
                </p>
                <p>
                    Podanie adresu email pozwala odpowiedziec i doprecyzowac zgloszenie.
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

                            <form method="post" action="{{ route('contact.store') }}">
                                @csrf
                                <x-honey />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Imie</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Imie" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Wiadomosc</label>
                                            <textarea class="form-control textarea @error('message') is-invalid @enderror" placeholder="Wiadomosc" name="message">{{ old('message') }}</textarea>
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
                                        <button type="submit" class="btn btn-block przycisk4">Wyslij wiadomosc</button>
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
