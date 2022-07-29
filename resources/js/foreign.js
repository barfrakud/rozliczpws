$(function () {

    console.log("Zaczynamy");

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PODRÓŻ ZAGRANICZNA
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Nowy układ aplikacji - szablon:
    // 1. Zmienne
    // 2. Funkcje
    // 3. Kontroler (obsługa zdarzeń i zwrot wyniku)

    ///////////////////////////////////////////////////

    //////////////////
    // 1/3. ZMIENNE
    //////////////////

    let currency;
    let perDiemRate = 0;
    let perNightRate;
    let tripTotalTime;
    let tripAllowance = 0; //dieta
    let oldTripAllowance = 0;
    let deduction = 0; //odliczenia za posiłki
    let deductionBreakfast = 0;
    let deductionLunch = 0;
    let deductionDinner = 0;
    let tripAllowanceMinusDeduction = 0; //dieta minus odliczenia
    let tripType = "1"; // typ podróży zagranicznej

    //////////////////
    // 2/3. FUNCKCJE
    //////////////////

    //Funkcja ustawiające numer wersji oprogramowania na każdej stronie i podstronie.
    document.getElementById("idFooterText").innerHTML = "rozliczPWS.pl v2.0.0 &#169 barfrakud";

    // Wybór miejsca podróży z przypisaniem poszczególnych wartości
    function selectDestination() {

        // Currency = Waluta
        currency = $(this).find(":selected").data("value").waluta;
        $("#labelWaluta").val(currency);

        console.log("Zmiana wyboru");
        console.log(`tripType: ${tripType}`);
        console.log(`dieta: ${$(this).find(":selected").data("value").dieta}`);



        // Trip Allowance = Dieta
        // perDiemRate = $(this).find(":selected").data("value").dieta;
        oldTripAllowance = $(this).find(":selected").data("value").dieta;
        console.log(oldTripAllowance);

        if (tripType == 1) {
            let newTripAllowance = oldTripAllowance + ',00';
            $("#labelKwotaDieta").val(newTripAllowance);
        } else if (tripType == 2) {
            console.log(tripType);
            let newTripAllowance = oldTripAllowance / 2;
            $("#labelKwotaDieta").val(newTripAllowance.toFixed(2).replace(".", ","));
        } else {
            let newTripAllowance = oldTripAllowance / 4;
            $("#labelKwotaDieta").val(newTripAllowance.toFixed(2).replace(".", ","));
        }



        // Night Rate = Kwota za nocleg
        perNightRate = $(this).find(":selected").data("value").limit;
        $("#labelLimitNocleg").val(perNightRate + ',00');

        // console.log("Zmiana wyboru");
        // console.log(`Waluta: ${currency}`);

        // Ustawienie domyślnego typu podróży
        // $("#typPodrozy1").prop("checked", true);
    }

    // Typ podróży
    function typeOfTrip() {

        // console.log("Radio button switched");
        tripType = this.value;
        // console.log(tripType);

        if (tripType == 1) {
            // console.log("Ustawiam nową dietę");
            // let oldTripAllowance =  $("#labelKwotaDieta").val();
            let newTripAllowance = oldTripAllowance + ",00";
            $("#labelKwotaDieta").val(newTripAllowance);
            // console.log("Ustawiam nową dietę w fukcji");
        }

        if (tripType == 2) {
            // console.log("Ustawiam nową dietę");
            // let oldTripAllowance =  $("#labelKwotaDieta").val();
            let newTripAllowance = oldTripAllowance / 2;
            $("#labelKwotaDieta").val(newTripAllowance.toFixed(2).replace(".", ","));

            // console.log("Ustawiam nową dietę w fukcji");
        }

        if (tripType == 3) {
            // console.log("Ustawiam nową dietę");
            // let oldTripAllowance =  $("#labelKwotaDieta").val();
            let newTripAllowance = oldTripAllowance / 4;
            $("#labelKwotaDieta").val(newTripAllowance.toFixed(2).replace(".", ","));
            // console.log("Ustawiam nową dietę w fukcji");
        }
        console.log(tripType);

        return tripType;
    }


    // Obliczenie czasu podróży zagranicznej i wyświetlenie wyniku
    // Funkcje jest negatywnym przykładaem podwójnej odpowiedzialności obliczenia czasu podróży i wyświetlenia wyniku
    function getTripTime() {

        var dataRozpoPodrZ = $("#dataRozpoPodrZ").val();
        var czasRozpoPodrZ = $("#czasRozpoPodrZ").val();
        var dataZakoPodrZ = $("#dataZakoPodrZ").val();
        var czasZakoPodrZ = $("#czasZakoPodrZ").val();

        //Czas podróży
        var start = dataRozpoPodrZ + czasRozpoPodrZ;
        var stop = dataZakoPodrZ + czasZakoPodrZ;

        var dataStart = moment(start, "YYYY-MM-DDHH:mm");
        var dataStop = moment(stop, "YYYY-MM-DDHH:mm");

        var czasPodrozy = moment.duration(dataStop.diff(dataStart));

        var czasPodrozyDni = dataStop.diff(dataStart, 'days');

        var czasPodrozyGodziny = czasPodrozy.get('h');
        var czasPodrozyMinuty = czasPodrozy.get('m');

        $("#czasTrwaniaPodrozyZ").html("<b>" + "<em>" + czasPodrozyDni + " : " + czasPodrozyGodziny + " : " + czasPodrozyMinuty + "</em>" + "</b>");
        $("#rozpoczeciePodrozyZ").html("<b>" + "<em>" + dataRozpoPodrZ + ", " + czasRozpoPodrZ + "</em>" + "</b>");
        $("#zakonczeniePodrozyZ").html("<b>" + "<em>" + dataZakoPodrZ + ", " + czasZakoPodrZ + "</em>" + "</b>");

        tripTotalTime = [czasPodrozyDni, czasPodrozyGodziny, czasPodrozyMinuty];

        return tripTotalTime;
    }

    // Obliczenie diety zagranicznej
    function getTripAllowance() {

        var czasPodrozyDni = tripTotalTime[0];
        var czasPodrozyGodziny = tripTotalTime[1];
        var czasPodrozyMinuty = tripTotalTime[2];

        var iloscSniadanZ = parseInt($("#sniadanieZ").val());
        var iloscObiadowZ = parseInt($("#obiadZ").val());
        var iloscKolacjiZ = parseInt($("#kolacjaZ").val());

        var dietaZagrStawka = parseFloat($("#labelKwotaDieta").val().replace(",", ".")); //stawka diety zagranicznej

        // Dla ułatwienia
        var D = czasPodrozyDni;
        var G = czasPodrozyGodziny;
        var M = czasPodrozyMinuty;
        var A = 0;
        var B = 0;



        if (D > 0) {
            A = D * dietaZagrStawka;
        } else {
            A = 0;
        }

        if (G === 0 && M === 0) {
            B = 0;
        } else if ((G === 8 && M === 0) || (G < 8)) {
            B = dietaZagrStawka / 3;
        } else {
            if ((G === 12 && M === 0) || (G < 12)) {
                B = dietaZagrStawka * 0.5;
            } else {
                B = dietaZagrStawka;
            }
        }

        var dietaZagrNowa = $("#labelKwotaDieta").val().replace(",", ".");

        // Odliczenia
        deductionBreakfast = iloscSniadanZ * 0.15 * dietaZagrNowa;
        deductionLunch = iloscObiadowZ * 0.3 * dietaZagrNowa;
        deductionDinner = iloscKolacjiZ * 0.3 * dietaZagrNowa;

        deduction = deductionBreakfast + deductionLunch + deductionDinner;

        deduction = (Math.round(deduction * 100) / 100).toFixed(2);
        tripAllowance = (Math.round((A + B) * 100) / 100).toFixed(2);
        tripAllowanceMinusDeduction = (Math.round((A + B - deduction) * 100) / 100).toFixed(2);

        console.log(`Diety: ${tripAllowance}, Odliczenia: ${deduction}, Diety-Odliczenia: ${tripAllowanceMinusDeduction}`);
        console.log(`Odliczenia => Śniadanie: ${deductionBreakfast.toFixed(2)}, Obiad: ${deductionLunch.toFixed(2)}, Kolacja: ${deductionDinner.toFixed(2)}`);

        return tripAllowance;
    }

    // Obliczenie kosztów zakwaterowania w hotelu
    function obliczKosztZakwaterowaniaHotelZ() {

        var button2 = document.getElementById("zakwaterowanieButton2Z").checked;

        if (button2 === true) {
            kosztZakwaterowaniaHotelZ = $("#kosztHotelZ").val().replace(",", ".");
            return (Math.round(kosztZakwaterowaniaHotelZ * 100) / 100).toFixed(2);
        } else {
            kosztZakwaterowaniaHotelZ = 0;
            return kosztZakwaterowaniaHotelZ.toFixed(2);
        }
    }

    // Obliczenie należności za zakwaterowanie wypłacanych ryczałtem
    function obliczKosztZakwaterowaniaRyczaltZ() {

        //var limitZagrStawka = parseFloat(limitZ); //limit noclegowy zagraniczny
        //Wartość stawki pobiera się z okna, z którego się wyświetla
        var limitZagrStawka = $("#labelLimitNocleg").val().replace(",", ".");

        var czasPodrozyDni = tripTotalTime[0];
        var czasPodrozyGodziny = tripTotalTime[1];
        var czasPodrozyMinuty = tripTotalTime[2];

        var button1 = document.getElementById("zakwaterowanieButton1Z").checked;

        if (button1 === true) {
            if (czasPodrozyDni === 0 && czasPodrozyMinuty === 0) {
                kosztZakwatarewaniaRyczaltZ = 0;
            } else if (czasPodrozyDni === 0 && czasPodrozyMinuty > 0) {
                kosztZakwatarewaniaRyczaltZ = 0.25 * limitZagrStawka;
            } else if (czasPodrozyDni > 0 && czasPodrozyMinuty >= 0) {
                kosztZakwatarewaniaRyczaltZ = czasPodrozyDni * 0.25 * limitZagrStawka;
            } else {
                kosztZakwatarewaniaRyczaltZ = 0;
            }
            return (Math.round(kosztZakwatarewaniaRyczaltZ * 100) / 100).toFixed(2);

        } else {
            kosztZakwatarewaniaRyczaltZ = 0;
            return kosztZakwatarewaniaRyczaltZ.toFixed(2);
        }
    }

    // Obliczenie należności za dojazdy komunikacją miejską wypłacanych ryczałtem
    function obliczRyczaltZaDojazdyZ() {
        //var ryczaltStawka = 0.1 * parseFloat(dietaZ);
        //var limitZagrStawka = $("#labelKwotaDieta").val();
        var ryczaltStawka = 0.1 * $("#labelKwotaDieta").val().replace(",", ".");;

        var komunikacjaMiejska = $("#komunikacjaMiejskaZ").is(':checked');
        var czasPodrozyDni = tripTotalTime[0];
        var czasPodrozyGodziny = tripTotalTime[1];
        var czasPodrozyMinuty = tripTotalTime[2];

        if (komunikacjaMiejska === true) {
            if (czasPodrozyDni === 0 && czasPodrozyMinuty === 0 && czasPodrozyGodziny === 0) {
                ryczaltZaDojazdyZ = 0;
            } else if (czasPodrozyDni === 0 && (czasPodrozyMinuty > 0 || czasPodrozyGodziny > 0)) {
                ryczaltZaDojazdyZ = ryczaltStawka;
            } else if (czasPodrozyDni > 0 && czasPodrozyMinuty === 0 && czasPodrozyGodziny === 0) {
                ryczaltZaDojazdyZ = ryczaltStawka * czasPodrozyDni;
            } else if (czasPodrozyDni > 0 && (czasPodrozyMinuty > 0 || czasPodrozyGodziny > 0)) {
                ryczaltZaDojazdyZ = ryczaltStawka * czasPodrozyDni + ryczaltStawka;
            } else {
                ryczaltZaDojazdyZ = 0;
            }

        } else {
            ryczaltZaDojazdyZ = 0;
        }

        var wynik = (Math.round((ryczaltZaDojazdyZ) * 100) / 100).toFixed(2);
        localStorage.setItem('komunikacjaMiejskaRyczalt', wynik);
        return wynik;
    }

    // Obliczenie należności za dojazd z/do lotniska w miejscowości docelowej
    function obliczDoZLotniska() {
        var wynik = $("#labelKwotaDieta").val().replace(",", ".");;
        var dojazdLotnisko = $("#dojazdLotnisko").is(':checked');

        if (dojazdLotnisko === true) {
            dojazdNaZLotniska = (Math.round(wynik * 100) / 100).toFixed(2);
            localStorage.setItem('dojazdNaZLotniska', dojazdNaZLotniska);
            return dojazdNaZLotniska;
        } else {
            wynik = 0;
            return wynik.toFixed(2);
        }
    }

    // Obliczenie należności za poniesione Inne Wydatki
    function obliczInneWydatkiZ() {
        inneWydatki = $("#wydatkiZ").val();
        return parseFloat(inneWydatki).toFixed(2);
    }

    // Wyświetlenie kosztów
    function showCosts() {
        $("#labelDietaZ").html("<b>" + "<em>" + dietaZagranicznaWynik.replace(".", ",") + " " + currency + "</em>" + "</b>");
        $("#labelZOdliczenia").html("<b>" + "<em>" + deduction.replace(".", ",") + " " + currency + "</em>" + "</b>");
        $("#labelDietaZOdliczenia").html("<b>" + "<em>" + tripAllowanceMinusDeduction.replace(".", ",") + " " + currency + "</em>" + "</b>");
        $("#labelKosztZakwatarewaniaRyczaltZ").html("<b>" + "<em>" + obliczKosztZakwaterowaniaRyczaltZ().replace(".", ",") + " " + currency + "</em>" + "</b>");
        sumaInne = parseFloat(obliczRyczaltZaDojazdyZ()) + parseFloat(obliczDoZLotniska()) + parseFloat(obliczInneWydatkiZ());
        $("#labelInneWydatkiPodsumZ").html("<b>" + "<em>" + sumaInne.toFixed(2).replace(".", ",") + " " + currency + "</em>" + "</b>");
    }

    // Rozliczanie pobranej zaliczki
    function rozliczZaliczke() {
        var zaliczka = $("#zaliczka").val().replace(",", ".");
        wydatki = parseFloat(kosztZakwaterowaniaHotelZ) + parseFloat(kosztZakwatarewaniaRyczaltZ) + parseFloat(obliczRyczaltZaDojazdyZ()) + parseFloat(obliczDoZLotniska()) + parseFloat(obliczInneWydatkiZ()) + parseFloat(tripAllowanceMinusDeduction);
        roznica = zaliczka - wydatki;


    }



    //////////////////////////
    // 3/3. KONTROLER
    //////////////////////////

    // Pojawienie się pomocy
    $("#podrZagrInst").click(function () {
        //Pojawienie się instrukcji
        $("#podrZagrInstrukcja").toggle(300);
        $("#podrKrajInstrukcja").hide(300);
    });

    // Wybór miejsca podróży
    $("#krajPodrozy").on('change', selectDestination);

    // Wybór typu podróży
    // $(".trip-type").change(typeOfTrip);
    $(".trip-type").on("change", typeOfTrip);


    // Obliczenie czasu podróży
    $('#buttonObliczZ').click(getTripTime);

    // Kasowanie wartości "Koszt zakwaterowania" po naciśnięciu / przełączeniu radio buttona z "zakwaterowanie hotelu" na "ryczałt"
    $("#zakwaterowanieButton1Z").change(function () {
        $("#kosztHotelZ").val("0");
        $("#kosztHotelZ").attr("disabled", true);
    });

    // Przełączenie buttona i odblokowanie input Koszt zakwaterowania
    $("#zakwaterowanieButton2Z").change(function () {
        $("#kosztHotelZ").attr("disabled", false);
    });

    // Obliczenie kosztów podróży i wyświetlenie wyniku
    $('#buttonObliczKosztyIdZ').click(function () {
        obliczKosztZakwaterowaniaHotelZ();
        dietaZagranicznaWynik = 0;
        dietaZagranicznaWynik = getTripAllowance();
        showCosts();
    });

    // Obliczenie rachunku i wyświetlenie wyniku
    $('#buttonObliczRachunekIdZ').click(function () {
        rozliczZaliczke();
        $("#wydatkowano").html("<b>" + "<em>" + wydatki.toFixed(2).replace(".", ",") + " " + currency + "</em>" + "</b>");

        if (roznica < 0) {
            $("#diffDisplay").text("Wypłacić żołnierzowi:");
            roznica = -1 * roznica;
            $("#roznica").html("<b>" + "<em>" + roznica.toFixed(2).replace(".", ",") + " " + currency + "</em>" + "</b>");
        } else {
            $("#diffDisplay").text("Zwrócić do kasy:");
            $("#roznica").html("<b>" + "<em>" + roznica.toFixed(2).replace(".", ",") + " " + currency + "</em>" + "</b>");
        }

    });


});
