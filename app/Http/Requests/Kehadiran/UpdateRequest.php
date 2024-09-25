<?php

namespace App\Http\Requests\Kehadiran;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status'        => 'required|in:Hadir,Tidak hadir,Terlambat,Izin',
            'jam_keluar'    => 'sometimes|date_format:H:i:s',
            'jam_masuk'     => 'sometimes|date_format:H:i:s',
            'tgl_kehadiran' => 'required|date',
        ];
    }
}
