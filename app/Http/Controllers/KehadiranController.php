<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Services\KehadiranService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class KehadiranController extends Controller
{
    use ApiResponse;

    protected KehadiranService $kehadiranService;

    public function __construct(KehadiranService $kehadiranService)
    {
        $this->kehadiranService = $kehadiranService;
    }

    public function generateKeyAbsensi() 
    {
        $token = $this->kehadiranService->generateKeyAbsensi();
        return $this->success(['token' => $token]);
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
