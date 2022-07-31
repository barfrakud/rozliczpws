@extends('layouts.app')

@section('content')
    <div class="container">


        {{-- Podróż krajowa --}}
        <div class="card">
            <h4 class="card-header">
                Instrukcja wypełnienia formularza dla podróży krajowej
            </h4>
            <div class="card-body">
                <ul>
                    <li>Uzupełnij wszystkie pola formularza wpisując dane pojedynczego przejazdu</li>
                    <li>Dodaj pojedynczy przejazd naciskając "Dodaj"</li>
                    <li>W miarę potrzeb dodaj kolejne przejazdy</li>
                    <li>Naciśnij "Oblicz Podróże" w celu wyświetlenia czasu trwania podróży służbowej</li>
                    <li>Uzupełnij pozostałe pola dotyczące korzystania z komunikacji miejskiej, zakwaterowania,
                        wyżywienia
                        oraz inne wydatki</li>
                    <li>Naciśnij "Oblicz Rachunek" w celu wyświetlenia rachunku kosztów podróży</li>
                </ul>

            </div>
        </div>

        <div class="card mt-2 mb-5">
            <h5 class="card-header">
                Prawidłowo wypełniony formularz wraz z obliczeniami wygląda następująco:
            </h5>
            <div class="card-body">
                <img src="images/pomoc-podr_krajowa1.png" alt="Instrukcja Podróż Krajowa" class="img-fluid" />
                <img src="images/pomoc-podr_krajowa2.png" alt="Instrukcja Podróż Krajowa" class="img-fluid" />

            </div>
        </div>



        {{-- Podróż zagraniczna --}}
        <div class="card mt-5">
            <h4 class="card-header">
                Instrukcja wypełnienia formularza dla podróży zagranicznej
            </h4>
            <div class="card-body">
                <ul>
                    <li>Wybierz typ podróży w zależności od miejsca rozpoczęcia podróży</li>
                    <li>Wybierz miejsce podróży</li>
                    <li>Wypełnij datę i godzinę rozpoczęcia oraz zakończenia podróży</li>
                    <li>Naciśnij "Oblicz Podróż"</li>
                    <li>Uzupełnij koszty: Wyżywienie, Zakwaterowanie, Inne wydatki</li>
                    <li>Oblicz Koszty</li>
                    <li>W przypadku wcześniejszego pobrania zaliczki wpisz otrzymaną kwotę w pole formularza
                        "Zaliczka"</li>
                    <li>Naciśnij "Oblicz Rachunek" w celu wyświetlenia rachunku kosztów podróży</li>
                </ul>

            </div>
        </div>

        <div class="card mt-2">
            <h5 class="card-header">
                Prawidłowo wypełniony formularz wraz z obliczeniami wygląda następująco:
            </h5>
            <div class="card-body">
                <img src="images/pomoc-podr_zagr.png" alt="Instrukcja Podróż Krajowa" class="img-fluid" />
            </div>
        </div>


    </div>
@endsection
