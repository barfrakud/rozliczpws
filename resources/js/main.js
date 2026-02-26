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


    // Add one trip segment row after client-side validation.
    $("#buttonDodaj").click(function () {

        var miejsceRozpoPodr = $("#miejsceRozpoPodr").val();
        var dataRozpoPodr = $("#dataRozpoPodr").val();
        var czasRozpoPodr = $("#czasRozpoPodr").val();
        var miejsceZakonPodr = $("#miejsceZakonPodr").val();
        var dataZakonPodr = $("#dataZakonPodr").val();
        var czasZakonPodr = $("#czasZakonPodr").val();
        var rodzajLokom = $("#rodzajLokom").val();
        var kosztPrzejazdu = $("#kosztPrzejazdu").val();


        var blad = false; 

        try {

            $("#miejsceRozpoPodrError").html("").hide(100);

            if (miejsceRozpoPodr == "") {
                throw "Podaj miejscowość wyjazdu!";
            }

            if (miejsceRozpoPodr.length > 30) {
                blad = true;
                throw "Za dużo liter!";
            }

            var regExpCheckPhrase = /[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/;
            if (!miejsceRozpoPodr.match(regExpCheckPhrase)) {
                blad = true;
                throw "Czy to na pewno jest poprawna nazwa?";
            }
        } catch (err) {
            $("#miejsceRozpoPodrError").html(err).show(300);
        }

        try {

            $("#miejsceZakonPodrError").html("").hide(100);

            if (miejsceZakonPodr == "") {
                throw "Podaj miejscowość przyjazdu!";
            }

            if (miejsceZakonPodr.length > 30) {
                blad = true;
                throw "Za dużo liter człowieku!";
            }

            var regExpCheckPhrase = /[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/;
            if (!miejsceZakonPodr.match(regExpCheckPhrase)) {
                blad = true;
                throw "Czy to na pewno jest poprawna nazwa?";
            }

        } catch (err) {
            $("#miejsceZakonPodrError").html(err).show(300);
        }

        try {

            $("#rodzajLokomError").html("").hide(100);

            if (rodzajLokom == "") {
                blad = true;
                throw "Podaj środek lokomocji!";
            }
        } catch (err) {
            $("#rodzajLokomError").html(err).show(300);
        }

        try {

            $("#dataRozpoPodrError").html("").hide(100);

            if (dataRozpoPodr == "") {
                blad = true;
                throw "Podaj datę!";
            }
        } catch (err) {
            $("#dataRozpoPodrError").html(err).show(300);
        }

        try {

            $("#czasRozpoPodrError").html("").hide(100);

            if (czasRozpoPodr == "") {
                blad = true;
                throw "Podaj czas!";
            }
        } catch (err) {
            $("#czasRozpoPodrError").html(err).show(300);
        }

        try {

            $("#dataZakonPodrError").html("").hide(100);

            if (dataZakonPodr == "") {
                blad = true;
                throw "Podaj datę!";
            }
        } catch (err) {
            $("#dataZakonPodrError").html(err).show(300);
        }

        try {

            $("#czasZakonPodrError").html("").hide(100);

            if (czasZakonPodr == "") {
                blad = true;
                throw "Podaj czas!";
            }
        } catch (err) {
            $("#czasZakonPodrError").html(err).show(300);
        }

        try {

            $("#kosztPrzejazduError").html("").hide(100);

            if (kosztPrzejazdu == "") {
                blad = true;
                throw "Podaj koszt!";
            }

            var regex = /^\d{0,4}(\,\d{1,2})?$/;
            if (!regex.test(kosztPrzejazdu)) {
                blad = true;
                throw "Czy to na pewno jest poprawna kwota?";
            }
        } catch (err) {
            $("#kosztPrzejazduError").html(err).show(300);
        }

        if (blad !== true) {
            // Keep table-based flow because summary logic reads first/last row later.
            $(".tabPod").show(300);
            $(".tabPod").css('display', 'flex');
            $("#buttonUsunIdRow").show(300);
            $("#buttonUsunIdRow").css('display', 'flex');
            var row = $("<tr>");
            row.append($("<td>").text(miejsceRozpoPodr));
            row.append($("<td>").text(dataRozpoPodr));
            row.append($("<td>").text(czasRozpoPodr));
            row.append($("<td>").text(miejsceZakonPodr));
            row.append($("<td>").text(dataZakonPodr));
            row.append($("<td>").text(czasZakonPodr));
            row.append($("<td>").text(rodzajLokom));
            row.append($("<td>").text(kosztPrzejazdu));
            row.append($("<td>").append($("<input>", { type: "checkbox", name: "record" })));
            $("#tabelaPodroz tbody").append(row);
        }


    });

    // Removing rows also clears computed summary fields to avoid stale results.
    $("#buttonUsun").click(function () {
        $("table tbody").find('input[name="record"]').each(function () {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
            }
        });

        kosztPodrozy = 0;
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


