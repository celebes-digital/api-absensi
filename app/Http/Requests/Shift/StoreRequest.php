<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_pegawai'    => 'required|exists:pegawai,id_pegawai',
            'hari'          => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_masuk'     => 'required|date_format:H:i:s',
            'jam_keluar'    => 'required|date_format:H:i:s',
        ];
    }
}
