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
    public function generateKeyAbsensiMasuk()
    {
        $data = $this->createDataKeyAbsensi('masuk');
        return $data;
    }

    public function generateKeyAbsensiKeluar()
    {
        $data = $this->createDataKeyAbsensi('keluar');
        return $data;
    }

    public function confirmAbsensiMasuk($request)
    {
        $jamMasuk   = now()->format('H:i:s');

        $idPegawai  = $this->getDataToken('masuk', $request->token);
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

    public function confirmAbsensiKeluar($request)
    {
        $jamKeluar  = now()->format('H:i:s');

        $idPegawai  = $this->getDataToken('keluar', $request->token);
        $pegawai    = Pegawai::findOrFail($idPegawai);

        $data = $pegawai->kehadiran->where('tgl_kehadiran', date('Y-m-d'))->first();

        $data->update([
            'jam_keluar' => $jamKeluar,
        ]);

        return $data;
    }

    public function getUserKehadiran()
    {
        $pegawai    = Auth::user()->pegawai;
        $data       = Kehadiran::where('id_pegawai', $pegawai->id_pegawai)->get();
        return $data;
    }

    public function getAllKehadiran(Request $request)
    {
        // $query = Kehadiran::query();
        // if($request->has('tgl_kehadiran')) {
        //     $query->where('tgl_kehadiran', $request->tgl_kehadiran);
        // }
        // if($request->has('status')) {
        //     $query->where('status', $request->status);
        // }

        // $data = $query->get();
        // $data->load('pegawai');
        // return $data;

        $query = Pegawai::with(['kehadiran' => function ($q) use ($request) {
            if ($request->has('tgl_kehadiran')) {
                $q->where('tgl_kehadiran', $request->tgl_kehadiran);
            } else {
                $q->where('tgl_kehadiran', date('Y-m-d'));
            }

            if ($request->has('status')) {
                $q->where('status', $request->status);
            }
        }]);

        if (!$request->has('status')) {
            $data = $query->get();
        } else {
            $data = $query->get()->filter(function ($pegawai) {
                return $pegawai->kehadiran->isNotEmpty();
            });
        }

        return $data;
    }

    public function getKehadiranById($id)
    {
        $data = Kehadiran::findOrFail($id);
        $data->load('pegawai');
        return $data;
    }

    public function createKehadiran($data)
    {
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

    protected function createDataKeyAbsensi($type)
    {
        $pegawai = Auth::user()->pegawai;
        $this->checkIsSudahAbsen($type, $pegawai);

        $token  = Str::random(10);
        $key    = $type . '-' . $token;

        Cache::put($key, $pegawai->id_pegawai, $seconds = 30);

        $data = [
            'token'         => $token,
            'waktu_aktif'   => 30,
        ];

        return $data;
    }

    protected function getDataToken($type, $token)
    {
        $key = $type . '-' . $token;
        $idPegawai = Cache::pull($key);

        if (!$idPegawai) {
            throw new BadRequestHttpException('Token absensi tidak valid');
        }

        return $idPegawai;
    }

    protected function checkStatusKehadiran($pegawai, $jamMasuk)
    {
        $shiftKerja = $pegawai?->jadwalPegawai?->jadwal?->jadwalShift
            ->where('hari', DateHelper::formatDate('l', Carbon::now()))
            ->first();

        if (!$shiftKerja) {
            throw new BadRequestHttpException('Shift kerja hari ini tidak ditemukan');
        }

        if ($jamMasuk > $shiftKerja->shift->jam_masuk) {
            throw new BadRequestHttpException('Jam masuk seharusnya: ' . $shiftKerja->shift->jam_masuk);
            $keterlambatan = Carbon::createFromFormat('H:i:s', $jamMasuk)
                ->diffInMinutes(Carbon::createFromFormat('H:i:s', $shiftKerja->jam_masuk));
            return 'Terlambat ' . $keterlambatan . ' menit';
        }

        return 'Hadir';
    }

    protected function checkIsSudahAbsen($type, $pegawai)
    {
        $kehadiran = $pegawai?->kehadiran?->where('tgl_kehadiran', date('Y-m-d'))->first();

        if ($type == 'masuk' && $kehadiran?->jam_masuk) {
            throw new BadRequestHttpException('Anda sudah absen masuk hari ini');
        }

        if ($type == 'keluar' && $kehadiran?->jam_keluar) {
            throw new BadRequestHttpException('Anda sudah absen keluar hari ini');
        }

        return false;
    }
}
