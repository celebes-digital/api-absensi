<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class KehadiranService
{
    public function generateKeyAbsensi()
    {
        $user   = User::with('pegawai')->findOrFail(Auth::id());
        $token  = Str::random(10);

        Cache::put($token, $user->pegawai->id_pegawai, $seconds = 200);

        $data = [
            'token'     => $token,
        ];

        return $data;
    }

    public function confirmAbsensi($request)
    {
        $token = $request->token;
        $jamMasuk = now()->format('H:i:s');

        if(!Cache::get($token)) {
            throw new BadRequestHttpException('Token absensi tidak valid');
        }
        $idPegawai  = Cache::pull($token);
        $pegawai    = Pegawai::findOrFail($idPegawai);
        $status     = $this->checkStatusKehadiran($pegawai, $jamMasuk);

        $data = Kehadiran::create([
            'id_pegawai'        => $idPegawai,
            'status'            => $status,
            'kode_kehadiran'    => Str::random(6),
            'tgl_kehadiran'     => date('Y-m-d'),
            'jam_masuk'         => $jamMasuk,
        ]);

        return $data;
    }

    public function getUserKehadiran() {
        $pegawai = Auth::user()->pegawai;
        $data = Kehadiran::where('id_pegawai', $pegawai->id_pegawai)->get();
        return $data;
    }

    public function getAllKehadiran(Request $request)
    {
        $query = Kehadiran::query();
        if($request->has('tgl_kehadiran')) {
            $query->where('tgl_kehadiran', $request->tgl_kehadiran);
        }
        if($request->has('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->get();
        $data->load('pegawai');
        return $data;
    }

    public function getKehadiranById($id)
    {
        $data = Kehadiran::findOrFail($id);
        $data->load('pegawai');
        return $data;
    }

    public function createKehadiran($data) {
        $kehadiran = Kehadiran::create($data);
        return $kehadiran->load('pegawai');
    }

    public  function updateKehadiranById($data, $id)
    {
        $kehadiran = $this->getKehadiranById($id);
        $kehadiran->update($data);
        return $kehadiran->load('pegawai');
    }

    public function deleteKehadiranById($id)
    {
        $kehadiran = $this->getKehadiranById($id);
        $kehadiran->delete();
        return $kehadiran;
    }

    protected function checkStatusKehadiran($pegawai, $jamMasuk) 
    {
        $shiftKerja = $pegawai->jadwalPegawai->jadwal->jadwalShift
                                ->where('hari', DateHelper::formatDate('l', Carbon::now()))
                                ->first();

        if(!$shiftKerja) { 
            throw new BadRequestHttpException('Shift kerja hari ini tidak ditemukan');
        }

        if($jamMasuk > $shiftKerja->jam_masuk) {
            return 'Terlambat';
        }

        return 'Hadir';
    }
}
