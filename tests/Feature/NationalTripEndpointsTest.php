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

    public function test_settlement_endpoint_accepts_jquery_string_booleans(): void
    {
        $response = $this->post(route('krajowa.calculate-bill'), [
            'czRozpoPodr' => '2026-01-01 08:00',
            'czZakonPodr' => '2026-01-01 18:00',
            'kosztPodr' => '120.50',
            'komunikacjaMiejskaRadio1' => 'false',
            'komunikacjaMiejskaRadio2' => 'true',
            'komunikacjaMiejskaRadio3' => 'false',
            'komunikacjaMiejskaIloscDni' => '',
            'zakwRyczalt' => 'true',
            'zakwHotel' => 'false',
            'hotelKoszt' => '0',
            'sniadanieIlosc' => '0',
            'obiadIlosc' => '0',
            'kolacjaIlosc' => '0',
            'wydatkiKwota' => '0',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'ryczaltDojazdy',
            'razemDojazdyPrzejazdy',
            'dietaMinusOdliczenia',
            'kosztNoclegu',
            'noclegRyczaltWynik',
            'inneKoszt',
            'obliczOgolemWynik',
        ]);
    }
}
