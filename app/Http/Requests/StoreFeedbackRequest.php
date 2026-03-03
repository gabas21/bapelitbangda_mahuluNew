<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama'  => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'pesan' => 'required|string|max:2000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required'  => 'Nama wajib diisi.',
            'nama.max'       => 'Nama maksimal 255 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max'      => 'Nomor HP maksimal 20 karakter.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max'      => 'Pesan maksimal 2000 karakter.',
        ];
    }
}
