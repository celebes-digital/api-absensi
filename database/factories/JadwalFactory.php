<?php

namespace Database\Factories;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    public function definition()
    {
        return [
            'nama_jadwal' => $this->faker->word(),
            'is_jadwal_default' => $this->faker->boolean(),
        ];
    }
}
