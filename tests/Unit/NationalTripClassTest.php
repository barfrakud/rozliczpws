<?php

namespace Tests\Unit;

use App\Classes\NationalTripClass;
use Tests\TestCase;

class NationalTripClassTest extends TestCase
{
    public function test_calculates_city_transport_lump_sum_for_partial_day_trip(): void
    {
        $calculator = new NationalTripClass();

        $result = $calculator->calculateCityTransportLumpSum('2026-01-01 08:00', '2026-01-01 12:00');

        $this->assertSame(9.0, $result);
    }

    public function test_calculates_domestic_diet_for_ten_hour_trip(): void
    {
        $calculator = new NationalTripClass();

        $result = $calculator->calculateDietAllowances(0, 0, 0, '2026-01-01 08:00', '2026-01-01 18:00');

        $this->assertSame(22.5, $result['dieta']);
        $this->assertSame(22.5, $result['dietaMinusOdliczenia']);
    }

    public function test_calculates_total_transport_cost_with_days_based_city_transport(): void
    {
        $calculator = new NationalTripClass();

        $result = $calculator->calculateTotalTransportCosts(
            '2026-01-01 08:00',
            '2026-01-03 08:00',
            100.0,
            false,
            true,
            2
        );

        $this->assertSame(118.0, $result);
    }

    public function test_calculates_total_amount(): void
    {
        $calculator = new NationalTripClass();

        $result = $calculator->calculateTotalAmount(100, 50, 20, 10, 5);

        $this->assertSame(185.0, $result);
        $this->assertSame(185.0, $calculator->obiczOgolem(100, 50, 20, 10, 5));
    }
}
