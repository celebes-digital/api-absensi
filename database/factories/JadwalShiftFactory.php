<?php

namespace Database\Factories;

use App\Models\JadwalShift;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalShiftFactory extends Factory
{
    protected $model = JadwalShift::class;

    public function definition()
    {
        return [
            'id_shift' => \App\Models\Shift::factory(),
            'id_jadwal' => \App\Models\Jadwal::factory(),
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']),
        ];
    }
}
