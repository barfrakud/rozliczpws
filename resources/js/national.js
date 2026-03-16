$(function () {

    const nationalRoutes = document.getElementById('national-routes');
    const summaryUrl = nationalRoutes ? nationalRoutes.dataset.summaryUrl : '';
    const settlementUrl = nationalRoutes ? nationalRoutes.dataset.settlementUrl : '';

    console.log('Start podróż krajowa national');

    function obliczPodroze() {

        var tab = document.getElementById("tabelaPodroz");

        var iloscRzedow = tab.rows.length;

        // Start is read from the first segment, end from the last segment.
        var mRozpoPodr = tab.rows[1].cells[0].innerHTML;
        var mZakonPodr = tab.rows[iloscRzedow - 1].cells[3].innerHTML;

        var czRozpoPodr = tab.rows[1].cells[1].innerHTML + " " + tab.rows[1].cells[2].innerHTML;
        var czZakonPodr = tab.rows[iloscRzedow - 1].cells[4].innerHTML + " " + tab.rows[iloscRzedow - 1].cells[5].innerHTML;

        // Sum transport cost from all rows in the trip table.
        var kosztPodr = 0;
        var i;
        for (i = 1; i < iloscRzedow; i++) {
            kosztPodr += Number(parseFloat((tab.rows[i].cells[7].innerHTML).replace(",", ".")).toFixed(2));
        }

        $.ajax({
            url: summaryUrl,
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

                var rozpoczeciePodrozyFormat = dane[0] + ", " + dane[2].slice(8, 10) + "." + dane[2].slice(5, 7) + "." + dane[2].slice(0, 4) + ", " + dane[2].slice(11, 16); 
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

    function obliczRachunek() {

        var tab = document.getElementById("tabelaPodroz");

        var iloscRzedow = tab.rows.length;

        var czRozpoPodr = tab.rows[1].cells[1].innerHTML + " " + tab.rows[1].cells[2].innerHTML;
        var czZakonPodr = tab.rows[iloscRzedow - 1].cells[4].innerHTML + " " + tab.rows[iloscRzedow - 1].cells[5].innerHTML;

        // Recalculate cost on every submit to stay in sync with edited rows.
        var kosztPodr = 0;
        var i;
        for (i = 1; i < iloscRzedow; i++) {
            kosztPodr += Number(parseFloat((tab.rows[i].cells[7].innerHTML).replace(",", ".")).toFixed(2));
        }



        var komunikacjaMiejskaRadio1 = $("#komunikacjaMiejskaRadio1").is(':checked');
        var komunikacjaMiejskaRadio2 = $("#komunikacjaMiejskaRadio2").is(':checked');
        var komunikacjaMiejskaRadio3 = $("#komunikacjaMiejskaRadio3").is(':checked');
        var komunikacjaMiejskaIloscDni = $("#komunikacjaMiejskaIloscDni").val();

        var zakwRyczalt = $("#zakwaterowanieButton1").is(':checked');
        var zakwHotel = $("#zakwaterowanieButton2").is(':checked');

        var hotelKoszt = $("#kosztHotel").val().replace(",", "."); 
        var sniadanieIlosc = $("#sniadanie").val();
        var obiadIlosc = $("#obiad").val();
        var kolacjaIlosc = $("#kolacja").val();
        var wydatkiKwota = $("#wydatki").val().replace(",", ".");


        $.ajax({
            url: settlementUrl,
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

                var ryczaltDojazdy = dane['ryczaltDojazdy'];
                var razemDojazdyPrzejazdy = dane['razemDojazdyPrzejazdy'];
                var dietaMinusOdliczenia = dane['dietaMinusOdliczenia'];
                var kosztNoclegu = dane['kosztNoclegu'];
                var noclegRyczaltWynik = dane['noclegRyczaltWynik'];
                var inneKoszt = dane['inneKoszt'];
                var obliczOgolemWynik = dane['obliczOgolemWynik'];


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

    function zamienMiejscowosci() {
        // Convenience helper for return trip: swap start/end and reset dependent inputs.
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

    function obliczKosztPrzejazduSamochodemPrywatnym() {
        var stawka;
        if ($("#stawkaZaKm").val() === "dowolnaStawkaZaKm") {
            stawka = $("#dowolnaStawka").val().replace(",", ".");
        } else {
            stawka = $("#stawkaZaKm").val();
        }

        var przejachaneKM = $("#iloscKM").val();

        // Private car cost is a simple km * rate formula.
        var koszPrzejazdu = przejachaneKM * stawka;
        return koszPrzejazdu;
    }

    function deaktywacjaInputKosztZakwaterowania() {
        $("#kosztHotel").attr('disabled', true);
        $("#kosztHotelError").html("").hide(100);
    }

    function aktywacjaInputKosztZakwaterowania() {
        $("#kosztHotel").attr('disabled', false);
    }

    function walidacjaKosztZakwaterowania() {
        var hotelKoszt = $("#kosztHotel").val();
        try {
            $("#kosztHotelError").html("").hide(100);
            if (hotelKoszt == "") {
                blad = true;
                throw "Podaj koszt!";
            }
            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(hotelKoszt)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#kosztHotelError").html(err).show(300);
        }
    }

    function walidacjaKosztInneWydatki() {
        var wydatkiKwota = $("#wydatki").val();
        try {
            $("#wydatkiError").html("").hide(100);
            if (wydatkiKwota == "") {
                blad = true;
                throw "Podaj koszt!";
            }
            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(wydatkiKwota)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#wydatkiError").html(err).show(300);
        }
    }

    function walidacjaSniadanie() {
        var sniadanieIlosc = $("#sniadanie").val();
        try {
            $("#sniadanieError").html("").hide(100);
            if (sniadanieIlosc == "") {
                blad = true;
                throw "Podaj ilość!";
            }
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
            var regex = /^\d+$/;
            if (!regex.test(kolacjaIlosc)) {
                blad = true;
                throw "Czy to na pewno jest poprawna ilość?";
            }
        } catch (err) {
            $("#kolacjaError").html(err).show(300);
        }
    }

    function podrozSamSluzbowym() {
        if ($("#rodzajLokom").val() === "Samochód służbowy") {
            $("#kosztPrzejazdu").val("0");
            $("#kosztPrzejazdu").attr('disabled', true);

        }
    }


    function pokazDowolnaStawka() {
        if ($("#stawkaZaKm").val() === "dowolnaStawkaZaKm") {
            $("#dowolnaStawkaDIV").show(300);
        } else {
            $("#dowolnaStawkaDIV").hide(300);
        }
    }

    function walidacjaStawkaZaKm() {
        var dowolnaStawka = $("#dowolnaStawka").val();
        try {
            $("#kosztDowolnaStawkaZaKmError").html("").hide(100);
            if (dowolnaStawka == "") {
                blad = true;
                throw "Podaj stawkę za km!";
            }
            var regex = /^[0]([.]|[,])(([0-7][0-9])|([8][0-3]))$/;

            if (!regex.test(dowolnaStawka)) {
                blad = true;
                throw "Czy to na pewno jest poprawna stawka?";
            }
        } catch (err) {
            $("#kosztDowolnaStawkaZaKmError").html(err).show(300);
        }
    }

    function deaktywacjaInputKomunikacjaMiejskaIloscDni() {
        $("#komunikacjaMiejskaIloscDni").attr('disabled', true);
        $("#komunikacjaMiejskaIloscDniError").html("").hide(100);
    }

    function aktywacjaInputKomunikacjaMiejskaIloscDni() {
        $("#komunikacjaMiejskaIloscDni").attr('disabled', false);
    }



    $("#buttonOblicz").click(function () {
        obliczPodroze();
    });

    $("#buttonObliczPodsumowanie").click(function () {
        var bladRachunek = false; 

        $("#komunikacjaMiejskaIloscDniError").html("").hide(100);

        var tab2 = document.getElementById("idTabelaPodroz");
        var ilosdDobPodrozy = tab2.rows[4].cells[1].innerHTML;
        var iloscWpisanychDob = $("#komunikacjaMiejskaIloscDni").val();;

        try {
            // User cannot declare more city-transport days than the trip duration.
            if (iloscWpisanychDob - 1 > ilosdDobPodrozy) {
                throw "Ilość podanych dni przekracza ilość dni podróży!";
            }
        } catch (err) {
            $("#komunikacjaMiejskaIloscDniError").html(err).show(300);
        }

        var hotelKoszt = $("#kosztHotel").val();
        try {
            // Basic accommodation cap check used in this settlement variant.
            $("#kosztHotelError").html("").hide(100);
            if ((ilosdDobPodrozy == 0) && (hotelKoszt > 900) && ($("#zakwaterowanieButton2").is(':checked')) ||
                (ilosdDobPodrozy > 0) && (hotelKoszt > 900 * ilosdDobPodrozy) && ($("#zakwaterowanieButton2").is(':checked'))) {
                throw "Przekroczyłeś limit za nocleg!";
            }
        } catch (err) {
            $("#kosztHotelError").html(err).show(300);
        }

        if (bladRachunek !== true) {
            obliczRachunek();
        }



    });

    $("#buttonPodrozPowrotna").click(function () {
        zamienMiejscowosci();
    });

    $("#rodzajLokom").change(function () {
        $("#kosztPrzejazdu").attr('disabled', false);
        pokazPodrozSamPrywatnym();
    });

    $("#iloscKM").keyup(function () {
        $("#kosztPrzejazdu").val(obliczKosztPrzejazduSamochodemPrywatnym().toFixed(2).replace(".", ",")); 
    }).change(function () {
        $("#kosztPrzejazdu").val(obliczKosztPrzejazduSamochodemPrywatnym().toFixed(2).replace(".", ","));
    });

    $("#zakwaterowanieButton1").change(function () {
        $("#kosztHotel").val("0");
    });

    $("#zakwaterowanieButton1").change(function () {
        deaktywacjaInputKosztZakwaterowania();
    });

    $("#zakwaterowanieButton2").change(function () {
        aktywacjaInputKosztZakwaterowania();
    });

    $("#kosztHotel").focusout(function () {
        walidacjaKosztZakwaterowania();
    });

    $("#wydatki").focusout(function () {
        walidacjaKosztInneWydatki();
    });

    $("#sniadanie").focusout(function () {
        walidacjaSniadanie();
    });
    $("#obiad").focusout(function () {
        walidacjaObiad();
    });
    $("#kolacja").focusout(function () {
        walidacjaKolacja();
    });

    $("#rodzajLokom").change(function () {
        podrozSamSluzbowym();
    });

    $("#stawkaZaKm").change(function () {
        pokazDowolnaStawka();
        $("#kosztPrzejazdu").val("0");
        $("#iloscKM").val("0");
    });

    $("#dowolnaStawka").focusout(function () {
        walidacjaStawkaZaKm();
    });

    $("#komunikacjaMiejskaRadio1").change(function () {
        deaktywacjaInputKomunikacjaMiejskaIloscDni();
        $("#komunikacjaMiejskaIloscDni").val("");
    });
    $("#komunikacjaMiejskaRadio2").change(function () {
        deaktywacjaInputKomunikacjaMiejskaIloscDni();
        $("#komunikacjaMiejskaIloscDni").val("");
    });

    $("#komunikacjaMiejskaRadio3").change(function () {
        aktywacjaInputKomunikacjaMiejskaIloscDni();
    });

});


