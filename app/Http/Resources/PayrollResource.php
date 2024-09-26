<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_payroll'    => $this->id_payroll,
            'nama_pegawai'  => $this->pegawai->nama_lengkap,
            'periode'       => $this->periode,
            'total_gaji'    => $this->total_pembayaran,
        ];
    }
}
