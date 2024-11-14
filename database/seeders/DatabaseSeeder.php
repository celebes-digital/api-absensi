<?php

namespace Database\Seeders;

use App\Models\Gaji;
use App\Models\Jadwal;
use App\Models\JadwalPegawai;
use App\Models\JadwalShift;
use App\Models\Kehadiran;
use App\Models\Payroll;
use App\Models\Pegawai;
use App\Models\ProfilePerusahaan;
use App\Models\Shift;
use App\Models\ShiftKerja;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::create([
        //     'email'             => 'admin@gmail.com',
        //     'is_admin'          => true,
        //     'password'          => bcrypt('12345678'),
        //     'is_email_verified' => true,
        //     'last_active'       => now(),
        // ]);

        // User::create([
        //     'email'             => 'user@gmail.com',
        //     'is_admin'          => false,
        //     'password'          => bcrypt('12345678'),
        //     'is_email_verified' => true,
        //     'last_active'       => now()
        // ]);

        // Pegawai::create([
        //     'id_user'       => 2,
        //     'nik'           => 123456,
        //     'nama_lengkap'  => 'user',
        //     'tgl_lahir'     => '1999-01-01',
        //     'tempat_lahir'  => 'Makassar',
        //     'jk'            => 'l',
        //     'agama'         => 'islam',
        //     'gol_darah'     => 'A+',
        //     'pendidikan'    => 'Sarjana Informatika',
        //     'kontak_darurat' => '085',
        //     'mulai_kerja'   => '2024-12-09',
        //     'jabatan'       => 'Junior developer',
        //     'alamat'        => 'Makassar',
        //     'no_telp'       => '085',
        //     'rekening'      => '08'
        // ]);

        // ProfilePerusahaan::create([
        //     'nama'              => 'PT. ABC',
        //     'logo'              => '/storage/images/logo.png',
        //     'alamat'            => 'Makassar',
        //     'no_telp'           => '085',
        //     'email'             => 'admin@gmail.com',
        // ]);

        // Factories
        // Pegawai::factory(15)->create();
        // Kehadiran::factory(5)->create();
        // ShiftKerja::factory(5)->create();
        Gaji::factory(10)->create();
        // Payroll::factory(5)->create();
        // Shift::factory(5)->create();
        // Jadwal::factory(5)->create();
        // JadwalShift::factory(5)->create();
        // JadwalPegawai::factory(5)->create();
    }
}
