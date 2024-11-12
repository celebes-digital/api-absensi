<?php

namespace Database\Factories;

use App\Models\JadwalPegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalPegawaiFactory extends Factory
{
    protected $model = JadwalPegawai::class;

    public function definition()
    {
        return [
            'id_pegawai' => \App\Models\Pegawai::factory(),
            'id_jadwal' => \App\Models\Jadwal::factory(),
        ];
    }
}
