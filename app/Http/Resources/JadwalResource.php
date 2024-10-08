<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_jadwal'     => $this->id_jadwal,
            'nama_jadwal'   => $this->nama_jadwal,
            'is_default'    => $this->is_jadwal_default,
            'jadwal'        => $this->jadwalshift->map(function ($jadwalshift) {
                return [
                    'hari'          => $jadwalshift->hari,
                    'jam_masuk'     => $jadwalshift->shift->jam_masuk,
                    'jam_keluar'    => $jadwalshift->shift->jam_keluar,
                    'toleransi'     => $jadwalshift->shift->toleransi_keterlambatan,
                    'warna'         => $jadwalshift->shift->warna,
                ];
            }),
        ];
    }
}
