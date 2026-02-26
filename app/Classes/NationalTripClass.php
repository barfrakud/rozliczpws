<?php

namespace App\Classes;

use DateTime;

class NationalTripClass
{
    public float $domesticPerDiemRate;
    public float $cityTransportLumpSumRate;
    public float $nightLumpSumRate;
    public float $dietaKrajowaStawka;
    public float $komunikajcaMiejskaRyczaltStawka;
    public float $noclegRyczaltStawka;

    public function __construct()
    {
        $this->domesticPerDiemRate = (float) config('rozliczpws.dietaKrajowaStawka');
        $this->cityTransportLumpSumRate = (float) config(
            'rozliczpws.komunikacjaMiejskaRyczaltStawka',
            config('rozliczpws.komunikajcaMiejskaRyczaltStawka')
        );
        $this->nightLumpSumRate = (float) config('rozliczpws.noclegRyczaltStawka');

        // Backward-compatible aliases used by older code.
        $this->dietaKrajowaStawka = $this->domesticPerDiemRate;
        $this->komunikajcaMiejskaRyczaltStawka = $this->cityTransportLumpSumRate;
        $this->noclegRyczaltStawka = $this->nightLumpSumRate;
    }

    public function calculateTravelDurationForDisplay(string $start, string $stop): string
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);

        return $dDiff->format('%a : %h : %i');
    }

    public function calculateTravelDaysForDisplay(string $start, string $stop): string
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);

        return $dDiff->format('%a');
    }

    public function calculateTravelTimeParts(string $start, string $stop): array
    {
        $dStart = new DateTime($start);
        $dEnd = new DateTime($stop);
        $dDiff = $dStart->diff($dEnd);

        return [
            'CPdoba' => (int) $dDiff->format('%a'),
            'CPgodzina' => (int) $dDiff->format('%h'),
            'CPminuta' => (int) $dDiff->format('%i'),
            'czasPodr' => $dDiff->format('%a : %h : %i'),
        ];
    }

    public function calculateCityTransportLumpSum(string $start, string $stop): float
    {
        $travelTime = $this->calculateTravelTimeParts($start, $stop);
        $travelDays = $travelTime['CPdoba'];
        $travelHours = $travelTime['CPgodzina'];
        $travelMinutes = $travelTime['CPminuta'];

        if ($travelDays === 0 && $travelHours === 0 && $travelMinutes === 0) {
            return 0.0;
        }

        if ($travelDays === 0 && ($travelMinutes > 0 || $travelHours > 0)) {
            return $this->cityTransportLumpSumRate;
        }

        if ($travelDays > 0 && $travelMinutes === 0 && $travelHours === 0) {
            return $travelDays * $this->cityTransportLumpSumRate;
        }

        if ($travelDays > 0 && ($travelMinutes > 0 || $travelHours > 0)) {
            return ($this->cityTransportLumpSumRate * $travelDays) + $this->cityTransportLumpSumRate;
        }

        return 0.0;
    }

    public function calculateTotalTransportCosts(
        string $start,
        string $stop,
        float $travelCost,
        bool|string $cityTransportByTravelTime,
        bool|string $cityTransportByDays,
        int $cityTransportDays
    ): float {
        $byTravelTime = filter_var($cityTransportByTravelTime, FILTER_VALIDATE_BOOLEAN);
        $byDays = filter_var($cityTransportByDays, FILTER_VALIDATE_BOOLEAN);

        if ($byTravelTime) {
            return $travelCost + $this->calculateCityTransportLumpSum($start, $stop);
        }

        if ($byDays) {
            return $travelCost + ($cityTransportDays * $this->cityTransportLumpSumRate);
        }

        return $travelCost;
    }

    public function calculateDietAllowances(int $breakfast, int $lunch, int $dinner, string $start, string $stop): array
    {
        $deductions = ($breakfast * 0.25 * $this->domesticPerDiemRate)
            + ($lunch * 0.5 * $this->domesticPerDiemRate)
            + ($dinner * 0.25 * $this->domesticPerDiemRate);

        $travelTime = $this->calculateTravelTimeParts($start, $stop);
        $travelDays = $travelTime['CPdoba'];
        $travelHours = $travelTime['CPgodzina'];
        $travelMinutes = $travelTime['CPminuta'];
        $calculatedDiet = 0.0;

        if ($travelDays === 0) {
            if ($travelHours < 8) {
                $calculatedDiet = 0.0;
            } elseif ((($travelHours === 8 && $travelMinutes >= 0) || ($travelHours > 8 && $travelHours < 12 && $travelMinutes >= 0)) || ($travelHours === 12 && $travelMinutes === 0)) {
                $calculatedDiet = 0.5 * $this->domesticPerDiemRate;
            } elseif (($travelHours === 12 && $travelMinutes > 0) || $travelHours > 12) {
                $calculatedDiet = $this->domesticPerDiemRate;
            }
        } else {
            $calculatedDiet = $travelDays * $this->domesticPerDiemRate;

            if ($travelHours === 0 && $travelMinutes === 0) {
                $calculatedDiet += 0.0;
            } elseif ($travelHours < 8 || ($travelHours === 8 && $travelMinutes === 0)) {
                $calculatedDiet += 0.5 * $this->domesticPerDiemRate;
            } elseif (($travelHours === 8 && $travelMinutes > 0) || $travelHours > 8) {
                $calculatedDiet += $this->domesticPerDiemRate;
            }
        }

        return [
            'odliczeniaSniadanie' => $breakfast * 0.25 * $this->domesticPerDiemRate,
            'odliczeniaObiad' => $lunch * 0.5 * $this->domesticPerDiemRate,
            'odliczeniaKolacja' => $dinner * 0.25 * $this->domesticPerDiemRate,
            'odliczenia' => $deductions,
            'dieta' => $calculatedDiet,
            'dietaMinusOdliczenia' => $calculatedDiet - $deductions,
        ];
    }

    public function calculateHotelCostsFromBills(float $hotelCost): float
    {
        return $hotelCost;
    }

    public function calculateNightLumpSum(string $start, string $stop): float
    {
        $startAt = new DateTime($start);
        $endAt = new DateTime($stop);
        $nightShifts = 0;

        while ($startAt <= $endAt) {
            if (($startAt >= (clone $startAt)->setTime(0, 0, 0))
                && ($startAt <= (clone $startAt)->setTime(1, 0, 0))
                && ($endAt >= (clone $startAt)->modify('+6 hour'))
            ) {
                $nightShifts++;
            }

            if (($startAt >= (clone $startAt)->setTime(7, 0, 0))
                && ($startAt <= (clone $startAt)->setTime(21, 0, 0))
                && ($endAt >= (clone $startAt)->modify('+1 day')->setTime(3, 0, 0))
            ) {
                $nightShifts++;
            }

            if (($startAt >= (clone $startAt)->setTime(21, 0, 0))
                && ($startAt < (clone $startAt)->setTime(23, 59, 59))
                && ($endAt >= (clone $startAt)->modify('+1 day')->setTime(3, 0, 0))
                && ($endAt >= (clone $startAt)->modify('+6 hour'))
            ) {
                $nightShifts++;
            }

            $startAt->modify('+1 day');
        }

        return $nightShifts * $this->nightLumpSumRate;
    }

    public function calculateOtherCosts(float $otherCosts): float
    {
        return $otherCosts;
    }

    public function calculateTotalAmount(
        float $totalTransport,
        float $dietAmount,
        float $hotelCosts,
        float $nightLumpSum,
        float $otherCosts
    ): float {
        return $totalTransport + $dietAmount + $hotelCosts + $nightLumpSum + $otherCosts;
    }

    public function obliczCzasPodrozyKrajowej($start, $stop): string
    {
        return $this->calculateTravelDurationForDisplay((string) $start, (string) $stop);
    }

    public function obliczDobyPodrozyKrajowej($start, $stop): string
    {
        return $this->calculateTravelDaysForDisplay((string) $start, (string) $stop);
    }

    public function obliczCzasPodrozy($start, $stop): array
    {
        return $this->calculateTravelTimeParts((string) $start, (string) $stop);
    }

    public function obliczRyczaltDojazdy($start, $stop): float
    {
        return $this->calculateCityTransportLumpSum((string) $start, (string) $stop);
    }

    public function obliczRazemDojazdyPrzejazdy($start, $stop, $kosztPodr, $komunikacjaMiejskaRadio2, $komunikacjaMiejskaRadio3, $komunikacjaMiejskaIloscDni): float
    {
        return $this->calculateTotalTransportCosts(
            (string) $start,
            (string) $stop,
            (float) $kosztPodr,
            $komunikacjaMiejskaRadio2,
            $komunikacjaMiejskaRadio3,
            (int) $komunikacjaMiejskaIloscDni
        );
    }

    public function obliczDiety($sniadanie, $obiad, $kolacja, $start, $stop): array
    {
        return $this->calculateDietAllowances((int) $sniadanie, (int) $obiad, (int) $kolacja, (string) $start, (string) $stop);
    }

    public function obliczNoclegiWgRachunkow($kosztNoclegu): float
    {
        return $this->calculateHotelCostsFromBills((float) $kosztNoclegu);
    }

    public function obliczNoclegiRyczlt($start, $stop): float
    {
        return $this->calculateNightLumpSum((string) $start, (string) $stop);
    }

    public function obliczInne($inneKoszt): float
    {
        return $this->calculateOtherCosts((float) $inneKoszt);
    }

    public function obiczOgolem($razemPrzejazdy, $diety, $noclegiRachunki, $noclegiRyczalty, $inneWydatki): float
    {
        return $this->calculateTotalAmount(
            (float) $razemPrzejazdy,
            (float) $diety,
            (float) $noclegiRachunki,
            (float) $noclegiRyczalty,
            (float) $inneWydatki
        );
    }
}
