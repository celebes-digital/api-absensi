<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalPegawaiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nama_pegawai'  => $this->pegawai->nama_lengkap,
            'jabatan'       => $this->pegawai->jabatan,
            'jadwal'        => new JadwalResource($this->whenLoaded('jadwal')),
        ];
    }
}
