<?php

namespace Database\Factories;

use App\Models\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    protected $model = Payroll::class;

    public function definition()
    {
        return [
            'id_pegawai' => \App\Models\Pegawai::factory(),
            'periode' => $this->faker->date(),
            'potongan' => $this->faker->numberBetween(100000, 500000),
            'total_pembayaran' => $this->faker->numberBetween(4000000, 15000000),
            'tanggal_bayar' => $this->faker->date(),
        ];
    }
}
