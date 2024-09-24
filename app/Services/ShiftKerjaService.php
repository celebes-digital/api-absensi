<?php

namespace App\Services;

use App\Models\ShiftKerja;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

// use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ShiftKerjaService
{
    use ApiResponse;

    public function getAllShiftKerja($request) 
    {
        $query = ShiftKerja::query();
        $query->join('pegawai', 'pegawai.id_pegawai', '=', 'shift_kerja.id_pegawai');

        if($request->has('search')) {
            $query->whereRaw('LOWER(pegawai.nama_lengkap) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }

        if($request->has('hari')) {
            $query->where('shift_kerja.hari', $request->hari);
        }

        return $query->get();
    }

    protected function checkTime($jamMasuk, $jamKeluar): void {
        if($jamMasuk > $jamKeluar) {
            throw new BadRequestHttpException('Jam keluar harus lebih besar dari jam masuk');
        }
    }

    public function createShiftKerja($data) 
    {
        $this->checkTime($data['jam_masuk'], $data['jam_keluar']);

        $shiftKerja = ShiftKerja::create($data);
        return $shiftKerja->load('pegawai');
    }

    public function getShiftKerjaById($id) 
    {
        return ShiftKerja::findOrFail($id);
    }

    public function updateShiftKerja($data, $id) 
    {
        $this->checkTime($data['jam_masuk'], $data['jam_keluar']);
        
        $shiftKerja = $this->getShiftKerjaById($id);
        $shiftKerja->update($data);
        return $shiftKerja->load('pegawai');
    }

    public function deleteShiftKerja($id) {
        $this->getShiftKerjaById($id);
        return ShiftKerja::destroy($id);
    }
}