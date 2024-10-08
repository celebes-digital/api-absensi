<?php

namespace App\Http\Controllers;

use App\Services\JadwalService;
use App\Traits\ApiResponse;

use App\Http\Requests\Jadwal\StoreRequest;
use App\Http\Requests\Jadwal\UpdateRequest;
use App\Http\Resources\JadwalResource;

class JadwalController extends Controller
{
    use ApiResponse;

    protected JadwalService $jadwalService;

    public function __construct(JadwalService $jadwalService)
    {
        $this->jadwalService = $jadwalService;
    }

    public function index()
    {
        $data = $this->jadwalService->getAllJadwal();
        return $this->success('Berhasil mengambil semua data jadwal', JadwalResource::collection($data));
    }

    public function store(StoreRequest $request)
    {
        $data = $this->jadwalService->createJadwal($request->all());
        return $this->success('Berhasil menambahkan data jadwal', new JadwalResource($data), 201);
    }

    public function show(String $id)
    {
        $data = $this->jadwalService->getJadwalById($id);
        return $this->success('Berhasil mengambil data jadwal', new JadwalResource($data));
    }

    public function update(UpdateRequest $request, String $id)
    {
        $data = $this->jadwalService->updateJadwalById($request->all(), $id);
        return $this->success('Berhasil mengubah data jadwal', new JadwalResource($data));
    }

    public function destroy(String $id)
    {
        $this->jadwalService->deleteJadwal($id);
        return $this->success('Berhasil menghapus data jadwal');
    }
}
