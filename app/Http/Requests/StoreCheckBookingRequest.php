<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckBookingRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk melakukan permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang diterapkan pada permintaan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<string>>
     */
    public function rules(): array
    {
        return [
            'booking_trx_id' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
