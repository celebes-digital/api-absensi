<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email'             => 'admin@gmail.com',
            'is_admin'          => true,
            'password'          => bcrypt('12345678'),
            'is_email_verified' => true,
            'last_active'       => now(),
        ]);

        User::create([
            'email'             => 'user@gmail.com',
            'is_admin'          => false,
            'password'          => bcrypt('12345678'),
            'is_email_verified' => true,
            'last_active'       => now()
        ]);

        Pegawai::create([
            'id_user'       => 2,
            'nik'           => 123456,
            'nama_lengkap'  => 'user',
            'tgl_lahir'     => '1999-01-01',
            'tempat_lahir'  => 'Makassar',
            'jk'            => 'l',
            'agama'         => 'islam',
            'gol_darah'     => 'A+',
            'pendidikan'    => 'Sarjana Informatika',
            'kontak_darurat' => '085',
            'mulai_kerja'   => '12-09-2024',
            'jabatan'       => 'Junior developer',
            'alamat'        => 'Makassar',
            'no_telp'       => '085',
            'rekening'      => '08'
        ]);
    }
}
