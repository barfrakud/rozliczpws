@extends('layouts.app')

@section('content')
    <div class="container">

        <div id="national-routes" data-summary-url="{{ route('krajowa.calculate-trip') }}" data-settlement-url="{{ route('krajowa.calculate-bill') }}"></div>

            <div class="container mt-5 poczatkowyDiv" id="poczatekPrzejazdy">

                <div class="row">
                    <div><a href="#top" id="bottom"></a></div>
                    <div class="col-sm-3">
                        <h2 id="labelPodrozKrajowa">PodrÃ³Å¼ krajowa</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>

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
                            <label for="miejsceRozpoPodr">MiejscowoÅ›Ä‡ wyjazdu</label><br />
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
                                <option value="KrakÃ³w GÅ‚Ã³wny">

                                <option value="BiaÅ‚ystok">
                                <option value="Bydgoszcz">
                                <option value="GdaÅ„sk">
                                <option value="Katowice">
                                <option value="Kielce">
                                <option value="KrakÃ³w">
                                <option value="Lublin">
                                <option value="ÅÃ³dÅº">
                                <option value="Olsztyn">
                                <option value="Opole">
                                <option value="PoznaÅ„">
                                <option value="RzeszÃ³w">
                                <option value="Szczecin">
                                <option value="Warszawa">
                                <option value="WrocÅ‚aw">
                                <option value="Zielona GÃ³ra">

                                <option value="DÄ™blin">
                            </datalist>

                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div id="przyjazd">
                            <label for="miejsceZakonPodr">MiejscowoÅ›Ä‡ przyjazdu</label><br />
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
                            <label for="rodzajLokom">Åšrodek lokomocji</label><br />
                            <select id="rodzajLokom" class="form-control">
                                <option style="display:none"></option>
                                <option>PKP TLK</option>
                                <option>PKP EIC</option>
                                <option>PKP EIP</option>
                                <option>PKS</option>
                                <option value="SamochÃ³d prywatny">SamochÃ³d prywatny</option>
                                <option value="SamochÃ³d sÅ‚uÅ¼bowy">SamochÃ³d sÅ‚uÅ¼bowy</option>
                                <option>Inne</option>
                            </select>
                            <p class="paraForError" id="rodzajLokomError"></p>
                        </div>

                        <div id="stawkaZaKmDIV">
                            <label for="stawkaZaKm">Stawka za kilometr</label><br />
                            <select id="stawkaZaKm" class="form-control">
                                <option style="display:none"></option>
                                <option value="0.52">Sam. osobowy - 0,52 zÅ‚/km</option>
                                <option value="0.83">Sam. osobowy - 0,83 zÅ‚/km</option>
                                <option value="dowolnaStawkaZaKm">Inna stawka</option>
                            </select>
                        </div>

                        <div id="dowolnaStawkaDIV">
                            <label for="dowolnaStawka">Podaj stawkÄ™ w zÅ‚ za 1 km</label><br />
                            <input id="dowolnaStawka" type="text" class="form-control">
                            <p class="paraForError" id="kosztDowolnaStawkaZaKmError"></p>
                        </div>


                        <div id="iloscKmDIV">
                            <label for="iloscKM">IloÅ›Ä‡ kilometrÃ³w</label><br />
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
                            <button type="button" class="btn btn-block przycisk4 d-print-none" id="buttonDodaj">Dodaj</button>
                        </div>
                        <div id="przyciskPodrozPowrotna">
                            <label>&nbsp</label><br />
                            <button type="button" class="btn btn-block przycisk4 d-print-none" id="buttonPodrozPowrotna">PodrÃ³Å¼ powrotna</button>
                        </div>
                    </div>
                </div>

                <h4 class="mb-3 tabPod">Przejazdy - szczegÃ³Å‚y</h4>
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
                                        <th>Åšrodek lokomocji</th>
                                        <th>Koszt</th>
                                        <th>UsuÅ„</th>
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
                            <button type="button" class="btn btn-block przycisk4 d-print-none" id="buttonUsun">UsuÅ„</button>
                        </div>
                    </div>
                </div>


                <div class="row mt-5">
                    <div id="obliczenia" class="col-sm-6 mb-5">
                        <h4>Podsumowanie podrÃ³Å¼y</h4>
                        <table id="idTabelaPodroz">
                            <tr>
                                <td>RozpoczÄ™cie podrÃ³Å¼y</td>
                                <td class="tabelaTdPodroz" id="rozpoczeciePodrozy"></td>
                            </tr>
                            <tr>
                                <td>ZakoÅ„czenie podrÃ³Å¼y:</td>
                                <td class="tabelaTdPodroz" id="zakonczeniePodrozy"></td>
                            </tr>
                            <tr>
                                <td>Czas trwania:</td>
                                <td class="tabelaTdPodroz" id="czasTrwaniaPodrozy"></td>
                            </tr>
                            <tr>
                                <td>Koszt podrÃ³Å¼y:</td>
                                <td class="tabelaTdPodroz" id="kosztPodrozy"></td>
                            </tr>
                            <!-- RzÄ…d tabeli ukryty, aby moÅ¼na byÅ‚o wykonaÄ‡ walidacjÄ™ i tutaj zapisywana jest iloÅ›Ä‡ dÃ³b podrÃ³Å¼y -->
                            <tr hidden>
                                <td>Doby podrÃ³Å¼y:</td>
                                <td class="tabelaTdPodroz" id="dobyPodrozy"></td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 mb-5">
                        <div id="buttonObliczId">
                            <button type="button" id="buttonOblicz" class="btn btn-block przycisk4 d-print-none">Oblicz
                                PodrÃ³Å¼e</button>
                        </div>
                    </div>
                </div>

                <div id="zakwaterowanie" class="mt-5">
                    <div class="row">

                        <div class="col-sm-3">
                            <h4>Komunikacja miejska</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio1" name="komunikacjaMiejska" checked>
                                <label class="form-check-label" for="komunikacjaMiejskaRadio1"> Nie korzystaÅ‚em</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio2" name="komunikacjaMiejska">
                                <label class="form-check-label" for="komunikacjaMiejskaRadio2"> KorzystaÅ‚em</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="komunikacjaMiejskaRadio3" name="komunikacjaMiejska">
                                <label class="form-check-label" for="komunikacjaMiejskaRadio3"> KorzystaÅ‚em przez
                                    okreÅ›lonÄ…
                                    iloÅ›Ä‡ dni:</label>
                            </div>
                            <div>
                                <input id="komunikacjaMiejskaIloscDni" type="text" value="" class="form-control" name="komunikacjaMiejska" disabled>
                                <p class="paraForError" id="komunikacjaMiejskaIloscDniError"></p>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-5">
                            <h4>Zakwaterowanie</h4>
                            <p>KorzystaÅ‚em z:</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="zakwaterowanieButton1" name="zakwaterowanieButton" checked>
                                <label class="form-check-label" for="zakwaterowanieButton1"> ryczaÅ‚tu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="zakwaterowanieButton2" name="zakwaterowanieButton">
                                <label class="form-check-label" for="zakwaterowanieButton2"> zakwaterowania w
                                    hotelu</label>
                            </div>
                            <div>
                                <label for="kosztHotel">Koszt zakwaterowania:</label>
                                <input id="kosztHotel" type="text" value="0" class="form-control" name="kosztHotel" disabled>
                                <p class="paraForError" id="kosztHotelError"></p>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-5">
                            <h4>WyÅ¼ywienie</h4>
                            <p>Zapewniono bezpÅ‚atnie posiÅ‚ki w iloÅ›ciach:</p>
                            <div id="idSniadanie">
                                <label for="sniadanie">Åšniadanie:</label>
                                <input id="sniadanie" type="text" value="0" class="form-control" name="sniadanie">
                                <p class="paraForError" id="sniadanieError"></p>
                            </div>
                            <div id="idObiad">
                                <label for="obiad">Obiad:</label>
                                <input id="obiad" type="text" value="0" class="form-control" name="obiad">
                                <p class="paraForError" id="obiadError"></p>
                            </div>
                            <div id="idKolacja">
                                <label for="kolacja">Kolacja:</label>
                                <input id="kolacja" type="text" value="0" class="form-control" name="kolacja">
                                <p class="paraForError" id="kolacjaError"></p>
                            </div>
                        </div>

                        <div id="inneWydatki" class="col-sm-3">
                            <h4>Inne wydatki</h4>

                            <p>Poniesione wydatki zgodnie z rachunkami:</p>
                            <div id="idWydatki">
                                <label for="wydatki">Wydatki:</label>
                                <input id="wydatki" type="text" value="0" class="form-control" name="wydatki">
                                <p class="paraForError" id="wydatkiError"></p>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="mb-3">Rachunek kosztÃ³w podrÃ³Å¼y:</h2>
                        <table id="idTabelaRachunek">
                            <tr>
                                <td>RyczaÅ‚t za dojazdy:</td>
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
                                <td>Noclegi wg rachunkÃ³w:</td>
                                <td class="tabelaTdRachunek" id="idNoclegiRachunki"></td>
                            </tr>
                            <tr>
                                <td>Noclegi ryczaÅ‚ty:</td>
                                <td class="tabelaTdRachunek" id="idNoclegiRyczalty"></td>
                            </tr>
                            <tr>
                                <td>Inne wydatki wg zaÅ‚Ä…cznikÃ³w:</td>
                                <td class="tabelaTdRachunek" id="idInneWydatki"></td>
                            </tr>
                            <tr>
                                <td>OgÃ³Å‚em:</td>
                                <td class="tabelaTdRachunek" id="idOgolem"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <div id="buttonObliczPodsumowanieWrapper">
                            <button type="button" id="buttonObliczPodsumowanie" class="btn btn-block przycisk4 d-print-none">Oblicz Rachunek</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection


