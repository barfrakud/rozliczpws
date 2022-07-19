<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\NationalTripClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function krajowa()
    {
        return view('national');
    }

    public function krajowaObliczPodroze(Request $request)
    {
        $nationalTrip = new NationalTripClass;

        //Odebranie danych i przypisanie do zmiennych
        $mRozpoPodr = $request->input('mRozpoPodr');
        $mZakonPodr = $request->input('mZakonPodr');
        $czRozpoPodr = $request->input('czRozpoPodr');
        $czZakonPodr = $request->input('czZakonPodr');
        $kosztPodr = $request->input('kosztPodr');


        //Przygotowanie danych do odesłania w postaci tabeli
        $wynik = array();
        $wynik[0] = $mRozpoPodr;
        $wynik[1] = $mZakonPodr;
        $wynik[2] = $czRozpoPodr;
        $wynik[3] = $czZakonPodr;
        $wynik[4] = number_format($kosztPodr, 2, ",", ".");
        $wynik[5] = $nationalTrip->obliczCzasPodrozyKrajowej($czRozpoPodr, $czZakonPodr);
        $wynik[6] = $nationalTrip->obliczDobyPodrozyKrajowej($czRozpoPodr, $czZakonPodr);

        return response()->json($wynik);
    }

    public function krajowaObliczRachunek(Request $request)
    {
        // Zmienne
        // $dietaKrajowaStawka = 30;
        // $komunikajcaMiejskaRyczaltStawka = 6;
        // $noclegRyczaltStawka = 45;

        $nationalTrip = new NationalTripClass;

        //Odebranie danych i przypisanie do zmiennych
        $czRozpoPodr = $request->input('czRozpoPodr');
        $czZakonPodr = $request->input('czZakonPodr');
        $kosztPodr = $request->input('kosztPodr');
        $komunikacjaMiejskaRadio1 = $request->input('komunikacjaMiejskaRadio1');
        $komunikacjaMiejskaRadio2 = $request->input('komunikacjaMiejskaRadio2');
        $komunikacjaMiejskaRadio3 = $request->input('komunikacjaMiejskaRadio3');
        $komunikacjaMiejskaIloscDni = $request->input('komunikacjaMiejskaIloscDni');
        $zakwRyczalt = $request->input('zakwRyczalt');
        $zakwHotel = $request->input('zakwHotel');
        $hotelKoszt = $request->input('hotelKoszt');
        $sniadanieIlosc = $request->input('sniadanieIlosc');
        $obiadIlosc = $request->input('obiadIlosc');
        $kolacjaIlosc = $request->input('kolacjaIlosc');
        $wydatkiKwota = $request->input('wydatkiKwota');

        $start = $czRozpoPodr;
        $stop = $czZakonPodr;
        $kosztPodr = $kosztPodr;
        $sniadanie = $sniadanieIlosc;
        $obiad =  $obiadIlosc;
        $kolacja =  $kolacjaIlosc;
        $kosztNoclegu = $hotelKoszt;
        $inneKoszt =  $wydatkiKwota;

        // Ryczałt - Komunikacja miejska
        if ($komunikacjaMiejskaRadio1 === "true") {
            $ryczaltDojazdy = 0;
        } elseif ($komunikacjaMiejskaRadio2 === "true") {
            $ryczaltDojazdy = $nationalTrip->obliczRyczaltDojazdy($start, $stop);
        } elseif ($komunikacjaMiejskaRadio3 === "true") {
            $ryczaltDojazdy = $komunikacjaMiejskaIloscDni * $nationalTrip->komunikajcaMiejskaRyczaltStawka;
        }
        $razemDojazdyPrzejazdy = $nationalTrip->obliczRazemDojazdyPrzejazdy($start, $stop, $kosztPodr, $komunikacjaMiejskaRadio2, $komunikacjaMiejskaRadio3, $komunikacjaMiejskaIloscDni);
        $dietaMinusOdliczenia = $nationalTrip->obliczDiety($sniadanie, $obiad, $kolacja, $start, $stop)['dietaMinusOdliczenia'];

        // Ryczałt - Zakwaterowanie
        if ($zakwRyczalt === "true") {
            $noclegRyczaltWynik = $nationalTrip->obliczNoclegiRyczlt($start, $stop);
            $kosztNoclegu = 0;
        } else {
            $noclegRyczaltWynik = 0;
            $kosztNoclegu = $nationalTrip->obliczNoclegiWgRachunkow($kosztNoclegu);
        }

        $inneKoszt = $nationalTrip->obliczInne($inneKoszt);
        $obliczOgolemWynik = $nationalTrip->obiczOgolem($razemDojazdyPrzejazdy, $dietaMinusOdliczenia, $kosztNoclegu, $noclegRyczaltWynik, $inneKoszt);

        ///////////////////////////////////////////////////////////////////////////////
        //Przygotowanie danych do odesłania w postaci tabeli

        $wynik = array();
        $wynik['ryczaltDojazdy'] = number_format($ryczaltDojazdy, 2, ",", ".");
        $wynik['razemDojazdyPrzejazdy'] = number_format($razemDojazdyPrzejazdy, 2, ",", ".");
        $wynik['dietaMinusOdliczenia'] = number_format($dietaMinusOdliczenia, 2, ",", ".");
        $wynik['kosztNoclegu'] = number_format($kosztNoclegu, 2, ",", ".");
        $wynik['noclegRyczaltWynik'] = number_format($noclegRyczaltWynik, 2, ",", ".");
        $wynik['inneKoszt'] = number_format($inneKoszt, 2, ",", ".");
        $wynik['obliczOgolemWynik'] = number_format($obliczOgolemWynik, 2, ",", ".");

        return response()->json($wynik);
    }

    public function zagraniczna()
    {
        return view('foreign');
    }

    public function pomoc()
    {
        return view('help');
    }

    public function kontakt()
    {
        return view('contact');
    }

    public function podstawa()
    {
        return view('legal');
    }


    // PODRÓŻ KRAJOWA


    // PODRÓŻ ZAGRANICZNA

}
