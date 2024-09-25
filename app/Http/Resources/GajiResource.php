<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GajiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_gaji'       => $this->id_gaji,
            'nama_pegawai'  => $this->pegawai->nama_lengkap,
            'gaji_pokok'    => $this->gaji_pokok,
            'tunjangan'     => $this->tunjangan,
            'nama_bank'     => $this->nama_bank,
            'rekening'      => $this->rekening,
        ];
    }
}
