@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container mt-5 poczatkowyDiv" id="poczatekPrzejazdy">
            <div>
                <a href="#top" id="bottom"></a>
            </div>


            <div class="row">

                <div class="col-sm-6">
                    <h2 id="labelPodrozZagraniczna">Podróż zagraniczna</h2>
                </div>

                <div class="col-sm-3"></div>

                {{-- <div class="col-sm-3">
                    <button type="button" class="btn btn-block" id="buttonPodrozZagranicznaPomoc" data-toggle="modal"
                        data-target=".bd-example-modal-xl">Pomoc</button>
                </div> --}}

                {{-- <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div>
                                    <h5><strong>Instrukcja wypełnienia formularza dla podróży zagranicznej</strong></h5>

                                    1. Wybierz miejsce podróży. <br>
                                    2. Wypełnij datę i godzinę rozpoczęcia oraz zakończenia podróży. <br>
                                    3. Naciśnij "Oblicz Podróż". <br>
                                    4. Uzupełnij koszty: Wyżywienie, Zakwaterowanie, Inne wydatki. <br>
                                    4. Naciśnij "Oblicz Koszty". <br>
                                    5. W przypadku wcześniejszego pobrania zaliczki wpisz otrzymaną kwotę w pole formularza
                                    "Zaliczka". <br>
                                    6. Naciśnij "Oblicz Rachunek". <br> <br>
                                </div>
                                <h5>Prawidłowo wypełniony formularz wygląda następująco:</h5>
                            </div>
                            <div class="modal-body">
                                <img src="img/pomoc_podr_zagraniczna.png"
                                    alt="Pomoc wypełnienia formularza Podróż zagraniczna" class="img-fluid" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-block przycisk4" data-dismiss="modal">Zamknij
                                    Pomoc</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>


            <h3>I. Podróż</h3>

            <div class="row">
                <div class="container">
                    <h5>Typ podróży zagranicznej</h5>
                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">Rozpoczęcie podróży zagranicznej w Polsce: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="1" id="typPodrozy1"
                                checked> Polska ->
                            Państwo A</label>
                    </div>

                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">Rozpoczęcie podróży zagranicznej w kraju za granicą: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="2" id="typPodrozy2">
                            Państwo A ->
                            Państwo B</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">Rozpoczącie podróży zagranicznej i sama podróż odbywa się w danym kraju: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="3" id="typPodrozy3">
                            Państwo A ->
                            Państwo A</label>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-sm-3">
                    <h5>Miejsce podróży</h5>
                    <label for="krajPodrozy">Państwo</label><br />
                    <form action="foo.php" method="post">
                        <select id="krajPodrozy" class="form-control" name="kraj">
                            <option style="display:none"></option>
                            <option data-value='{"waluta":"EUR","dieta":"47","limit":"140"}'>Afganistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"120"}'>Albania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"200"}'>Algieria</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"160"}'>Andora</option><br>
                            <option data-value='{"waluta":"USD","dieta":"61","limit":"180"}'>Angola</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"180"}'>Arabia Saudyjska</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Argentyna</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"145"}'>Armenia</option><br>
                            <option data-value='{"waluta":"AUD","dieta":"88","limit":"250"}'>Australia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"52","limit":"130"}'>Austria</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"150"}'>Azerbejdżan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"120"}'>Bangladesz</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"160"}'>Belgia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"130"}'>Białoruś</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"100"}'>Bośnia i Hercegowina</option>
                            <br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"120"}'>Brazylia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"120"}'>Bułgaria</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"120"}'>Chile</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"170"}'>Chiny</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"125"}'>Chorwacja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"160"}'>Cypr</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"120"}'>Czechy</option><br>
                            <option data-value='{"waluta":"DKK","dieta":"406","limit":"1300"}'>Dania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"55","limit":"150"}'>Egipt</option><br>
                            <option data-value='{"waluta":"USD","dieta":"44","limit":"110"}'>Ekwador</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"100"}'>Estonia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"55","limit":"300"}'>Etiopia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"160"}'>Finlandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"180"}'>Francja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"140"}'>Grecja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"140"}'>Gruzja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"160"}'>Hiszpania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"38","limit":"190"}'>Indie</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"110"}'>Indonezja</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"120"}'>Irak</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"95"}'>Iran</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"52","limit":"160"}'>Irlandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"56","limit":"160"}'>Islandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"150"}'>Izrael</option><br>
                            <option data-value='{"waluta":"JPY","dieta":"7532","limit":"22000"}'>Japonia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"48","limit":"160"}'>Jemen</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"95"}'>Jordania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"45","limit":"100"}'>Kambodża</option><br>
                            <option data-value='{"waluta":"CAD","dieta":"71","limit":"190"}'>Kanada</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"200"}'>Katar</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Kazachstan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"150"}'>Kenia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"41","limit":"150"}'>Kirgistan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"49","limit":"120"}'>Kolumbia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"66","limit":"220"}'>Kongo</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"46","limit":"170"}'>Korea Południowa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"170"}'>Koreańska Republika Ludowa
                                Demokratyczna
                            </option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"140"}'>Kostaryka</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"110"}'>Kuba</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"200"}'>Kuwejt</option><br>
                            <option data-value='{"waluta":"USD","dieta":"54","limit":"100"}'>Laos</option><br>
                            <option data-value='{"waluta":"USD","dieta":"57","limit":"150"}'>Liban</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"52","limit":"100"}'>Libia</option><br>
                            <option data-value='{"waluta":"CHF","dieta":"88","limit":"200"}'>Liechtenstein</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"130"}'>Litwa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"160"}'>Luksemburg</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"57","limit":"132"}'>Łotwa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"125"}'>Macedonia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Malezja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"180"}'>Malta</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"130"}'>Maroko</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"140"}'>Meksyk</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"85"}'>Mołdawia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"180"}'>Monako</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"140"}'>Mongolia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"130"}'>Niderlandy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"49","limit":"150"}'>Niemcy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"46","limit":"240"}'>Nigeria</option><br>
                            <option data-value='{"waluta":"NOK","dieta":"451","limit":"1500"}'>Norwegia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"58","limit":"180"}'>Nowa Zelandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"240"}'>Oman</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"38","limit":"200"}'>Pakistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"150"}'>Palestyńska Władza Narodowa
                            </option><br>
                            <option data-value='{"waluta":"USD","dieta":"52","limit":"140"}'>Panama</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Peru</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"49","limit":"120"}'>Portugalia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"52","limit":"275"}'>RPA</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"200"}'>Rosja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"38","limit":"100"}'>Rumunia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"174"}'>San Marino</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"44","limit":"120"}'>Senegal</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"100"}'>Serbia i Czarnogóra</option>
                            <br>
                            <option data-value='{"waluta":"USD","dieta":"56","limit":"230"}'>Singapur</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"120"}'>Słowacja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"130"}'>Słowenia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"200"}'>USA - Pozostałe</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"350"}'>USA - Nowy Jork</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"300"}'>USA - Waszyngton</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Syria</option><br>
                            <option data-value='{"waluta":"CHF","dieta":"88","limit":"200"}'>Szwajcaria</option><br>
                            <option data-value='{"waluta":"SEK","dieta":"459","limit":"1800"}'>Szwecja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Tadżykistan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"42","limit":"110"}'>Tajlandia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"150"}'>Tanzania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"37","limit":"100"}'>Tunezja</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"173"}'>Turcja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"47","limit":"90"}'>Turkmenistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"180"}'>Ukraina</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"80"}'>Urugwaj</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Uzbekistan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"220"}'>Wenezuela</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"44","limit":"130"}'>Węgry</option><br>
                            <option data-value='{"waluta":"GBP","dieta":"35","limit":"200"}'>Wielka Brytania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"160"}'>Wietnam</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"174"}'>Włochy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"33","limit":"100"}'>Wybrzeże Kości Słoniowej
                            </option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"90"}'>Zimbabwe</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"200"}'>Zjednoczone Emiraty Arabskie
                            </option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Państwa inne niż wymienione
                            </option><br>
                        </select>


                        <label for="labelWaluta">Waluta:</label><br />
                        <input id="labelWaluta" type="text" class="form-control" name="waluta" readonly>

                        <label for="labelKwotaDieta">Kwota diety:</label><br />
                        <input id="labelKwotaDieta" type="text" class="form-control" name="dieta" readonly>

                        <label for="labelLimitNocleg">Kwota limitu za nocleg:</label><br />
                        <input id="labelLimitNocleg" type="text" class="form-control" name="limitNocleg" readonly>

                    </form>
                </div>
                <div class="col-sm-3">
                    <h5>Rozpoczęcie podróży</h5>
                    <label for="dataRozpoPodrZ">Data</label><br />
                    <input id="dataRozpoPodrZ" type="date" class="form-control">
                    <label for="czasRozpoPodrZ">Godzina</label><br />
                    <input id="czasRozpoPodrZ" type="time" class="form-control">

                </div>
                <div class="col-sm-3">
                    <h5>Zakończenie podróży</h5>
                    <label for="dataZakoPodrZ">Data</label><br />
                    <input id="dataZakoPodrZ" type="date" class="form-control">
                    <label for="czasZakoPodrZ">Godzina</label><br />
                    <input id="czasZakoPodrZ" type="time" class="form-control">
                </div>
            </div>

            <h5>Podsumowanie podróży</h5>

            <div class="row">
                <div id="obliczenia" class="col-sm-3">
                    <label for="rozpoczeciePodrozyZ">Rozpoczęcie podróży:</label><br />
                    <p id="rozpoczeciePodrozyZ"></p>
                </div>

                <div class="col-sm-3">
                    <label for="zakonczeniePodrozyZ">Zakończenie podróży:</label><br />
                    <p id="zakonczeniePodrozyZ"></p>
                </div>

                <div class="col-sm-3">
                    <label for="czasTrwaniaPodrozyZ">Czas trwania [D:G:M]:</label><br />
                    <p id="czasTrwaniaPodrozyZ"></p>
                </div>
                <div class="col-sm-3">
                    <div id="buttonObliczIdZ">
                        <button type="button" id="buttonObliczZ" class="btn btn-block przycisk button-foreign">Oblicz
                            Podróż</button>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">II. Koszty</h3>
            <div class="row">

                <div class="col-sm-3">
                    <h5>Wyżywienie</h5>
                    <form>
                        <p>Zapewniono bezpłatnie posiłki w ilościach:</p>
                        <div id="idSniadanieZ">
                            <label for="sniadanieZ">Śniadanie:</label>
                            <input id="sniadanieZ" type="text" value="0" class="form-control">
                        </div>
                        <div id="idObiadZ">
                            <label for="obiadZ">Obiad:</label>
                            <input id="obiadZ" type="text" value="0" class="form-control">
                        </div>
                        <div id="idKolacjaZ">
                            <label for="kolacjaZ">Kolacja:</label>
                            <input id="kolacjaZ" type="text" value="0" class="form-control">
                        </div>
                    </form>
                </div>

                <div class="col-sm-3">
                    <h5>Zakwaterowanie</h5>
                    <p>Korzystałem z:</p>
                    <form id="idZakwaterowanieForm">
                        <div class="radio">
                            <label><input type="radio" name="zakwaterowanieButton" value="1"
                                    id="zakwaterowanieButton1Z" checked>
                                ryczałtu </label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="zakwaterowanieButton" value="2"
                                    id="zakwaterowanieButton2Z"> zakwaterowania
                                w hotelu</label>
                        </div>
                        <div id="miejsceRozp">
                            <label for="kosztHotelZ">Koszt zakwaterowania:</label>
                            <input id="kosztHotelZ" type="text" value="0" class="form-control" disabled>
                        </div>
                    </form>

                </div>

                <div class="col-sm-3">
                    <h5>Inne wydatki</h5>
                    <form>
                        <div id="iDkomunikacjaMiejskaZ" class="custom-control custom-checkbox">
                            <input type="checkbox" id="komunikacjaMiejskaZ" class="custom-control-input">
                            <label class="custom-control-label" for="komunikacjaMiejskaZ">Korzystałem z komunikacji
                                miejskiej</label>
                        </div>
                        <div id="iDdojazdLotnisko" class="custom-control custom-checkbox">
                            <input type="checkbox" id="dojazdLotnisko" class="custom-control-input">
                            <label class="custom-control-label" for="dojazdLotnisko">Dojazd z/do lotniska</label>
                        </div>
                        <p id="pozostaleWydatkiLabel">Pozostałe wydatki zgodnie z rachunkami</p>
                        <div id="idWydatkiZ">
                            <label for="wydatkiZ">Wydatki:</label>
                            <input id="wydatkiZ" type="text" value="0" class="form-control">
                        </div>
                    </form>

                </div>

                <div class="col-sm-3">
                    <h5>Należne diety</h5>
                    <p id="labelDietaZ"><b></b></p>
                    <h5>Odliczenia za wyżywienie</h5>
                    <p id="labelZOdliczenia"><b></b></p>
                    <h5>Diety - Odliczenia</h5>
                    <p id="labelDietaZOdliczenia"><b></b></p>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <h5>Ryczałt wynosi</h5>
                    <p id="labelKosztZakwatarewaniaRyczaltZ"><b></b></p>
                </div>
                <div class="col-sm-3">
                    <h5>Inne wydatki suma</h5>
                    <p id="labelInneWydatkiPodsumZ"><b></b></p>
                </div>
                <div class="col-sm-3">
                    <div id="buttonObliczKosztyIdZ">
                        <button type="button" id="buttonObliczKosztyIdZ"
                            class="btn btn-block przycisk2 button-foreign">Oblicz
                            Koszty</button>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">III. Rozliczenie zaliczki</h3>
            <div class="row">
                <div class="col-sm-3">
                    <h5>Zaliczka</h5>
                    <div id="idZaliczka">
                        <label for="zaliczka">Otrzymano kwotę:</label>
                        <input id="zaliczka" type="text" value="0" class="form-control">
                    </div>
                </div>

                <div class="col-sm-3">
                    <h5>Wydatkowano</h5>
                    <div id="idWydatkowano">
                        <label for="wydatkowano">Wydano kwotę:</label>
                        <p id="wydatkowano"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <h5>Rożnica</h5>
                    <div id="idRoznica">
                        <label for="roznica">Wpłacić do kasy:</label>
                        <p id="roznica"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div id="buttonObliczRachunekIdZlabel">
                        <button type="button" id="buttonObliczRachunekIdZ"
                            class="btn btn-block przycisk3 button-foreign">Oblicz
                            Rachunek</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
