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
        return $this->success('Berhasil membuat token absensi', $token);
    }
    
    public function confirmAbsensi(Request $request) 
    {
        $request->validate([
            'token' => 'required'
        ]);

        $data = $this->kehadiranService->confirmAbsensi($request);
        return $this->success('Berhasil konfirmasi absensi', $data);
    }
}
