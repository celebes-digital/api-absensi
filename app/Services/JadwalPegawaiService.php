<?php

namespace App\Services;

use App\Models\JadwalPegawai;
use Illuminate\Support\Facades\DB;

class JadwalPegawaiService
{
    public function getJadwalPegawai() 
    {
        $jadwalPegawai = JadwalPegawai::all();
        return $jadwalPegawai->load('jadwal', 'pegawai');
    }
    public function updateJadwalPegawai($id_pegawai, $id_jadwal) 
    {
        $jadwalPegawai = JadwalPegawai::updateOrInsert([
            'id_pegawai'    => $id_pegawai,
            'id_jadwal'     => $id_jadwal,
        ])->firstOrFail();
        
        return $jadwalPegawai->load('jadwal', 'pegawai');
    }
}