<?php

namespace Database\Factories;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition(): array
    {
        return [
            'id_user'           => User::factory(),
            'nama_lengkap'      => $this->faker->name,
            'nik'               => $this->faker->numerify('################'),
            'jk'                => $this->faker->randomElement(['l', 'p']),
            'tgl_lahir'         => $this->faker->date(),
            'tempat_lahir'      => $this->faker->city,
            'agama'             => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']),
            'gol_darah'         => $this->faker->randomElement(['A', 'B', 'AB', 'O', 'A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']),
            'pendidikan'        => $this->faker->randomElement(['SMA', 'D3', 'S1', 'S2', 'S3']),
            'kontak_darurat'    => $this->faker->numerify('08##########'),
            'mulai_kerja'       => $this->faker->date(),
            'jabatan'           => $this->faker->jobTitle,
            'rekening'          => $this->faker->bankAccountNumber,
            'alamat'            => $this->faker->address,
            'no_telp'           => $this->faker->numerify('08##########'),
        ];
    }
}
