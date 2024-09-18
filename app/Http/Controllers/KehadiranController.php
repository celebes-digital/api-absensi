<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class KehadiranController extends Controller
{
    public function generateKeyAbsensi() 
    {
        $user       = Auth::user();

        $idPegawai  = $user->pegawai->id_pegawai;
        $token      = Str::random(10);

        Cache::put($token, $idPegawai, $seconds = 30);

        return [
            'message'   => 'Berhasil mengenerate token absensi',
            'token'     => $token
        ];
    }
    
    public function confirmAbsensi(Request $request) 
    {
        $request->validate([
            'token' => 'required'
        ]);

        $token = $request->token;

        if(!Cache::get($token)) {
            return response()->json([
                'message' => 'token absensi tidak valid'
            ], 401);
        }
        $idPegawai = Cache::pull($token);

        $data = Kehadiran::create([
            'id_pegawai'        => $idPegawai,
            'status'            => 'hadir',
            'kode_kehadiran'    => Str::random(6),
            'tgl_kehadiran'     => date('Y-m-d'),
            'jam_masuk'         => now(),
        ]);

        return [
            'message'       => 'Berhasil konfirmasi absensi',
            'data'          => $data
        ];
    }
}
