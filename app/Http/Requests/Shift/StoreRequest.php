<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_shift'                => 'required|max:50',
            'jam_masuk'                 => 'required|date_format:H:i:s',
            'jam_keluar'                => 'required|date_format:H:i:s',
            'jam_istirahat_mulai'       => 'required|date_format:H:i:s',
            'jam_istirahat_selesai'     => 'required|date_format:H:i:s',
            'toleransi_keterlambatan'   => 'required|numeric',
            'warna'                     => 'sometimes|size:7'
        ];
    }
}
