<?php

namespace App\Services;

use App\Models\Pegawai;
use App\Models\User;

class PegawaiService 
{
    public function getAllPegawai($request) 
    {
        $query = Pegawai::query();
        if($request->has('search')) {
            $query->whereRaw('LOWER(nama_lengkap) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }

        return $query->get();
    }

    public function createPegawai($data)
    {
        $user = User::create([
            'email'         => $data['email'],
            'password'      => bcrypt('absensi_key_temp'),
        ]);
        $data['id_user'] = $user->id_user;
        $pegawai = Pegawai::create($data);

        return $pegawai;
    }

    public function getPegawaiById($id) 
    {
        return Pegawai::findOrFail($id)->load('user');
    }

    public function updatePegawai(Pegawai $pegawai, $data) 
    {
        $pegawai->update($data);
        return $pegawai;
    }

    public function deletePegawai(int $id) 
    {
        $pegawai = $this->getPegawaiById($id);
        $pegawai->delete();
    }
}