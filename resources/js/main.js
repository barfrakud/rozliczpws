$(function () {

    console.log('Start podróż krajowa main');


    var czasPodrozyWynik = [];
    var kosztPodrozy = 0;
    var ryczaltZaDojazdy = 0;
    var wyliczonaDieta = 0;
    var razemPrzejazdyDojazdy = 0;
    var inneWydatki = 0;
    var kosztZakwaterowania = 0;
    var kosztZakwatarewaniaRyczalt = 0;
    var kosztZakwaterowaniaHotel = 0;
    var ogolem = 0;

    //Funkcja ustawiające numer wersji oprogramowania na każdej stronie i podstronie.
    document.getElementById("idFooterText").innerHTML = "rozliczPWS.pl v2.0.0 &#169 barfrakud";

    //Funkcja dodawanie danych do tabeli
    $("#buttonDodaj").click(function () {

        var miejsceRozpoPodr = $("#miejsceRozpoPodr").val();
        var dataRozpoPodr = $("#dataRozpoPodr").val();
        var czasRozpoPodr = $("#czasRozpoPodr").val();
        var miejsceZakonPodr = $("#miejsceZakonPodr").val();
        var dataZakonPodr = $("#dataZakonPodr").val();
        var czasZakonPodr = $("#czasZakonPodr").val();
        var rodzajLokom = $("#rodzajLokom").val();
        var kosztPrzejazdu = $("#kosztPrzejazdu").val();


        //Walidacja wprowadzonych danych
        var blad = false; //zmienna kontrolująca stan walidacji

        //Walidacja - Miejsce rozpoczęcia
        try {

            $("#miejsceRozpoPodrError").html("").hide(100);

            if (miejsceRozpoPodr == "") {
                // Wyłączenie walidacji miejsca - brak podania miejscowości nie będzie blokował dodania danych do tabelki
                //blad = true;
                throw "Podaj miejscowość wyjazdu!";
            }

            if (miejsceRozpoPodr.length > 30) {
                blad = true;
                throw "Za dużo liter!";
            }

            //Sprawdzenie poprzez wyrażenie reguralne
            var regExpCheckPhrase = /[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/;
            if (!miejsceRozpoPodr.match(regExpCheckPhrase)) {
                blad = true;
                throw "Czy to na pewno jest poprawna nazwa?";
            }
        } catch (err) {
            //Wyświetlenie komunikatów błędów
            $("#miejsceRozpoPodrError").html(err).show(300);
        }

        //Walidacja - Miejsce zakończenia
        try {

            $("#miejsceZakonPodrError").html("").hide(100);

            if (miejsceZakonPodr == "") {
                // Wyłączenie walidacji miejsca - brak podania miejscowości nie będzie blokował dodania danych do tabelki
                //blad = true;
                throw "Podaj miejscowość przyjazdu!";
            }

            if (miejsceZakonPodr.length > 30) {
                blad = true;
                throw "Za dużo liter człowieku!";
            }

            //Sprawdzenie poprzez wyrażenie reguralne
            var regExpCheckPhrase = /[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/;
            if (!miejsceZakonPodr.match(regExpCheckPhrase)) {
                blad = true;
                throw "Czy to na pewno jest poprawna nazwa?";
            }

        } catch (err) {
            $("#miejsceZakonPodrError").html(err).show(300);
        }

        //Walidacja - Rodzaj lokomocji
        try {

            $("#rodzajLokomError").html("").hide(100);

            if (rodzajLokom == "") {
                blad = true;
                throw "Podaj środek lokomocji!";
            }
        } catch (err) {
            $("#rodzajLokomError").html(err).show(300);
        }

        //Walidacja - Data rozpoczęcia
        try {

            $("#dataRozpoPodrError").html("").hide(100);

            if (dataRozpoPodr == "") {
                blad = true;
                throw "Podaj datę!";
            }
        } catch (err) {
            $("#dataRozpoPodrError").html(err).show(300);
        }

        //Walidacja - Czas rozpoczęcia
        try {

            $("#czasRozpoPodrError").html("").hide(100);

            if (czasRozpoPodr == "") {
                blad = true;
                throw "Podaj czas!";
            }
        } catch (err) {
            $("#czasRozpoPodrError").html(err).show(300);
        }

        //Walidacja - Data zakończenia
        try {

            $("#dataZakonPodrError").html("").hide(100);

            if (dataZakonPodr == "") {
                blad = true;
                throw "Podaj datę!";
            }
        } catch (err) {
            $("#dataZakonPodrError").html(err).show(300);
        }

        //Walidacja - Czas zakończenia
        try {

            $("#czasZakonPodrError").html("").hide(100);

            if (czasZakonPodr == "") {
                blad = true;
                throw "Podaj czas!";
            }
        } catch (err) {
            $("#czasZakonPodrError").html(err).show(300);
        }

        //Walidacja - Koszt podróży
        try {

            $("#kosztPrzejazduError").html("").hide(100);

            if (kosztPrzejazdu == "") {
                blad = true;
                throw "Podaj koszt!";
            }

            //Sprawdzenie poprzez wyrażenie reguralne - to jest lepszy algorytm przy czym input musi być typu "text"
            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(kosztPrzejazdu)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#kosztPrzejazduError").html(err).show(300);
        }




        if (blad !== true) {
            //Pojawienie się tabeli
            $(".tabPod").show(300);
            $(".tabPod").css('display', 'flex');
            $("#buttonUsunIdRow").show(300);
            $("#buttonUsunIdRow").css('display', 'flex');
            var markup = "<tr><td>" + miejsceRozpoPodr + "</td><td>" + dataRozpoPodr + "</td><td>" + czasRozpoPodr + "</td><td>" + miejsceZakonPodr + "</td><td>" + dataZakonPodr + "</td><td>" + czasZakonPodr + "</td><td>" + rodzajLokom + "</td><td>" + kosztPrzejazdu + "</td><td>" + "<input type='checkbox' name='record'</ td></ tr>";
            $("#tabelaPodroz tbody").append(markup);
        }


    });

    //Funckja usuwająca zaznaczony rząd
    $("#buttonUsun").click(function () {
        $("table tbody").find('input[name="record"]').each(function () {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
            }
        });

        //Usuwanie wyników tabeli po usunięcia wiersza z tabeli
        kosztPodrozy = 0;
        //$("#iloscRzedow").html("");
        $("#rozpoczeciePodrozy").html("");
        $("#zakonczeniePodrozy").html("");
        $("#czasTrwaniaPodrozy").html("");
        $("#kosztPodrozy").html("");
        $("#idRyczalZaDojazdyWynik").html("");
        $("#idDiety").html("");
        $("#idRazemPrzejazdyDojazdy").html("");
        $("#idInneWydatki").html("");
        $("#idNoclegiRyczalty").html("");
        $("#idNoclegiRachunki").html("");
        $("#idOgolem").html("");


    });







});
