<?php

namespace App\Http\Resources;

use App\Helpers\TimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_shift'                  => $this->id_shift,
            'nama_shift'                => $this->nama_shift,
            'jam_masuk'                 => date('H:i', strtotime($this->jam_masuk)),
            'jam_keluar'                => date('H:i', strtotime($this->jam_keluar)),
            'jam_istirahat'             => date('H:i', strtotime($this->jam_istirahat_mulai)),
            'jam_selesai_istirahat'     => date('H:i', strtotime($this->jam_istirahat_selesai)),
            'toleransi_keterlambatan'   => $this->toleransi_keterlambatan,
            'status'                    => $this->status,
            'warna'                     => $this->warna,
        ];
    }
}
