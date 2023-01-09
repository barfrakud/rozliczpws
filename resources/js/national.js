$(function () {

    console.log('Start podróż krajowa national');
    // Definicje funkcji
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funkcja ustawiające numer wersji oprogramowania na każdej stronie i podstronie.
    document.getElementById("idFooterText").innerHTML = "rozliczPWS.pl v2.1.1 &#169 barfrakud";

    // Funkcja - Odczytywanie danych z tabeli i przesłanie AJAX'em do skryptu php
    function obliczPodroze() {

        // Inicjacja tabeli
        var tab = document.getElementById("tabelaPodroz");

        // Ilość rzędów w tabeli
        var iloscRzedow = tab.rows.length;

        // Parsowanie danych z tabeli
        // Miejscowość
        var mRozpoPodr = tab.rows[1].cells[0].innerHTML;
        var mZakonPodr = tab.rows[iloscRzedow - 1].cells[3].innerHTML;

        // Czas podróży
        var czRozpoPodr = tab.rows[1].cells[1].innerHTML + " " + tab.rows[1].cells[2].innerHTML;
        var czZakonPodr = tab.rows[iloscRzedow - 1].cells[4].innerHTML + " " + tab.rows[iloscRzedow - 1].cells[5].innerHTML;

        //Koszt podróży
        var kosztPodr = 0;
        var i;
        for (i = 1; i < iloscRzedow; i++) {
            kosztPodr += Number(parseFloat((tab.rows[i].cells[7].innerHTML).replace(",", ".")).toFixed(2));
        }

        // AJAX wysłanie/odebranie danych do/z serwera
        $.ajax({
            url: "public/krajowa/oblicz-podroze",
            method: "POST",
            data: {
                mRozpoPodr: mRozpoPodr,
                czRozpoPodr: czRozpoPodr,
                mZakonPodr: mZakonPodr,
                czZakonPodr: czZakonPodr,
                kosztPodr: kosztPodr
            },
            dataType: 'json',
            success: function (dane) {

                //Prezentacja obliczeń
                var rozpoczeciePodrozyFormat = dane[0] + ", " + dane[2].slice(8, 10) + "." + dane[2].slice(5, 7) + "." + dane[2].slice(0, 4) + ", " + dane[2].slice(11, 16); //2019-02-02 22:43
                $("#rozpoczeciePodrozy").html("<b>" + "<em>" + rozpoczeciePodrozyFormat + "</em>" + "</b>");

                var zakonczeniePodrozyFormat = dane[1] + ", " + dane[3].slice(8, 10) + "." + dane[3].slice(5, 7) + "." + dane[3].slice(0, 4) + ", " + dane[3].slice(11, 16);
                $("#zakonczeniePodrozy").html("<b>" + "<em>" + zakonczeniePodrozyFormat + "</em>" + "</b>");

                var kosztPodrozy = dane[4];
                $("#kosztPodrozy").html("<b>" + "<em>" + kosztPodrozy + " zł" + "</em>" + "</b>");

                var czasPodrozy = dane[5];
                $("#czasTrwaniaPodrozy").html("<b>" + "<em>" + czasPodrozy + "</em>" + "</b>");

                var dobyPodrozy = dane[6];
                $("#dobyPodrozy").html(dobyPodrozy);

            }
        });
    }

    // Funkcja - Odczytywanie danych i przesłanie AJAX'em do skryptu php w celu wykonania głównyc obliczeń - Oblicz Rachunek
    function obliczRachunek() {

        ///Parsowanie z tabeli - powtórzone z funkcji wyżej ale póki co może zostać
        // Inicjacja tabeli 1
        var tab = document.getElementById("tabelaPodroz");

        //Ilość rzędów w tabeli
        var iloscRzedow = tab.rows.length;

        //Czas podróży
        var czRozpoPodr = tab.rows[1].cells[1].innerHTML + " " + tab.rows[1].cells[2].innerHTML;
        var czZakonPodr = tab.rows[iloscRzedow - 1].cells[4].innerHTML + " " + tab.rows[iloscRzedow - 1].cells[5].innerHTML;
        ///

        //Koszt podróży
        var kosztPodr = 0;
        var i;
        for (i = 1; i < iloscRzedow; i++) {
            kosztPodr += Number(parseFloat((tab.rows[i].cells[7].innerHTML).replace(",", ".")).toFixed(2));
        }



        //Komunikacja miejska - odczytywanie wartości true/false
        var komunikacjaMiejskaRadio1 = $("#komunikacjaMiejskaRadio1").is(':checked');
        var komunikacjaMiejskaRadio2 = $("#komunikacjaMiejskaRadio2").is(':checked');
        var komunikacjaMiejskaRadio3 = $("#komunikacjaMiejskaRadio3").is(':checked');
        var komunikacjaMiejskaIloscDni = $("#komunikacjaMiejskaIloscDni").val();

        //Sprawdzenie czy zaznaczono radio button - true/false
        var zakwRyczalt = $("#zakwaterowanieButton1").is(':checked');
        var zakwHotel = $("#zakwaterowanieButton2").is(':checked');

        //Pobranie wartości z inputów
        var hotelKoszt = $("#kosztHotel").val().replace(",", "."); //Zamiana , na .
        var sniadanieIlosc = $("#sniadanie").val();
        var obiadIlosc = $("#obiad").val();
        var kolacjaIlosc = $("#kolacja").val();
        var wydatkiKwota = $("#wydatki").val().replace(",", ".");


        // AJAX wysłanie/odebranie danych do/z serwera
        $.ajax({
            url: "public/krajowa/oblicz-rachunek",
            method: "POST",
            data: {
                czRozpoPodr: czRozpoPodr,
                czZakonPodr: czZakonPodr,
                kosztPodr: kosztPodr,
                komunikacjaMiejskaRadio1: komunikacjaMiejskaRadio1,
                komunikacjaMiejskaRadio2: komunikacjaMiejskaRadio2,
                komunikacjaMiejskaRadio3: komunikacjaMiejskaRadio3,
                komunikacjaMiejskaIloscDni: komunikacjaMiejskaIloscDni,
                zakwRyczalt: zakwRyczalt,
                zakwHotel: zakwHotel,
                hotelKoszt: hotelKoszt,
                sniadanieIlosc: sniadanieIlosc,
                obiadIlosc: obiadIlosc,
                kolacjaIlosc: kolacjaIlosc,
                wydatkiKwota: wydatkiKwota
            },
            dataType: 'json',
            success: function (dane) {

                //Odebranie danych
                var ryczaltDojazdy = dane['ryczaltDojazdy'];
                var razemDojazdyPrzejazdy = dane['razemDojazdyPrzejazdy'];
                var dietaMinusOdliczenia = dane['dietaMinusOdliczenia'];
                var kosztNoclegu = dane['kosztNoclegu'];
                var noclegRyczaltWynik = dane['noclegRyczaltWynik'];
                var inneKoszt = dane['inneKoszt'];
                var obliczOgolemWynik = dane['obliczOgolemWynik'];


                //Prezentacja obliczeń
                $("#idRyczalZaDojazdyWynik").html("<b>" + "<em>" + ryczaltDojazdy + " zł" + "</em>" + "</b>");
                $("#idRazemPrzejazdyDojazdy").html("<b>" + "<em>" + razemDojazdyPrzejazdy + " zł" + "</em>" + "</b>");
                $("#idDiety").html("<b>" + "<em>" + dietaMinusOdliczenia + " zł" + "</em>" + "</b>");
                $("#idNoclegiRachunki").html("<b>" + "<em>" + kosztNoclegu + " zł" + "</em>" + "</b>");
                $("#idNoclegiRyczalty").html("<b>" + "<em>" + noclegRyczaltWynik + " zł" + "</em>" + "</b>");
                $("#idInneWydatki").html("<b>" + "<em>" + inneKoszt + " zł" + "</em>" + "</b>");
                $("#idOgolem").html("<b>" + "<em>" + obliczOgolemWynik + " zł" + "</em>" + "</b>");
            }
        });
    }

    // Funkcja - Zamiana miejscowości - Podróż powrotna i wykasowanie wartości pól
    function zamienMiejscowosci() {
        var miejsceRozpoPodr = $("#miejsceRozpoPodr").val();
        var miejsceZakonPodr = $("#miejsceZakonPodr").val();
        $("#miejsceRozpoPodr").val(miejsceZakonPodr);
        $("#miejsceZakonPodr").val(miejsceRozpoPodr);

        $("#dataRozpoPodr").val("");
        $("#czasRozpoPodr").val("");

        $("#dataZakonPodr").val("");
        $("#czasZakonPodr").val("");

        $("#rodzajLokom").val("");
        $("#stawkaZaKm").val("");
        $("#iloscKM").val("");
        $("#kosztPrzejazdu").val("");

    }

    // Funkcja - Obługa podróży samochodem prywatnym - pojawienie się dodatkowych pół: Stawka za km i Ilość km
    function pokazPodrozSamPrywatnym() {
        if ($("#rodzajLokom").val() === "Samochód prywatny") {
            $("#stawkaZaKmDIV").show(300);
            $("#iloscKmDIV").show(300);
        } else {
            $("#stawkaZaKmDIV").hide(300);
            $("#iloscKmDIV").hide(300);
            $("#dowolnaStawkaDIV").hide(300);
        }
    }

    // Funkcja - Obliczanie kosztu przejazdu samochodem prywatnym
    function obliczKosztPrzejazduSamochodemPrywatnym() {
        var stawka;
        if ($("#stawkaZaKm").val() === "dowolnaStawkaZaKm") {
            stawka = $("#dowolnaStawka").val().replace(",", ".");
        } else {
            stawka = $("#stawkaZaKm").val();
        }

        var przejachaneKM = $("#iloscKM").val();

        var koszPrzejazdu = przejachaneKM * stawka;
        return koszPrzejazdu;
    }

    // Funkcja - Deaktywacja Input Koszt Zakwaterowania
    function deaktywacjaInputKosztZakwaterowania() {
        $("#kosztHotel").attr('disabled', true);
        $("#kosztHotelError").html("").hide(100);
    }

    // Funkcja - Aktywacja Input Koszt Zakwaterowania
    function aktywacjaInputKosztZakwaterowania() {
        $("#kosztHotel").attr('disabled', false);
    }

    //Walidacja Koszt Zakwaterowania
    function walidacjaKosztZakwaterowania() {
        var hotelKoszt = $("#kosztHotel").val();
        try {
            $("#kosztHotelError").html("").hide(100);
            if (hotelKoszt == "") {
                blad = true;
                throw "Podaj koszt!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(hotelKoszt)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#kosztHotelError").html(err).show(300);
        }
    }

    //Walidacja Wydatki
    function walidacjaKosztInneWydatki() {
        var wydatkiKwota = $("#wydatki").val();
        try {
            $("#wydatkiError").html("").hide(100);
            if (wydatkiKwota == "") {
                blad = true;
                throw "Podaj koszt!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(wydatkiKwota)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#wydatkiError").html(err).show(300);
        }
    }

    //Walidacja Śniadanie Obiad Kolacja
    function walidacjaSniadanie() {
        var sniadanieIlosc = $("#sniadanie").val();
        try {
            $("#sniadanieError").html("").hide(100);
            if (sniadanieIlosc == "") {
                blad = true;
                throw "Podaj ilość!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d+$/;
            if (!regex.test(sniadanieIlosc)) {
                blad = true;
                throw "Czy to na pewno jest poprawna ilość?";
            }
        } catch (err) {
            $("#sniadanieError").html(err).show(300);
        }
    }

    function walidacjaObiad() {
        var obiadIlosc = $("#obiad").val();
        try {
            $("#obiadError").html("").hide(100);
            if (obiadIlosc == "") {
                blad = true;
                throw "Podaj ilość!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d+$/;
            if (!regex.test(obiadIlosc)) {
                blad = true;
                throw "Czy to na pewno jest poprawna ilość?";
            }
        } catch (err) {
            $("#obiadError").html(err).show(300);
        }
    }

    function walidacjaKolacja() {
        var kolacjaIlosc = $("#kolacja").val();
        try {
            $("#kolacjaError").html("").hide(100);
            if (kolacjaIlosc == "") {
                blad = true;
                throw "Podaj ilość!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d+$/;
            if (!regex.test(kolacjaIlosc)) {
                blad = true;
                throw "Czy to na pewno jest poprawna ilość?";
            }
        } catch (err) {
            $("#kolacjaError").html(err).show(300);
        }
    }

    // Funkcja - Obługa podróży samochodem służbowym
    function podrozSamSluzbowym() {
        if ($("#rodzajLokom").val() === "Samochód służbowy") {
            $("#kosztPrzejazdu").val("0");
            $("#kosztPrzejazdu").attr('disabled', true);

        }
    }


    // Funkcja - pojawienie się pola dialogowe z możliwością wpisania stawki za 1 km
    function pokazDowolnaStawka() {
        if ($("#stawkaZaKm").val() === "dowolnaStawkaZaKm") {
            $("#dowolnaStawkaDIV").show(300);
        } else {
            $("#dowolnaStawkaDIV").hide(300);
        }
    }

    //Walidacja Maksymalnej stawki za km
    function walidacjaStawkaZaKm() {
        var dowolnaStawka = $("#dowolnaStawka").val();
        try {
            $("#kosztDowolnaStawkaZaKmError").html("").hide(100);
            if (dowolnaStawka == "") {
                blad = true;
                throw "Podaj stawkę za km!";
            }
            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^[0]([.]|[,])(([0-7][0-9])|([8][0-3]))$/;

            if (!regex.test(dowolnaStawka)) {
                blad = true;
                throw "Czy to na pewno jest poprawna stawka?";
            }
        } catch (err) {
            $("#kosztDowolnaStawkaZaKmError").html(err).show(300);
        }
    }

    // Funkcja - mozliwość edycji ilości dni w komunikacji miejscowej
    // Funkcja - Deaktywacja
    function deaktywacjaInputKomunikacjaMiejskaIloscDni() {
        $("#komunikacjaMiejskaIloscDni").attr('disabled', true);
        $("#komunikacjaMiejskaIloscDniError").html("").hide(100);
    }

    // Funkcja - Aktywacja
    function aktywacjaInputKomunikacjaMiejskaIloscDni() {
        $("#komunikacjaMiejskaIloscDni").attr('disabled', false);
    }


    // Kontroler

    // Wywołanie funkcji obliczPodroze()
    $("#buttonOblicz").click(function () {
        obliczPodroze();
    });

    // Wywołanie funkcji obliczRachunek()
    $("#buttonObliczPodsumowanie").click(function () {
        var bladRachunek = false; //zmienna kontrolująca stan walidacji wyłączona, żeby można przeprowadić obliczenia

        // Walidacja ilości dni dla komunikacji miejskiej
        $("#komunikacjaMiejskaIloscDniError").html("").hide(100);

        // Inicjacja tabeli 2
        var tab2 = document.getElementById("idTabelaPodroz");
        var ilosdDobPodrozy = tab2.rows[4].cells[1].innerHTML;
        var iloscWpisanychDob = $("#komunikacjaMiejskaIloscDni").val();;

        // Walidacja ilości dni do obliczeń ryczałtu za komunikację miejscową
        try {
            if (iloscWpisanychDob - 1 > ilosdDobPodrozy) {
                //bladRachunek = true;
                throw "Ilość podanych dni przekracza ilość dni podróży!";
            }
        } catch (err) {
            $("#komunikacjaMiejskaIloscDniError").html(err).show(300);
        }

        // Walidacja maksymalnej kwoty za hotel
        var hotelKoszt = $("#kosztHotel").val();
        try {
            $("#kosztHotelError").html("").hide(100);
            if (hotelKoszt >= 600 * ilosdDobPodrozy && ($("#zakwaterowanieButton2").is(':checked'))) {
                //bladRachunek = true;
                throw "Przekroczyłeś limit za nocleg";
            }
        } catch (err) {
            $("#kosztHotelError").html(err).show(300);
        }

        if (bladRachunek !== true) {
            obliczRachunek();
        }



    });

    // Wywołanie funkcji zamienMiejscowosci()
    $("#buttonPodrozPowrotna").click(function () {
        zamienMiejscowosci();
    });

    // Wywołanie funkcji pokazPodrozSamPrywatnym()
    $("#rodzajLokom").change(function () {
        $("#kosztPrzejazdu").attr('disabled', false);
        pokazPodrozSamPrywatnym();
    });

    // Wywołanie funkcji obliczKosztPrzejazduSamochodemPrywatnym()
    $("#iloscKM").keyup(function () {
        $("#kosztPrzejazdu").val(obliczKosztPrzejazduSamochodemPrywatnym().toFixed(2).replace(".", ",")); //wynik przecinek zamiast kropki
    }).change(function () {
        $("#kosztPrzejazdu").val(obliczKosztPrzejazduSamochodemPrywatnym().toFixed(2).replace(".", ","));
    });

    // Kasowanie wartości "Koszt zakwaterowania" po naciśnięciu / przełączeniu radio buttona z "zakwaterowanie hotelu" na "ryczałt"
    $("#zakwaterowanieButton1").change(function () {
        $("#kosztHotel").val("0");
    });

    // Wywołanie deaktywacja Input Koszt Zakwaterowania
    $("#zakwaterowanieButton1").change(function () {
        deaktywacjaInputKosztZakwaterowania();
    });

    // Wywołanie aktywacja Input Koszt Zakwaterowania
    $("#zakwaterowanieButton2").change(function () {
        aktywacjaInputKosztZakwaterowania();
    });

    // Wywołanie walidacji Koszt Zakwaterowania
    $("#kosztHotel").focusout(function () {
        walidacjaKosztZakwaterowania();
    });

    // Wywołanie walidacji Koszt Inne Wydatki
    $("#wydatki").focusout(function () {
        walidacjaKosztInneWydatki();
    });

    // Wywołanie walidacji na posiłkach
    $("#sniadanie").focusout(function () {
        walidacjaSniadanie();
    });
    $("#obiad").focusout(function () {
        walidacjaObiad();
    });
    $("#kolacja").focusout(function () {
        walidacjaKolacja();
    });

    // Wywołanie funkcji podrozSamSluzbowym()
    $("#rodzajLokom").change(function () {
        podrozSamSluzbowym();
    });

    // Wywołanie funkcji pokazDowolnaStawka()
    $("#stawkaZaKm").change(function () {
        pokazDowolnaStawka();
        $("#kosztPrzejazdu").val("0");
        $("#iloscKM").val("0");
    });

    // Wywołanie walidacji Koszt Inne Wydatki
    $("#dowolnaStawka").focusout(function () {
        walidacjaStawkaZaKm();
    });

    // Wywołanie deaktywacja Input ilości dni w komunikacji miejscowej
    $("#komunikacjaMiejskaRadio1").change(function () {
        deaktywacjaInputKomunikacjaMiejskaIloscDni();
        $("#komunikacjaMiejskaIloscDni").val("");
    });
    $("#komunikacjaMiejskaRadio2").change(function () {
        deaktywacjaInputKomunikacjaMiejskaIloscDni();
        $("#komunikacjaMiejskaIloscDni").val("");
    });

    // Wywołanie aktywacja Input ilości dni w komunikacji miejscowej
    $("#komunikacjaMiejskaRadio3").change(function () {
        aktywacjaInputKomunikacjaMiejskaIloscDni();
    });

});
