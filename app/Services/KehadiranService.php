<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class KehadiranService
{
    public function generateKeyAbsensi()
    {
        $user       = Auth::user();

        $idPegawai  = $user->pegawai->id_pegawai;
        $token      = Str::random(10);

        Cache::put($token, $idPegawai, $seconds = 30);

        return $token;
    }
}
