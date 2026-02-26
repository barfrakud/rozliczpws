<?php

namespace Tests\Feature;

use Tests\TestCase;

class NationalTripEndpointsTest extends TestCase
{
    public function test_trip_summary_endpoint_validates_required_fields(): void
    {
        $response = $this->postJson(route('krajowa.calculate-trip'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'mRozpoPodr',
            'mZakonPodr',
            'czRozpoPodr',
            'czZakonPodr',
            'kosztPodr',
        ]);
    }

    public function test_trip_summary_endpoint_returns_calculated_payload(): void
    {
        $response = $this->postJson(route('krajowa.calculate-trip'), [
            'mRozpoPodr' => 'Warszawa',
            'mZakonPodr' => 'Krakow',
            'czRozpoPodr' => '2026-01-01 08:00',
            'czZakonPodr' => '2026-01-01 18:00',
            'kosztPodr' => 120.5,
        ]);

        $response->assertOk();
        $response->assertJson([
            0 => 'Warszawa',
            1 => 'Krakow',
            2 => '2026-01-01 08:00',
            3 => '2026-01-01 18:00',
        ]);
    }

    public function test_settlement_endpoint_validates_required_fields(): void
    {
        $response = $this->postJson(route('krajowa.calculate-bill'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'czRozpoPodr',
            'czZakonPodr',
            'kosztPodr',
            'komunikacjaMiejskaRadio1',
            'komunikacjaMiejskaRadio2',
            'komunikacjaMiejskaRadio3',
            'zakwRyczalt',
            'zakwHotel',
            'hotelKoszt',
            'sniadanieIlosc',
            'obiadIlosc',
            'kolacjaIlosc',
            'wydatkiKwota',
        ]);
    }
}
