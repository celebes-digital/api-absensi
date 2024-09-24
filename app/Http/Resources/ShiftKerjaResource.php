<?php

namespace App\Http\Resources;

use App\Helpers\TimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Helpers\TimeHelper;

class ShiftKerjaResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_shift_kerja'=> $this->id_shift_kerja,
            'id_pegawai'    => $this->id_pegawai,
            'nama_pegawai'  => $this->pegawai->nama_lengkap,
            'hari'          => $this->hari,
            'jam_masuk'     => $this->jam_masuk,
            'jam_keluar'    => $this->jam_keluar,
            'lama_shift'    => TimeHelper::calculateTimeDifference($this->jam_masuk, $this->jam_keluar),
        ];
    }
}
