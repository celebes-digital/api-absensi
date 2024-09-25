<?php

namespace App\Services;

use App\Models\Gaji;

class GajiService
{
    public function getAllGaji()
    {
        $gaji = Gaji::all();
        return $gaji->load('pegawai');
    }

    public function getGajiById($id)
    {
        $gaji = Gaji::findOrFail($id);
        return $gaji->load('pegawai');
    }
    
    public function createGaji($data)
    {
        $gaji = Gaji::create($data);
        return $gaji->load('pegawai');
    }

    public function updateGaji($data, $id)
    {
        $gaji = $this->getGajiById($id);
        $gaji->update($data);
        return $gaji->load('pegawai');
    }

    public function deleteGaji($id)
    {
        $gaji = $this->getGajiById($id);
        $gaji->delete();
    }
}