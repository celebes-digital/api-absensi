<?php

namespace Database\Factories;

use App\Models\Gaji;
use Illuminate\Database\Eloquent\Factories\Factory;

class GajiFactory extends Factory
{
    protected $model = Gaji::class;

    public function definition()
    {
        return [
            'id_pegawai' => \App\Models\Pegawai::factory(),
            'gaji_pokok' => $this->faker->numberBetween(3000000, 10000000),
            'tunjangan' => $this->faker->numberBetween(500000, 3000000),
            'rekening' => $this->faker->optional()->bankAccountNumber(),
            'nama_bank' => $this->faker->optional()->company(),
        ];
    }
}
