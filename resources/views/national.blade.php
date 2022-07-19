@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="" method="post">
            @csrf

            <div class="container mt-5 poczatkowyDiv" id="poczatekPrzejazdy">

                <div class="row">
                    <div><a href="#top" id="bottom"></a></div>
                    <div class="col-sm-3">
                        <h2 id="labelPodrozKrajowa">Podróż krajowa</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    {{-- <div class="col-sm-3">
                        <button type="button" class="btn btn-block d-print-none" id="buttonPodrozKrajowaPomoc"
                            data-toggle="modal" data-target=".bd-example-modal-xl">Pomoc</button>
                    </div> --}}

                    <!-- Bootstrap -> Modal -- pomoc jako okno wyskakujące -->
                    {{-- <div class="modal fade bd-example-modal-xl d-print-none" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-block">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div>
                                        <h5><strong>Instrukcja wypełnienia formularza dla podróży krajowej</strong></h5>
                                        1. Uzupełnij pola formalurza wpisując dane podróży. <br>
                                        2. Dodaj podróż naciskająć "Dodaj". <br>
                                        3. Powtórzy czynności 1-2 dla kolejnych podróży w miarę potrzeb. <br>
                                        4. Naciśnij "Oblicz Podróże". <br>
                                        5. Uzupełnij pozostałe dane: Zakwaterowanie, Wyżywienie, Inne wydatki. <br>
                                        6. Naciśnij "Oblicz Rachunek". <br> <br>
                                    </div>
                                    <h5>Prawidłowo wypełniony formularz wygląda następująco:</h5>
                                </div>
                                <div class="modal-body">
                                    <img src="img/pomoc-podr_krajowa.png" alt="Instrukcja Podróż Krajowa"
                                        class="img-fluid" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-block przycisk4" data-dismiss="modal">Zamknij
                                        Pomoc</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                <div class="row d-print-none">
                    <div class="col-sm-3">
                        <h4>Przejazdy</h4>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                </div>

                <div class="row d-print-none">
                    <div class="col-sm-3">
                        <div id="wyjazd">
                            <label for="miejsceRozpoPodr">Miejscowość wyjazdu</label><br />
                            <input id="miejsceRozpoPodr" type="text" class="form-control" list="miejscowosci">
                            <p class="paraForError" id="miejsceRozpoPodrError"></p>
                            <label for="dataRozpoPodr">Data</label><br />
                            <input id="dataRozpoPodr" type="date" class="form-control">
                            <p class="paraForError" id="dataRozpoPodrError"></p>
                            <label for="czasRozpoPodr">Godzina</label><br />
                            <input id="czasRozpoPodr" type="time" class="form-control">
                            <p class="paraForError" id="czasRozpoPodrError"></p>

                            <datalist id="miejscowosci">
                                <option value="Warszawa Centralna">
                                <option value="Kraków Główny">

                                <option value="Białystok">
                                <option value="Bydgoszcz">
                                <option value="Gdańsk">
                                <option value="Katowice">
                                <option value="Kielce">
                                <option value="Kraków">
                                <option value="Lublin">
                                <option value="Łódź">
                                <option value="Olsztyn">
                                <option value="Opole">
                                <option value="Poznań">
                                <option value="Rzeszów">
                                <option value="Szczecin">
                                <option value="Warszawa">
                                <option value="Wrocław">
                                <option value="Zielona Góra">

                                <option value="Dęblin">
                            </datalist>

                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div id="przyjazd">
                            <label for="miejsceZakonPodr">Miejscowość przyjazdu</label><br />
                            <input id="miejsceZakonPodr" type="text" class="form-control" list="miejscowosci">
                            <p class="paraForError" id="miejsceZakonPodrError"></p>
                            <label for="dataZakonPodr">Data</label><br />
                            <input id="dataZakonPodr" type="date" class="form-control">
                            <p class="paraForError" id="dataZakonPodrError"></p>
                            <label for="czasZakonPodr">Godzina</label><br />
                            <input id="czasZakonPodr" type="time" class="form-control">
                            <p class="paraForError" id="czasZakonPodrError"></p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div id="rodzajLok">
                            <label for="rodzajLokom">Środek lokomocji</label><br />
                            <select id="rodzajLokom" class="form-control">
                                <option style="display:none"></option>
                                <option>PKP TLK</option>
                                <option>PKP EIC</option>
                                <option>PKP EIP</option>
                                <option>PKS</option>
                                <option value="Samochód prywatny">Samochód prywatny</option>
                                <option value="Samochód służbowy">Samochód służbowy</option>
                                <option>Inne</option>
                            </select>
                            <p class="paraForError" id="rodzajLokomError"></p>
                        </div>

                        <div id="stawkaZaKmDIV">
                            <label for="stawkaZaKm">Stawka za kilometr</label><br />
                            <select id="stawkaZaKm" class="form-control">
                                <option style="display:none"></option>
                                <option value="0.52">Sam. osobowy - 0,52 zł/km</option>
                                <option value="0.83">Sam. osobowy - 0,83 zł/km</option>
                                <option value="dowolnaStawkaZaKm">Inna stawka</option>
                            </select>
                        </div>

                        <div id="dowolnaStawkaDIV">
                            <label for="dowolnaStawka">Podaj stawkę w zł za 1 km</label><br />
                            <input id="dowolnaStawka" type="text" class="form-control">
                            <p class="paraForError" id="kosztDowolnaStawkaZaKmError"></p>
                        </div>


                        <div id="iloscKmDIV">
                            <label for="iloscKM">Ilość kilometrów</label><br />
                            <input id="iloscKM" type="number" class="form-control">
                        </div>

                        <div id="kosztPodr">
                            <label for="kosztPrzejazdu">Koszt</label><br />
                            <input id="kosztPrzejazdu" type="text" class="form-control">
                            <p class="paraForError" id="kosztPrzejazduError"></p>
                        </div>


                    </div>

                    <div class="col-sm-3">
                        <div id="przyciskDodaj">
                            <label>&nbsp</label><br />
                            <button type="button" class="btn btn-block przycisk4 d-print-none"
                                id="buttonDodaj">Dodaj</button>
                        </div>
                        <div id="przyciskPodrozPowrotna">
                            <label>&nbsp</label><br />
                            <button type="button" class="btn btn-block przycisk4 d-print-none"
                                id="buttonPodrozPowrotna">Podróż powrotna</button>
                        </div>
                    </div>
                </div>

                <h4 class="mb-3 tabPod">Przejazdy - szczegóły</h4>
                <div class="row tabPod">
                    <div class="col-sm-12 mb-5">
                        <div id="divTabela" class="table-responsive">
                            <table id="tabelaPodroz" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Wyjazd</th>
                                        <th>Data</th>
                                        <th>Godzina</th>
                                        <th>Przyjazd</th>
                                        <th>Data</th>
                                        <th>Godzina</th>
                                        <th>Środek lokomocji</th>
                                        <th>Koszt</th>
                                        <th>Usuń</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row" id="buttonUsunIdRow">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <div id="buttonUsunId">
                            <button type="button" class="btn btn-block przycisk4 d-print-none"
                                id="buttonUsun">Usuń</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mt-5 col-sm-3">
                        <h4>Komunikacja miejska</h4>
                        <!-- <div class="form-check">
                                                <input type="checkbox" id="komunikacjaMiejska" class="form-check-input" name="komunikacjaMiejska">
                                                <label class="form-check-label" for="komunikacjaMiejska">Korzystałem z komunikacji miejskiej</label>
                                              </div> -->

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio1"
                                name="komunikacjaMiejska" checked>
                            <label class="form-check-label" for="komunikacjaMiejskaRadio1"> Nie korzystałem</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio2"
                                name="komunikacjaMiejska">
                            <label class="form-check-label" for="komunikacjaMiejskaRadio2"> Korzystałem</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio3"
                                name="komunikacjaMiejska">
                            <label class="form-check-label" for="komunikacjaMiejskaRadio3"> Korzystałem przez określoną
                                ilość dni:</label>
                        </div>
                        <div>
                            <input id="komunikacjaMiejskaIloscDni" type="text" value="" class="form-control"
                                name="komunikacjaMiejska" disabled>
                            <p class="paraForError" id="komunikacjaMiejskaIloscDniError"></p>
                        </div>
                    </div>
                </div>


                <div class="row mt-5">
                    <div id="obliczenia" class="col-sm-6 mb-5">
                        <h4>Podsumowanie podróży</h4>
                        <table id="idTabelaPodroz">
                            <tr>
                                <td>Rozpoczęcie podróży</td>
                                <td class="tabelaTdPodroz" id="rozpoczeciePodrozy"></td>
                            </tr>
                            <tr>
                                <td>Zakończenie podróży:</td>
                                <td class="tabelaTdPodroz" id="zakonczeniePodrozy"></td>
                            </tr>
                            <tr>
                                <td>Czas trwania:</td>
                                <td class="tabelaTdPodroz" id="czasTrwaniaPodrozy"></td>
                            </tr>
                            <tr>
                                <td>Koszt podróży:</td>
                                <td class="tabelaTdPodroz" id="kosztPodrozy"></td>
                            </tr>
                            <!-- Rząd tabeli ukryty, aby można było wykonać walidację i tutaj zapisywana jest ilość dób podróży -->
                            <tr hidden>
                                <td>Doby podróży:</td>
                                <td class="tabelaTdPodroz" id="dobyPodrozy"></td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 mb-5">
                        <div id="buttonObliczId">
                            <button type="button" id="buttonOblicz" class="btn btn-block przycisk4 d-print-none">Oblicz
                                Podróże</button>
                        </div>
                    </div>
                </div>

                <div id="zakwaterowanie">
                    <div class="row">
                        <div class="col-sm-3 mb-5">
                            <h4>Zakwaterowanie</h4>
                            <p>Korzystałem z:</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="zakwaterowanieButton1"
                                    name="zakwaterowanieButton" checked>
                                <label class="form-check-label" for="zakwaterowanieButton1"> ryczałtu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="zakwaterowanieButton2"
                                    name="zakwaterowanieButton">
                                <label class="form-check-label" for="zakwaterowanieButton2"> zakwaterowania w
                                    hotelu</label>
                            </div>
                            <div>
                                <label for="kosztHotel">Koszt zakwaterowania:</label>
                                <input id="kosztHotel" type="text" value="0" class="form-control"
                                    name="kosztHotel" disabled>
                                <p class="paraForError" id="kosztHotelError"></p>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-5">
                            <h4>Wyżywienie</h4>
                            <p>Zapewniono bezpłatnie posiłki w ilościach:</p>
                            <div id="idSniadanie">
                                <label for="sniadanie">Śniadanie:</label>
                                <input id="sniadanie" type="text" value="0" class="form-control"
                                    name="sniadanie">
                                <p class="paraForError" id="sniadanieError"></p>
                            </div>
                            <div id="idObiad">
                                <label for="obiad">Obiad:</label>
                                <input id="obiad" type="text" value="0" class="form-control"
                                    name="obiad">
                                <p class="paraForError" id="obiadError"></p>
                            </div>
                            <div id="idKolacja">
                                <label for="kolacja">Kolacja:</label>
                                <input id="kolacja" type="text" value="0" class="form-control"
                                    name="kolacja">
                                <p class="paraForError" id="kolacjaError"></p>
                            </div>
                        </div>

                        <div id="inneWydatki" class="col-sm-3">
                            <h4>Inne wydatki</h4>

                            <p>Poniesione wydatki zgodnie z rachunkami:</p>
                            <div id="idWydatki">
                                <label for="wydatki">Wydatki:</label>
                                <input id="wydatki" type="text" value="0" class="form-control"
                                    name="wydatki">
                                <p class="paraForError" id="wydatkiError"></p>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="mb-3">Rachunek kosztów podróży:</h2>
                        <table id="idTabelaRachunek">
                            <tr>
                                <td>Ryczałt za dojazdy:</td>
                                <td class="tabelaTdRachunek" id="idRyczalZaDojazdyWynik"></td>
                            </tr>
                            <tr>
                                <td>Razem przejazdy i dojazdy:</td>
                                <td class="tabelaTdRachunek" id="idRazemPrzejazdyDojazdy"></td>
                            </tr>
                            <tr>
                                <td>Diety:</td>
                                <td class="tabelaTdRachunek" id="idDiety"></td>
                            </tr>
                            <tr>
                                <td>Noclegi wg rachunków:</td>
                                <td class="tabelaTdRachunek" id="idNoclegiRachunki"></td>
                            </tr>
                            <tr>
                                <td>Noclegi ryczałty:</td>
                                <td class="tabelaTdRachunek" id="idNoclegiRyczalty"></td>
                            </tr>
                            <tr>
                                <td>Inne wydatki wg załączników:</td>
                                <td class="tabelaTdRachunek" id="idInneWydatki"></td>
                            </tr>
                            <tr>
                                <td>Ogółem:</td>
                                <td class="tabelaTdRachunek" id="idOgolem"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <div id="buttonObliczPodsumowanie">
                            <button type="button" id="buttonObliczPodsumowanie"
                                class="btn btn-block przycisk4 d-print-none">Oblicz Rachunek</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
