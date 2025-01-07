<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jadwal\UpdateJadwalPegawaiRequest;
use App\Http\Resources\JadwalPegawaiResource;
use App\Services\JadwalPegawaiService;
use App\Traits\ApiResponse;

class JadwalPegawaiController extends Controller
{
    use ApiResponse;

    protected JadwalPegawaiService $jadwalPegawaiService;

    public function __construct(JadwalPegawaiService $jadwalPegawaiService)
    {
        $this->jadwalPegawaiService = $jadwalPegawaiService;
    }

    public function getJadwalPegawai()
    {
        $data = $this->jadwalPegawaiService->getJadwalPegawai();
        return $this->success('Berhasil mengambil data jadwal pegawai', JadwalPegawaiResource::collection($data));
    }

    public function getJadwalPegawaiById()
    {
        $data = $this->jadwalPegawaiService->getJadwalPegawaiById(request('id_jadwal'), request('id_pegawai'));

        return $this->success('Berhasil mengambil data jadwal pegawai', new JadwalPegawaiResource($data));
    }

    public function updateJadwalPegawai(UpdateJadwalPegawaiRequest $request)
    {
        $data = $this->jadwalPegawaiService->updateJadwalPegawai($request->id_pegawai, $request->id_jadwal);
        return $this->success('Berhasil mengubah data jadwal pegawai', new JadwalPegawaiResource($data));
    }
}
