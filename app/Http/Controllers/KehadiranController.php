<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kehadiran\UpdateRequest;
use App\Http\Resources\KehadiranResource;
use App\Services\KehadiranService;
use App\Traits\ApiResponse;

use Illuminate\Http\Request;

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
        return $this->success('Berhasil konfirmasi absensi', new KehadiranResource($data));
    }

    public function index(Request $request)
    {
        $data = $this->kehadiranService->getAllKehadiran($request);
        return $this->success('Berhasil mengambil semua data kehadiran', KehadiranResource::collection($data));
    }

    public function show($id)
    {
        $data = $this->kehadiranService->getKehadiranById($id);
        return $this->success('Berhasil mengambil data kehadiran', new KehadiranResource($data));
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $this->kehadiranService->updateKehadiranById($request->all(), $id);
        return $this->success('Berhasil mengubah data kehadiran', new KehadiranResource($data));
    }
}
