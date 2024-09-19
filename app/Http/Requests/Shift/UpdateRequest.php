<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_masuk'     => 'required|date_format:H:i',
            'jam_keluar'    => 'required|date_format:H:i',
        ];
    }
}
