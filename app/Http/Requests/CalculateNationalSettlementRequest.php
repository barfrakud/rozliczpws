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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'komunikacjaMiejskaRadio1' => $this->normalizeBoolean($this->input('komunikacjaMiejskaRadio1')),
            'komunikacjaMiejskaRadio2' => $this->normalizeBoolean($this->input('komunikacjaMiejskaRadio2')),
            'komunikacjaMiejskaRadio3' => $this->normalizeBoolean($this->input('komunikacjaMiejskaRadio3')),
            'zakwRyczalt' => $this->normalizeBoolean($this->input('zakwRyczalt')),
            'zakwHotel' => $this->normalizeBoolean($this->input('zakwHotel')),
            'hotelKoszt' => $this->normalizeDecimal($this->input('hotelKoszt')),
            'wydatkiKwota' => $this->normalizeDecimal($this->input('wydatkiKwota')),
        ]);
    }

    private function normalizeBoolean(mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    private function normalizeDecimal(mixed $value): mixed
    {
        if (!is_string($value)) {
            return $value;
        }

        return str_replace(',', '.', trim($value));
    }
}
