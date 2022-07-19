<?php

namespace App\Classes;

use DateTime;

class NationalTripClass
{
    //Zmienne globalne
    public $dietaKrajowaStawka;
    public $komunikajcaMiejskaRyczaltStawka;
    public $noclegRyczaltStawka;

    public function __construct()
    {
        $this->dietaKrajowaStawka = 30;
        $this->komunikajcaMiejskaRyczaltStawka = 6;
        $this->noclegRyczaltStawka = 45;
    }

    // Obliczenie czasu podróży na potrzeby wyświetlania
    public function obliczCzasPodrozyKrajowej($start, $stop)
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);
        return $dDiff->format('%a : %h : %i');
    }

    // Obliczenie ilości dób podróży
    public function obliczDobyPodrozyKrajowej($start, $stop)
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);
        return $dDiff->format('%a');
    }

    //  Obliczenie czasu podróży na potrzeby pozostałych obliczeń
    public function obliczCzasPodrozy($start, $stop)
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);
        $wynik = array();
        $wynik['CPdoba'] = $dDiff->format('%a');
        $wynik['CPgodzina'] = $dDiff->format('%h');
        $wynik['CPminuta'] = $dDiff->format('%i');
        $wynik['czasPodr'] = $dDiff->format('%a : %h : %i');
        return $wynik;
    }

    // Obliczenie Ryczałt za dojazdy
    public function obliczRyczaltDojazdy($start, $stop)
    {
        $ryczaltDojazdy = 0;

        $CPdoba = $this->obliczCzasPodrozy($start, $stop)['CPdoba'];
        $CPgodzina = $this->obliczCzasPodrozy($start, $stop)['CPgodzina'];
        $CPminuta = $this->obliczCzasPodrozy($start, $stop)['CPminuta'];

        if ($CPdoba == 0 && $CPgodzina == 0 &&  $CPminuta == 0) {
            $ryczaltDojazdy = 0;
        } elseif ($CPdoba == 0 && ($CPminuta > 0 || $CPgodzina > 0)) {
            $ryczaltDojazdy = 1 * $this->komunikajcaMiejskaRyczaltStawka;
        } elseif ($CPdoba > 0 && $CPminuta == 0 && $CPgodzina == 0) {
            $ryczaltDojazdy = $CPdoba * $this->komunikajcaMiejskaRyczaltStawka;
        } elseif ($CPdoba > 0 && ($CPminuta > 0 || $CPgodzina > 0)) {
            $ryczaltDojazdy = $this->komunikajcaMiejskaRyczaltStawka * $CPdoba + $this->komunikajcaMiejskaRyczaltStawka;
        } else {
            $ryczaltDojazdy = 0;
        }
        return $ryczaltDojazdy;
    }

    // Funkcja - Obliczenie Razem przejazdy i dojazdy
    public function obliczRazemDojazdyPrzejazdy($start, $stop, $kosztPodr, $komunikacjaMiejskaRadio2, $komunikacjaMiejskaRadio3, $komunikacjaMiejskaIloscDni)
    {
        if ($komunikacjaMiejskaRadio2 === "true") {
            $razemDojazdyPrzejazdy = $kosztPodr + $this->obliczRyczaltDojazdy($start, $stop);
        } elseif ($komunikacjaMiejskaRadio3 === "true") {
            $razemDojazdyPrzejazdy = $kosztPodr + $komunikacjaMiejskaIloscDni * $this->komunikajcaMiejskaRyczaltStawka;
        } else {
            $razemDojazdyPrzejazdy = $kosztPodr;
        }

        return $razemDojazdyPrzejazdy;
    }

    // Funkcja - Obliczenie Diety
    public function obliczDiety($sniadanie, $obiad, $kolacja, $start, $stop)
    {

        $odliczenia = ($sniadanie * 0.25 * $this->dietaKrajowaStawka) + ($obiad * 0.5 * $this->dietaKrajowaStawka) + ($kolacja * 0.25 * $this->dietaKrajowaStawka);

        $CPdoba = $this->obliczCzasPodrozy($start, $stop)['CPdoba'];
        $CPgodzina = $this->obliczCzasPodrozy($start, $stop)['CPgodzina'];
        $CPminuta = $this->obliczCzasPodrozy($start, $stop)['CPminuta'];

        if ($CPdoba == 0) {
            if ($CPgodzina < 8) {
                $obliczonaDieta = 0;
            } elseif ((($CPgodzina == 8 && $CPminuta >= 0) || ($CPgodzina > 8 && $CPgodzina < 12 && $CPminuta >= 0)) || (($CPgodzina == 12 && $CPminuta == 0))) {
                $obliczonaDieta = 0.5  * $this->dietaKrajowaStawka;
            } elseif (($CPgodzina == 12 && $CPminuta > 0) || ($CPgodzina > 12 && $CPgodzina <= 23) || ($CPgodzina == 23 && $CPminuta !== 0)) {
                $obliczonaDieta = $this->dietaKrajowaStawka;
            }
        } else {
            $obliczonaDieta = $CPdoba * $this->dietaKrajowaStawka;
            if ($CPgodzina == 0 && $CPminuta == 0) {
                $obliczonaDieta += 0;
            } elseif ($CPgodzina < 8 || ($CPgodzina == 8 && $CPminuta == 0)) {
                $obliczonaDieta += 0.5 * $this->dietaKrajowaStawka;
            } elseif (($CPgodzina == 8 && $CPminuta > 0) || $CPgodzina > 8) {
                $obliczonaDieta += $this->dietaKrajowaStawka;
            }
        }

        $wynik = array();
        $wynik['odliczeniaSniadanie'] = $sniadanie * 0.25 * $this->dietaKrajowaStawka;
        $wynik['odliczeniaObiad'] = $obiad * 0.5 * $this->dietaKrajowaStawka;
        $wynik['odliczeniaKolacja'] = $kolacja * 0.25 * $this->dietaKrajowaStawka;
        $wynik['odliczenia'] = $odliczenia;
        $wynik['dieta'] = $obliczonaDieta;
        $wynik['dietaMinusOdliczenia'] = $obliczonaDieta - $odliczenia;
        return $wynik;
    }

    // Funkcja - Noclegi wg rachunków
    public function obliczNoclegiWgRachunkow($kosztNoclegu)
    {
        return $kosztNoclegu;
    }

    // Funkcja - Noclegi ryczałty
    public function obliczNoclegiRyczlt($start, $stop)
    {
        // $this->$noclegRyczaltStawka;

        $start = new DateTime($start);
        $end = new DateTime($stop);

        $nightShifts = 0;

        while ($start <= $end) {

            if (($start >= (clone $start)->setTime(0, 0, 0)) && ($start <= (clone $start)->setTime(1, 0, 0)) && ($end >= (clone $start)->modify('+6 hour'))) {
                $nightShifts++;
            }

            if (($start >= (clone $start)->setTime(7, 0, 0)) && ($start <= (clone $start)->setTime(21, 0, 0)) && ($end >= (clone $start)->modify('+1 day')->setTime(3, 0, 0))) {
                $nightShifts++;
            }

            if (($start >= (clone $start)->setTime(21, 0, 0)) && ($start < (clone $start)->setTime(23, 59, 59)) && ($end >= (clone $start)->modify('+1 day')->setTime(3, 0, 0)) && ($end >= (clone $start)->modify('+6 hour'))) {
                $nightShifts++;
            }

            $start->modify('+1 day');
        }

        return $nightShifts * $this->noclegRyczaltStawka;
    }

    // Funkcja - Inne wydatki wg załączników
    function obliczInne($inneKoszt)
    {
        return $inneKoszt;
    }

    // Funkcja - Obliczanie Sumy ogółem
    function obiczOgolem($razemPrzejazdy, $diety, $noclegiRachunki, $noclegiRyczalty, $inneWydatki)
    {
        $obliczOgolemWynik = $razemPrzejazdy + $diety + $noclegiRachunki + $noclegiRyczalty + $inneWydatki;
        return $obliczOgolemWynik;
    }
}
