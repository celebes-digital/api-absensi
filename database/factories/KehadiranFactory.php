<?php

namespace Database\Factories;

use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Factories\Factory;

class KehadiranFactory extends Factory
{
    protected $model = Kehadiran::class;

    public function definition()
    {
        return [
            'id_pegawai' => \App\Models\Pegawai::factory(),
            'kode_kehadiran' => $this->faker->bothify('##??##'),
            'tgl_kehadiran' => $this->faker->date(),
            'jam_masuk' => $this->faker->optional()->time(),
            'jam_keluar' => $this->faker->optional()->time(),
            'status' => $this->faker->randomElement(['Hadir', 'Tidak hadir', 'Terlambat', 'Izin']),
        ];
    }
}
