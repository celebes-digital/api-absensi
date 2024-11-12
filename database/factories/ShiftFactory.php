<?php

namespace Database\Factories;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiftFactory extends Factory
{
    protected $model = Shift::class;

    public function definition()
    {
        return [
            'nama_shift' => $this->faker->word(),
            'jam_masuk' => $this->faker->time(),
            'jam_keluar' => $this->faker->time(),
            'jam_istirahat_mulai' => $this->faker->time(),
            'jam_istirahat_selesai' => $this->faker->time(),
            'toleransi_keterlambatan' => $this->faker->numberBetween(5, 30),
            'status' => $this->faker->randomElement(['Aktif', 'Arsip']),
            'warna' => $this->faker->hexColor(),
        ];
    }
}
