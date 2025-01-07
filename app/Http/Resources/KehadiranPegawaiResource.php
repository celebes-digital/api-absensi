<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KehadiranPegawaiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_pegawai'     => $this->id_pegawai,
            'id_kehadiran'   => $this->kehadiran->first()->id_kehadiran ?? '-',
            'status'         => $this->kehadiran->first()->status ?? '-',
            'nama_pegawai'   => $this->nama_lengkap,
            'kode_kehadiran' => $this->kehadiran->first()->kode_kehadiran ?? '-',
            'hari'           => DateHelper::formatDate('l', Carbon::parse($this->kehadiran->first()->tgl_kehadiran ?? Date('Y-m-d'))),
            'tgl_kehadiran' => $this->kehadiran->isNotEmpty() ? DateHelper::formatDate('d F Y', Carbon::parse($this->kehadiran->first()->tgl_kehadiran)) : '-',
            'jam_masuk'      => $this->kehadiran->first()->jam_masuk ?? '-',
            'jam_keluar'     => $this->kehadiran->first()->jam_keluar ?? '-',
        ];
    }
}
