@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container mt-5 poczatkowyDiv" id="poczatekPrzejazdy">
            <div>
                <a href="#top" id="bottom"></a>
            </div>


            <div class="row">

                <div class="col-sm-6">
                    <h2 id="labelPodrozZagraniczna">PodrÃ³Å¼ zagraniczna</h2>
                </div>

                <div class="col-sm-3"></div>

            </div>


            <h3>I. PodrÃ³Å¼</h3>

            <div class="row">
                <div class="container">
                    <h5>Typ podrÃ³Å¼y zagranicznej</h5>
                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">RozpoczÄ™cie podrÃ³Å¼y zagranicznej w Polsce: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="1" id="typPodrozy1" checked> Polska ->
                            PaÅ„stwo A</label>
                    </div>

                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">RozpoczÄ™cie podrÃ³Å¼y zagranicznej w kraju za granicÄ…: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="2" id="typPodrozy2">
                            PaÅ„stwo A ->
                            PaÅ„stwo B</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mt-1 ">RozpoczÄ…cie podrÃ³Å¼y zagranicznej i sama podrÃ³Å¼ odbywa siÄ™ w danym kraju: </div>
                    <div class="radio mt-2">
                        <label><input type="radio" class="trip-type" name="typPodrozy" value="3" id="typPodrozy3">
                            PaÅ„stwo A ->
                            PaÅ„stwo A</label>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-sm-3">
                    <h5>Miejsce podrÃ³Å¼y</h5>
                    <label for="krajPodrozy">PaÅ„stwo</label><br />
                    <div>
                        <select id="krajPodrozy" class="form-control" name="kraj">
                            <option style="display:none"></option>
                            <option data-value='{"waluta":"EUR","dieta":"47","limit":"140"}'>Afganistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"120"}'>Albania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"200"}'>Algieria</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"200"}'>Andora</option><br>
                            <option data-value='{"waluta":"USD","dieta":"61","limit":"180"}'>Angola</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"200"}'>Arabia Saudyjska</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Argentyna</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"145"}'>Armenia</option><br>
                            <option data-value='{"waluta":"AUD","dieta":"95","limit":"270"}'>Australia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"57","limit":"150"}'>Austria</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"150"}'>AzerbejdÅ¼an</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"120"}'>Bangladesz</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"200"}'>Belgia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"130"}'>BiaÅ‚oruÅ›</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"100"}'>BoÅ›nia i Hercegowina</option>
                            <br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"120"}'>Brazylia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"120"}'>BuÅ‚garia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"120"}'>Chile</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"170"}'>Chiny</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"125"}'>Chorwacja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"160"}'>Cypr</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"110"}'>CzarnogÃ³ra</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"120"}'>Czechy</option><br>
                            <option data-value='{"waluta":"DKK","dieta":"446","limit":"1430"}'>Dania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"66","limit":"220"}'>Demokratyczna Republika Konga</option><br>
                            <option data-value='{"waluta":"USD","dieta":"55","limit":"150"}'>Egipt</option><br>
                            <option data-value='{"waluta":"USD","dieta":"44","limit":"110"}'>Ekwador</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"110"}'>Estonia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"55","limit":"300"}'>Etiopia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"53","limit":"180"}'>Finlandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"200"}'>Francja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"160"}'>Grecja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"160"}'>Gruzja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"200"}'>Hiszpania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"210"}'>Indie</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"110"}'>Indonezja</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"120"}'>Irak</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"95"}'>Iran</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"52","limit":"160"}'>Irlandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"56","limit":"160"}'>Islandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"70","limit":"200"}'>Izrael</option><br>
                            <option data-value='{"waluta":"JPY","dieta":"7532","limit":"22000"}'>Japonia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"48","limit":"160"}'>Jemen</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"130"}'>Jordania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"45","limit":"100"}'>KambodÅ¼a</option><br>
                            <option data-value='{"waluta":"CAD","dieta":"71","limit":"190"}'>Kanada</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"200"}'>Katar</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"155"}'>Kazachstan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"150"}'>Kenia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"41","limit":"150"}'>Kirgistan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"49","limit":"120"}'>Kolumbia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"66","limit":"220"}'>Kongo</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"46","limit":"170"}'>Korea PoÅ‚udniowa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"170"}'>KoreaÅ„ska Republika Ludowa
                                Demokratyczna
                            </option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"140"}'>Kostaryka</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"140"}'>Kuba</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"200"}'>Kuwejt</option><br>
                            <option data-value='{"waluta":"USD","dieta":"54","limit":"100"}'>Laos</option><br>
                            <option data-value='{"waluta":"USD","dieta":"57","limit":"150"}'>Liban</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"52","limit":"100"}'>Libia</option><br>
                            <option data-value='{"waluta":"CHF","dieta":"88","limit":"220"}'>Liechtenstein</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"150"}'>Litwa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"200"}'>Luksemburg</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"57","limit":"132"}'>Åotwa</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"138"}'>Macedonia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Malezja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"180"}'>Malta</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"130"}'>Maroko</option><br>
                            <option data-value='{"waluta":"USD","dieta":"58","limit":"154"}'>Meksyk</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"94"}'>MoÅ‚dawia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"55","limit":"200"}'>Monako</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"154"}'>Mongolia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"50","limit":"150"}'>Niderlandy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"49","limit":"170"}'>Niemcy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"46","limit":"240"}'>Nigeria</option><br>
                            <option data-value='{"waluta":"NOK","dieta":"496","limit":"1650"}'>Norwegia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"58","limit":"180"}'>Nowa Zelandia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"240"}'>Oman</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"38","limit":"200"}'>Pakistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"70","limit":"200"}'>Palestyna</option><br>
                            <option data-value='{"waluta":"USD","dieta":"52","limit":"140"}'>Panama</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Peru</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"49","limit":"150"}'>Portugalia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"52","limit":"275"}'>RPA</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"48","limit":"200"}'>Rosja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"42","limit":"110"}'>Rumunia</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"53","limit":"192"}'>San Marino</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"44","limit":"120"}'>Senegal</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"40","limit":"110"}'>Serbia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"56","limit":"230"}'>Singapur</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"47","limit":"132"}'>SÅ‚owacja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"45","limit":"143"}'>SÅ‚owenia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"200"}'>USA - PozostaÅ‚e</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"350"}'>USA - Nowy Jork</option><br>
                            <option data-value='{"waluta":"USD","dieta":"59","limit":"300"}'>USA - Waszyngton</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"150"}'>Syria</option><br>
                            <option data-value='{"waluta":"CHF","dieta":"88","limit":"220"}'>Szwajcaria</option><br>
                            <option data-value='{"waluta":"SEK","dieta":"510","limit":"2000"}'>Szwecja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>TadÅ¼ykistan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"42","limit":"110"}'>Tajlandia</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"150"}'>Tanzania</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"37","limit":"100"}'>Tunezja</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"185"}'>Turcja</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"47","limit":"90"}'>Turkmenistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"180"}'>Ukraina</option><br>
                            <option data-value='{"waluta":"USD","dieta":"50","limit":"80"}'>Urugwaj</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>Uzbekistan</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"53","limit":"192"}'>Watykan</option><br>
                            <option data-value='{"waluta":"USD","dieta":"60","limit":"220"}'>Wenezuela</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"44","limit":"143"}'>WÄ™gry</option><br>
                            <option data-value='{"waluta":"GBP","dieta":"45","limit":"220"}'>Wielka Brytania</option><br>
                            <option data-value='{"waluta":"USD","dieta":"53","limit":"160"}'>Wietnam</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"53","limit":"192"}'>WÅ‚ochy</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"33","limit":"100"}'>WybrzeÅ¼e KoÅ›ci SÅ‚oniowej
                            </option><br>
                            <option data-value='{"waluta":"EUR","dieta":"39","limit":"90"}'>Zimbabwe</option><br>
                            <option data-value='{"waluta":"EUR","dieta":"43","limit":"220"}'>Zjednoczone Emiraty Arabskie
                            </option><br>
                            <option data-value='{"waluta":"EUR","dieta":"41","limit":"140"}'>PaÅ„stwa inne niÅ¼ wymienione
                            </option><br>
                        </select>


                        <label for="labelWaluta">Waluta:</label><br />
                        <input id="labelWaluta" type="text" class="form-control" name="waluta" readonly>

                        <label for="labelKwotaDieta">Kwota diety:</label><br />
                        <input id="labelKwotaDieta" type="text" class="form-control" name="dieta" readonly>

                        <label for="labelLimitNocleg">Kwota limitu za nocleg:</label><br />
                        <input id="labelLimitNocleg" type="text" class="form-control" name="limitNocleg" readonly>

                    </div>
                </div>
                <div class="col-sm-3">
                    <h5>RozpoczÄ™cie podrÃ³Å¼y</h5>
                    <label for="dataRozpoPodrZ">Data</label><br />
                    <input id="dataRozpoPodrZ" type="date" class="form-control">
                    <label for="czasRozpoPodrZ">Godzina</label><br />
                    <input id="czasRozpoPodrZ" type="time" class="form-control">

                </div>
                <div class="col-sm-3">
                    <h5>ZakoÅ„czenie podrÃ³Å¼y</h5>
                    <label for="dataZakoPodrZ">Data</label><br />
                    <input id="dataZakoPodrZ" type="date" class="form-control">
                    <label for="czasZakoPodrZ">Godzina</label><br />
                    <input id="czasZakoPodrZ" type="time" class="form-control">
                </div>
            </div>

            <h5>Podsumowanie podrÃ³Å¼y</h5>

            <div class="row">
                <div id="obliczenia" class="col-sm-3">
                    <label for="rozpoczeciePodrozyZ">RozpoczÄ™cie podrÃ³Å¼y:</label><br />
                    <p id="rozpoczeciePodrozyZ"></p>
                </div>

                <div class="col-sm-3">
                    <label for="zakonczeniePodrozyZ">ZakoÅ„czenie podrÃ³Å¼y:</label><br />
                    <p id="zakonczeniePodrozyZ"></p>
                </div>

                <div class="col-sm-3">
                    <label for="czasTrwaniaPodrozyZ">Czas trwania [D:G:M]:</label><br />
                    <p id="czasTrwaniaPodrozyZ"></p>
                </div>
                <div class="col-sm-3">
                    <div id="buttonObliczIdZ">
                        <button type="button" id="buttonObliczZ" class="btn btn-block przycisk button-foreign">Oblicz
                            PodrÃ³Å¼</button>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">II. Koszty</h3>
            <div class="row">

                <div class="col-sm-3">
                    <h5>WyÅ¼ywienie</h5>
                    <form>
                        <p>Zapewniono bezpÅ‚atnie posiÅ‚ki w iloÅ›ciach:</p>
                        <div id="idSniadanieZ">
                            <label for="sniadanieZ">Åšniadanie:</label>
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
                    <p>KorzystaÅ‚em z:</p>
                    <form id="idZakwaterowanieForm">
                        <div class="radio">
                            <label><input type="radio" name="zakwaterowanieButton" value="1" id="zakwaterowanieButton1Z" checked>
                                ryczaÅ‚tu </label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="zakwaterowanieButton" value="2" id="zakwaterowanieButton2Z"> zakwaterowania
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
                            <label class="custom-control-label" for="komunikacjaMiejskaZ">KorzystaÅ‚em z komunikacji
                                miejskiej</label>
                        </div>
                        <div id="iDdojazdLotnisko" class="custom-control custom-checkbox">
                            <input type="checkbox" id="dojazdLotnisko" class="custom-control-input">
                            <label class="custom-control-label" for="dojazdLotnisko">Dojazd z/do lotniska</label>
                        </div>
                        <p id="pozostaleWydatkiLabel">PozostaÅ‚e wydatki zgodnie z rachunkami</p>
                        <div id="idWydatkiZ">
                            <label for="wydatkiZ">Wydatki:</label>
                            <input id="wydatkiZ" type="text" value="0" class="form-control">
                        </div>
                    </form>

                </div>

                <div class="col-sm-3">
                    <h5>NaleÅ¼ne diety</h5>
                    <p id="labelDietaZ"><b></b></p>
                    <h5>Odliczenia za wyÅ¼ywienie</h5>
                    <p id="labelZOdliczenia"><b></b></p>
                    <h5>Diety - Odliczenia</h5>
                    <p id="labelDietaZOdliczenia"><b></b></p>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <h5>RyczaÅ‚t wynosi</h5>
                    <p id="labelKosztZakwatarewaniaRyczaltZ"><b></b></p>
                </div>
                <div class="col-sm-3">
                    <h5>Inne wydatki suma</h5>
                    <p id="labelInneWydatkiPodsumZ"><b></b></p>
                </div>
                <div class="col-sm-3">
                    <div id="buttonObliczKosztyWrapperZ">
                        <button type="button" id="buttonObliczKosztyIdZ" class="btn btn-block przycisk2 button-foreign">Oblicz
                            Koszty</button>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">III. Rozliczenie zaliczki</h3>
            <div class="row">
                <div class="col-sm-3">
                    <h5>Zaliczka</h5>
                    <div id="idZaliczka">
                        <label for="zaliczka">Otrzymano kwotÄ™:</label>
                        <input id="zaliczka" type="text" value="0" class="form-control">
                    </div>
                </div>

                <div class="col-sm-3">
                    <h5>Wydatkowano</h5>
                    <div id="idWydatkowano">
                        <label for="wydatkowano">Wydano kwotÄ™:</label>
                        <p id="wydatkowano"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <h5>RoÅ¼nica</h5>
                    <div id="idRoznica">
                        <label for="roznica" id="diffDisplay">WpÅ‚aciÄ‡ do kasy:</label>
                        <p id="roznica"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div id="buttonObliczRachunekIdZlabel">
                        <button type="button" id="buttonObliczRachunekIdZ" class="btn btn-block przycisk3 button-foreign">Oblicz
                            Rachunek</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

