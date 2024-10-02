<?php

namespace App\Services;

use App\Models\Pegawai;
use App\Models\ShiftKerja;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ShiftKerjaService
{
    use ApiResponse;

    public function getShiftKerjaByUser() 
    {
        $pegawai = Pegawai::where('id_user', Auth::user()->id_user)->get();
        $shiftKerja = ShiftKerja::whereIn('id_pegawai', $pegawai->pluck('id_pegawai'))->get();
        return $shiftKerja;

    }

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

        $query->orderByRaw("
            CASE 
                WHEN hari = 'Senin'     THEN 1
                WHEN hari = 'Selasa'    THEN 2
                WHEN hari = 'Rabu'      THEN 3
                WHEN hari = 'Kamis'     THEN 4
                WHEN hari = 'Jumat'     THEN 5
                WHEN hari = 'Sabtu'     THEN 6
                WHEN hari = 'Minggu'    THEN 7
            END
        ");

        return $query->get();
    }

    protected function checkTimeInputIsValid($jamMasuk, $jamKeluar): void {
        if($jamMasuk > $jamKeluar) {
            throw new BadRequestHttpException('Jam keluar harus lebih besar dari jam masuk');
        }
    }

    public function createShiftKerja($data) 
    {
        $this->checkTimeInputIsValid($data['jam_masuk'], $data['jam_keluar']);

        $shiftKerja = ShiftKerja::create($data);
        return $shiftKerja->load('pegawai');
    }

    public function getShiftKerjaById($id) 
    {
        return ShiftKerja::findOrFail($id);
    }

    public function updateShiftKerja($data, $id) 
    {
        $this->checkTimeInputIsValid($data['jam_masuk'], $data['jam_keluar']);
        
        $shiftKerja = $this->getShiftKerjaById($id);
        $shiftKerja->update($data);
        return $shiftKerja->load('pegawai');
    }

    public function deleteShiftKerja($id) {
        $this->getShiftKerjaById($id);
        return ShiftKerja::destroy($id);
    }
}