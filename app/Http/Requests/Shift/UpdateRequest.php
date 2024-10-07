<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_shift'                => 'sometimes|max:50',
            'jam_masuk'                 => 'sometimes|date_format:H:i:s',
            'jam_keluar'                => 'sometimes|date_format:H:i:s',
            'jam_istirahat_mulai'       => 'sometimes|date_format:H:i:s',
            'jam_istirahat_selesai'     => 'sometimes|date_format:H:i:s',
            'toleransi_keterlambatan'   => 'sometimes|numeric',
            'status'                    => 'sometimes|in:Aktif,Arsip',
            'warna'                     => 'sometimes|size:7'
        ];
    }
}
