<?php

namespace Database\Factories;

use App\Models\ShiftKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiftKerjaFactory extends Factory
{
    protected $model = ShiftKerja::class;

    public function definition()
    {
        return [
            'nama_shift' => $this->faker->word(),
            'hari' => $this->faker->dayOfWeek(),
            'jam_masuk' => $this->faker->time(),
            'jam_keluar' => $this->faker->time(),
        ];
    }
}
