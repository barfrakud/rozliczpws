<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateNationalSettlementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'czRozpoPodr' => ['required', 'date_format:Y-m-d H:i'],
            'czZakonPodr' => ['required', 'date_format:Y-m-d H:i', 'after_or_equal:czRozpoPodr'],
            'kosztPodr' => ['required', 'numeric', 'min:0'],
            'komunikacjaMiejskaRadio1' => ['required', 'boolean'],
            'komunikacjaMiejskaRadio2' => ['required', 'boolean'],
            'komunikacjaMiejskaRadio3' => ['required', 'boolean'],
            'komunikacjaMiejskaIloscDni' => ['nullable', 'integer', 'min:0'],
            'zakwRyczalt' => ['required', 'boolean'],
            'zakwHotel' => ['required', 'boolean'],
            'hotelKoszt' => ['required', 'numeric', 'min:0'],
            'sniadanieIlosc' => ['required', 'integer', 'min:0'],
            'obiadIlosc' => ['required', 'integer', 'min:0'],
            'kolacjaIlosc' => ['required', 'integer', 'min:0'],
            'wydatkiKwota' => ['required', 'numeric', 'min:0'],
        ];
    }
}
