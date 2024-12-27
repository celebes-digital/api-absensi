<?php

namespace App\Http\Requests\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class GetJadwalPegawaiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_pegawai'    => 'required|exists:pegawai,id_pegawai',
            'id_jadwal'     => 'required|exists:jadwal,id_jadwal',
        ];
    }
}
