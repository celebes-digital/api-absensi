<?php

namespace App\Http\Requests\Gaji;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'gaji_pokok'    => 'required|numeric',
            'tunjangan'     => 'required|numeric',
            'rekening'      => 'required|string|max:20',
            'nama_bank'     => 'required|string|max:50',
        ];
    }
}
