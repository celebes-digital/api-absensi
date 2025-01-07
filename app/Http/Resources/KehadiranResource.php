<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KehadiranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_pegawai'     => $this->id_pegawai,
            'id_kehadiran'   => $this->id_kehadiran,
            'status'         => $this->status,
            'nama_pegawai'   => $this->pegawai->nama_lengkap,
            'kode_kehadiran' => $this->kode_kehadiran,
            'hari'           => DateHelper::formatDate('l', Carbon::parse($this->tgl_kehadiran)),
            'tgl_kehadiran'  => DateHelper::formatDate('d F Y', Carbon::parse($this->tgl_kehadiran)),
            'jam_masuk'      => $this->jam_masuk,
            'jam_keluar'     => $this->jam_keluar,
        ];
    }
}
