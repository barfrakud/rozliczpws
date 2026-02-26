<?php

namespace App\Services;

use App\Classes\NationalTripClass;

class NationalTripService
{
    public function __construct(private NationalTripClass $nationalTrip)
    {
    }

    public function calculateTripSummary(array $data): array
    {
        return [
            $data['mRozpoPodr'],
            $data['mZakonPodr'],
            $data['czRozpoPodr'],
            $data['czZakonPodr'],
            number_format((float) $data['kosztPodr'], 2, ',', '.'),
            $this->nationalTrip->calculateTravelDurationForDisplay($data['czRozpoPodr'], $data['czZakonPodr']),
            $this->nationalTrip->calculateTravelDaysForDisplay($data['czRozpoPodr'], $data['czZakonPodr']),
        ];
    }

    public function calculateSettlement(array $data): array
    {
        $start = $data['czRozpoPodr'];
        $stop = $data['czZakonPodr'];
        $travelCost = (float) $data['kosztPodr'];
        $cityTransportByTravelTime = $this->toBoolean($data['komunikacjaMiejskaRadio2']);
        $cityTransportByDays = $this->toBoolean($data['komunikacjaMiejskaRadio3']);
        $cityTransportDays = (int) ($data['komunikacjaMiejskaIloscDni'] ?? 0);
        $hotelLumpSum = $this->toBoolean($data['zakwRyczalt']);
        $hotelCost = (float) $data['hotelKoszt'];
        $breakfastCount = (int) $data['sniadanieIlosc'];
        $lunchCount = (int) $data['obiadIlosc'];
        $dinnerCount = (int) $data['kolacjaIlosc'];
        $otherCosts = (float) $data['wydatkiKwota'];

        $cityTransportLumpSum = 0.0;
        if ($cityTransportByTravelTime) {
            $cityTransportLumpSum = $this->nationalTrip->calculateCityTransportLumpSum($start, $stop);
        }

        if ($cityTransportByDays) {
            $cityTransportLumpSum = $cityTransportDays * $this->nationalTrip->cityTransportLumpSumRate;
        }

        $totalTransportCosts = $this->nationalTrip->calculateTotalTransportCosts(
            $start,
            $stop,
            $travelCost,
            $cityTransportByTravelTime,
            $cityTransportByDays,
            $cityTransportDays
        );

        $dietMinusDeductions = $this->nationalTrip
            ->calculateDietAllowances($breakfastCount, $lunchCount, $dinnerCount, $start, $stop)['dietaMinusOdliczenia'];

        if ($hotelLumpSum) {
            $nightLumpSum = $this->nationalTrip->calculateNightLumpSum($start, $stop);
            $hotelCost = 0.0;
        } else {
            $nightLumpSum = 0.0;
            $hotelCost = $this->nationalTrip->calculateHotelCostsFromBills($hotelCost);
        }

        $otherCosts = $this->nationalTrip->calculateOtherCosts($otherCosts);
        $totalAmount = $this->nationalTrip->calculateTotalAmount(
            $totalTransportCosts,
            $dietMinusDeductions,
            $hotelCost,
            $nightLumpSum,
            $otherCosts
        );

        return [
            'ryczaltDojazdy' => number_format($cityTransportLumpSum, 2, ',', '.'),
            'razemDojazdyPrzejazdy' => number_format($totalTransportCosts, 2, ',', '.'),
            'dietaMinusOdliczenia' => number_format($dietMinusDeductions, 2, ',', '.'),
            'kosztNoclegu' => number_format($hotelCost, 2, ',', '.'),
            'noclegRyczaltWynik' => number_format($nightLumpSum, 2, ',', '.'),
            'inneKoszt' => number_format($otherCosts, 2, ',', '.'),
            'obliczOgolemWynik' => number_format($totalAmount, 2, ',', '.'),
        ];
    }

    private function toBoolean(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
