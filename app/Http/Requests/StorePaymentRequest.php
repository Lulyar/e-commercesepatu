<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            /* bukti transfer wajib gambar (maks 5 MB) */
            'proof' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'proof.required' => 'Silakan unggah bukti transfer.',
            'proof.image'    => 'Bukti transfer harus berupa gambar.',
            'proof.mimes'    => 'Format gambar tidak didukung (hanya JPG / PNG / WEBP).',
            'proof.max'      => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
