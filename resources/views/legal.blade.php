@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="podstawaPrawnaDivId" class="container mt-5">
            <div class="intro">
                <h2>Podstawa prawna</h2>
                <p>
                    Kalkulator delegacji służbowej <strong>rozliczPWS.pl</strong> ułatwia rozliczenie kosztów wyjazdu
                    służbowego
                    pracownika w oparciu o wprowadzone do formularza parametry. <br><br>
                </p>
                <p>
                    Obliczenia mają charakter pomocniczy i autor strony rozliczpws.pl nie ponosi odpowiedzialności za
                    prawidłowość
                    przeprowadzonych obliczeń. <br> <br>
                </p>
                <p>
                    Algorytm obliczający rachunek kosztów podróży został opracowany na podstawie przepisów zawartych
                    w:
                </p>
                <ul>
                    <li>
                        Rozporządzenie Ministra Pracy i Polityki Społecznej z dnia 29 stycznia 2013 r. w sprawie należności
                        przysługujących pracownikowi zatrudnionemu w państwowej lub samorządowej jednostce sfery budżetowej
                        z tytułu podróży służbowej (Dz.U. 2013 poz. 167).
                    </li>
                    <li>
                        Rozporządzenie Ministra Rodziny i Polityki Społecznej z dnia 30 czerwca 2022 r. zmieniające rozporządzenie
                        w sprawie należności przysługujących pracownikowi zatrudnionemu w państwowej
                        lub samorządowej jednostce sfery budżetowej z tytułu podróży służbowej (Dz.U. 2022 poz. 1481).
                    </li>
                    <li>
                        Rozporządzenie Ministra Rodziny i Polityki Społecznej z dnia 25 października 2022 r. zmieniające rozporządzenie
                        w sprawie należności przysługujących pracownikowi zatrudnionemu w państwowej lub samorządowej jednostce sfery
                        budżetowej z tytułu podróży służbowej (Dz.U. 2022 poz. 2302).
                    </li>
                </ul>

                <p>
                    W przypadku wykrytych błędów proszę o kontakt poprzez formularz kontaktowy, GitHub lub wiadomość na
                    Facebook.<br><br>
                </p>
                <p>
                    Jeśli chciałbyś wspomóc projekt to zapraszam na github do współpracy.
                </p>
            </div>

            <div class="legal-national mt-5">

                <h3>PODRÓŻ KRAJOWA</h3>
                <p>
                    § 6.
                </p>
                <p>
                    1. Miejscowość rozpoczęcia i zakończenia podróży krajowej określa
                    pracodawca.
                </p>
                <p>
                    2. Pracodawca może uznać za miejscowość rozpoczęcia lub zakończenia podróży
                    krajowej miejscowość pobytu stałego lub czasowego pracownika.
                </p>
                <p>
                    § 7.
                </p>
                <p>
                    1. Dieta w czasie podróży krajowej jest przeznaczona na pokrycie
                    zwiększonych kosztów wyżywienia i wynosi 30 zł za dobę podróży.
                </p>
                <p>
                    2. Należność z tytułu diet oblicza się za czas od rozpoczęcia podróży
                    krajowej (wyjazdu) do powrotu (przyjazdu) po wykonaniu zadania służbowego w
                    następujący sposób:
                </p>
                <p>
                    1) jeżeli podróż trwa nie dłużej niż dobę i wynosi:
                </p>
                <p>
                    a) mniej niż 8 godzin – dieta nie przysługuje,
                </p>
                <p>
                    b) od 8 do 12 godzin – przysługuje 50% diety,
                </p>
                <p>
                    c) ponad 12 godzin – przysługuje dieta w pełnej wysokości;
                </p>
                <p>
                    2) jeżeli podróż trwa dłużej niż dobę, za każdą dobę przysługuje dieta w
                    pełnej wysokości, a za niepełną, ale rozpoczętą dobę:
                </p>
                <p>
                    a) do 8 godzin – przysługuje 50% diety,
                </p>
                <p>
                    b) ponad 8 godzin – przysługuje dieta w pełnej wysokości.
                </p>
                <p>
                    3. Dieta nie przysługuje:
                </p>
                <p>
                    1) za czas delegowania do miejscowości pobytu stałego lub czasowego
                    pracownika oraz w przypadkach, o których mowa w § 10;
                </p>
                <p>
                    2) jeżeli pracownikowi zapewniono bezpłatne całodzienne wyżywienie.
                </p>
                <p>
                    4. Kwotę diety, o której mowa w ust. 1, zmniejsza się o koszt zapewnionego
                    bezpłatnego wyżywienia, przyjmując, że każdy posiłek stanowi odpowiednio:
                </p>
                <p>
                    1) śniadanie – 25% diety;
                </p>
                <p>
                    2) obiad – 50% diety;
                </p>
                <p>
                    3) kolacja – 25% diety.
                </p>
                <p>
                    5. W przypadku korzystania przez pracownika z usługi hotelarskiej, w ramach
                    której zapewniono wyżywienie, przepisy ust. 4 stosuje się odpowiednio.
                </p>
                <p>
                    § 8.
                </p>
                <p>
                    1. Za nocleg podczas podróży krajowej w obiekcie świadczącym usługi
                    hotelarskie pracownikowi przysługuje zwrot kosztów w wysokości stwierdzonej
                    rachunkiem, jednak nie wyższej za jedną dobę hotelową niż
                    dwudziestokrotność stawki diety.
                </p>
                <p>
                    2. W uzasadnionych przypadkach pracodawca może wyrazić zgodę na zwrot
                    kosztów noclegu stwierdzonych rachunkiem w wysokości przekraczającej limit,
                    o którym mowa w ust. 1.
                </p>
                <p>
                    3. Pracownikowi, któremu nie zapewniono bezpłatnego noclegu i który nie
                    przedłożył rachunku, o którym mowa
                </p>
                <p>
                    w ust. 1, przysługuje ryczałt za każdy nocleg w wysokości 150% diety.
                </p>
                <p>
                    4. Ryczałt za nocleg przysługuje, jeżeli nocleg trwa co najmniej 6 godzin
                    pomiędzy godzinami 21 i 7.
                </p>
                <p>
                    5. Zwrot kosztów noclegu lub ryczałt za nocleg nie przysługuje za czas
                    przejazdu, a także jeżeli pracodawca uzna, że pracownik ma możliwość
                    codziennego powrotu do miejscowości stałego lub czasowego pobytu.
                </p>
                <p>
                    § 9.
                </p>
                <p>
                    1. Za każdą rozpoczętą dobę pobytu w podróży krajowej pracownikowi
                    przysługuje ryczałt na pokrycie kosztów dojazdów środkami komunikacji
                    miejscowej w wysokości 20% diety.
                </p>
                <p>
                    2. Ryczałt, o którym mowa w ust. 1, nie przysługuje, jeżeli pracownik nie
                    ponosi kosztów dojazdów.
                </p>
                <p>
                    3. Przepisu ust. 1 nie stosuje się, jeżeli na wniosek pracownika pracodawca
                    wyrazi zgodę na pokrycie udokumentowanych kosztów dojazdów środkami
                    komunikacji miejscowej.
                </p>
                <p>
                    § 10.
                </p>
                <p>
                    Pracownikowi przebywającemu w podróży krajowej trwającej co najmniej 10 dni
                    przysługuje zwrot kosztów przejazdu w dniu wolnym od pracy, środkiem
                    transportu określonym przez pracodawcę, do miejscowości pobytu stałego lub
                    czasowego i z powrotem.
                </p>
                <p>
                    § 11.
                </p>
                <p>
                    Na wniosek pracownika pracodawca przyznaje zaliczkę na niezbędne koszty
                    podróży krajowej w wysokości wynikającej ze wstępnej kalkulacji tych
                    kosztów.
                </p> <br>
            </div>

            <div class="legal-foreign">

                <h3>PODRÓŻ ZAGRANICZNA</h3>
                <p>
                    § 12.
                </p>
                <p>
                    Czas podróży zagranicznej liczy się w przypadku odbywania jej środkami
                    komunikacji:
                </p>
                <p>
                    1) lądowej – od chwili przekroczenia granicy państwowej w drodze za granicę
                    do chwili jej przekroczenia w drodze powrotnej do kraju;
                </p>
                <p>
                    2) lotniczej – od chwili startu samolotu w drodze za granicę z ostatniego
                    lotniska w kraju do chwili lądowania samolotu w drodze powrotnej na
                    pierwszym lotnisku w kraju;
                </p>
                <p>
                    3) morskiej – od chwili wyjścia statku (promu) z ostatniego portu polskiego
                    do chwili wejścia statku (promu) w drodze powrotnej do pierwszego portu
                    polskiego.
                </p>
                <p>
                    § 13.
                </p>
                <p>
                    1. Dieta w czasie podróży zagranicznej jest przeznaczona na pokrycie
                    kosztów wyżywienia i inne drobne wydatki.
                </p>
                <p>
                    2. Dieta przysługuje w wysokości obowiązującej dla docelowego państwa
                    podróży zagranicznej. W przypadku podróży zagranicznej odbywanej do dwóch
                    lub więcej państw pracodawca może ustalić więcej niż jedno państwo
                    docelowe.
                </p>
                <p>
                    3. Należność z tytułu diet oblicza się w następujący sposób:
                </p>
                <p>
                    1) za każdą dobę podróży zagranicznej przysługuje dieta w pełnej wysokości;
                </p>
                <p>
                    2) za niepełną dobę podróży zagranicznej:
                </p>
                <p>
                    a) do 8 godzin – przysługuje 1/3 diety,
                </p>
                <p>
                    b) ponad 8 do 12 godzin – przysługuje 50% diety,
                </p>
                <p>
                    c) ponad 12 godzin – przysługuje dieta w pełnej wysokości.
                </p>
                <p>
                    4. Wysokość diety za dobę podróży zagranicznej w poszczególnych państwach
                    jest określona w załączniku do rozporządzenia.
                </p>
                <p>
                    § 14.
                </p>
                <p>
                    1. Pracownikowi, któremu zapewniono w czasie podróży zagranicznej
                    bezpłatne, całodzienne wyżywienie, przysługuje
                </p>
                <p>
                    25% diety ustalonej zgodnie z § 13 ust. 3.
                </p>
                <p>
                    2. Kwotę diety zmniejsza się o koszt zapewnionego bezpłatnego wyżywienia,
                    przyjmując, że każdy posiłek stanowi odpowiednio:
                </p>
                <p>
                    1) śniadanie – 15% diety;
                </p>
                <p>
                    2) obiad – 30% diety;
                </p>
                <p>
                    3) kolacja – 30% diety.
                </p>
                <p>
                    3. W przypadku korzystania przez pracownika z usługi hotelarskiej, w ramach
                    której zapewniono wyżywienie, przepisy ust. 2 stosuje się odpowiednio.
                </p>
                <p>
                    4. Pracownikowi, który otrzymuje w czasie podróży zagranicznej należność
                    pieniężną na wyżywienie, dieta nie przysługuje.
                </p>
                <p>
                    Jeżeli należność pieniężna jest niższa od diety, pracownikowi przysługuje
                    wyrównanie do wysokości należnej diety.
                </p>
                <p>
                    § 15.
                </p>
                <p>
                    Za każdy dzień (dobę) pobytu w szpitalu lub innym zakładzie leczniczym w
                    czasie podróży zagranicznej pracownikowi przysługuje 25% diety.
                </p>
                <p>
                    § 16.
                </p>
                <p>
                    1. Za nocleg podczas podróży zagranicznej pracownikowi przysługuje zwrot
                    kosztów w wysokości stwierdzonej rachunkiem, w granicach limitu określonego
                    w poszczególnych państwach w załączniku do rozporządzenia.
                </p>
                <p>
                    2. W razie nieprzedłożenia rachunku za nocleg, pracownikowi przysługuje
                    ryczałt w wysokości 25% limitu, o którym mowa w ust. 1. Ryczałt ten nie
                    przysługuje za czas przejazdu.
                </p>
                <p>
                    3. W uzasadnionych przypadkach pracodawca może wyrazić zgodę na zwrot
                    kosztów za nocleg, stwierdzonych rachunkiem, w wysokości przekraczającej
                    limit, o którym mowa w ust. 1.
                </p>
                <p>
                    4. Przepisów ust. 1 i 2 nie stosuje się, jeżeli pracodawca lub strona
                    zagraniczna zapewniają pracownikowi bezpłatny nocleg.
                </p>
                <p>
                    § 17.
                </p>
                <p>
                    1. Pracownikowi przysługuje ryczałt na pokrycie kosztów dojazdu z i do
                    dworca kolejowego, autobusowego, portu lotniczego lub morskiego w wysokości
                    jednej diety w miejscowości docelowej za granicą oraz w każdej innej
                    miejscowości za granicą, w której pracownik korzystał z noclegu.
                </p>
                <p>
                    2. W przypadku gdy pracownik ponosi koszty dojazdu, o których mowa w ust.
                    1, wyłącznie w jedną stronę, przysługuje ryczałt w wysokości 50% diety.
                </p>
                <p>
                    3. Na pokrycie kosztów dojazdów środkami komunikacji miejscowej
                    pracownikowi przysługuje ryczałt w wysokości 10% diety za każdą rozpoczętą
                    dobę pobytu w podróży zagranicznej.
                </p>
                <p>
                    4. Ryczałty, o których mowa w ust. 1–3, nie przysługują, jeżeli pracownik:
                </p>
                <p>
                    1) odbywa podróż zagraniczną służbowym lub prywatnym pojazdem samochodowym,
                    motocyklem lub motorowerem;
                </p>
                <p>
                    2) ma zapewnione bezpłatne dojazdy;
                </p>
                <p>
                    3) nie ponosi kosztów, na pokrycie których są przeznaczone te ryczałty.
                </p>
                <p>
                    § 18.
                </p>
                <p>
                    Pracodawca może wyrazić zgodę na zwrot kosztów przewozu samolotem bagażu
                    osobistego o wadze do 30 kg, liczonej łącznie z wagą bagażu opłaconego w
                    cenie biletu, jeżeli podróż zagraniczna trwa ponad 30 dni lub jeżeli
                    państwem docelowym jest państwo pozaeuropejskie.
                </p>
                <p>
                    § 19.
                </p>
                <p>
                    1. W przypadku choroby powstałej podczas podróży zagranicznej pracownikowi
                    przysługuje zwrot udokumentowanych niezbędnych kosztów leczenia za granicą.
                </p>
                <p>
                    2. Zwrot kosztów, o których mowa w ust. 1, następuje ze środków pracodawcy,
                    z wyjątkiem świadczeń gwarantowanych udzielonych zgodnie z przepisami o
                    koordynacji systemów zabezpieczenia społecznego w Unii Europejskiej, o
                    których mowa w art. 5 pkt 32 ustawy z dnia 27 sierpnia 2004 r. o
                    świadczeniach opieki zdrowotnej finansowanych ze środków publicznych (Dz.
                    U. z 2008 r. Nr 164, poz. 1027, z późn. zm.3)).
                </p>
                <p>
                    3. Nie podlegają zwrotowi koszty zakupu leków, których nabycie za granicą
                    nie było konieczne, koszty zabiegów chirurgii plastycznej i kosmetycznych
                    oraz koszty nabycia protez ortopedycznych, dentystycznych lub okularów.
                </p>
                <p>
                    4. W razie zgonu pracownika za granicą, pracodawca pokrywa koszty
                    transportu zwłok do kraju.
                </p>
                <p>
                    § 20.
                </p>
                <p>
                    1. Pracownik otrzymuje zaliczkę w walucie obcej na niezbędne koszty podróży
                    zagranicznej, w wysokości wynikającej ze wstępnej kalkulacji tych kosztów.
                </p>
                <p>
                    2. Za zgodą pracownika zaliczka może być wypłacona w walucie polskiej, w
                    wysokości stanowiącej równowartość przysługującej pracownikowi zaliczki w
                    walucie obcej, według średniego kursu złotego w stosunku do walut obcych
                    określonego przez Narodowy Bank Polski z dnia wypłaty zaliczki.
                </p>
                <p>
                    3. Rozliczenie kosztów podróży zagranicznej jest dokonywane w walucie
                    otrzymanej zaliczki, w walucie wymienialnej albo w walucie polskiej, według
                    średniego kursu z dnia jej wypłacenia.
                </p>
                <p>
                    § 21.
                </p>
                <p>
                    W przypadku odbywania podróży zagranicznej w połączeniu z przejazdem na
                    obszarze kraju, przepisy rozdziału 2 stosuje się odpowiednio.
                </p>
            </div>

        </div>
    </div>
@endsection
