<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateNationalTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mRozpoPodr' => ['required', 'string', 'max:100'],
            'mZakonPodr' => ['required', 'string', 'max:100'],
            'czRozpoPodr' => ['required', 'date_format:Y-m-d H:i'],
            'czZakonPodr' => ['required', 'date_format:Y-m-d H:i', 'after_or_equal:czRozpoPodr'],
            'kosztPodr' => ['required', 'numeric', 'min:0'],
        ];
    }
}
