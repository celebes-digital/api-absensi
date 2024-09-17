<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email'         => 'admin@gmail.com',
            'is_admin'      => true,
            'password'      => bcrypt('12345678'),
            'last_active'   => now()
        ]);
    }
}
