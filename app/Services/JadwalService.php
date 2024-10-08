<?php

namespace App\Services;

use App\Http\Requests\Jadwal\StoreRequest;
use App\Models\Jadwal;

class JadwalService
{
    public function getAllJadwal()
    {
        $jadwal = Jadwal::with('jadwalshift.shift')->get();
        return $jadwal;
    }

    public function createJadwal($data)
    {
        $jadwal = Jadwal::create([
            'nama_jadwal'       => $data['nama_jadwal'],
            'is_jadwal_default' => $data->is_default ?? false,
        ]);

        foreach ($data['jadwal'] as $jadwalShift) {
            $jadwal->jadwalshift()->create([
                'id_shift' => $jadwalShift['id_shift'],
                'hari' => $jadwalShift['hari'],
            ]);
        }

        return $jadwal->load('jadwalshift')->load('shift');
    }

    public function getJadwalById($id)
    {
        $jadwal = Jadwal::with('jadwalshift.shift')->findOrFail($id);
        return $jadwal;
    }

    public function updateJadwalById($data, $id)
    {
        $jadwal = $this->getJadwalById($id);
        
        $jadwal->fill([
            'nama_jadwal'       => $data['nama_jadwal'] ?? $jadwal->nama_jadwal,
            'is_jadwal_default' => $data['is_default'] ?? $jadwal->is_jadwal_default,
        ])->save();
        
        if (isset($data['jadwal'])) {
            $jadwal->jadwalshift()->delete();

            foreach ($data['jadwal'] as $jadwalShift) {
                $jadwal->jadwalshift()->create([
                    'id_shift' => $jadwalShift['id_shift'],
                    'hari' => $jadwalShift['hari'],
                ]);
            }
        }

        return $jadwal->load('jadwalshift.shift');
    }

    public function deleteJadwal($id)
    {
        $jadwal = $this->getJadwalById($id);
        $jadwal->delete();
    }
}