<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_pegawai'    => $this->id_pegawai,
            'id_user'       => $this->id_user,
            'nama_lengkap'  => $this->nama_lengkap ?? 'Admin',
            'nik'           => $this->nik,
            'jk'            => $this->jk == 'l' ? 'Laki-laki' : 'Perempuan',
            'tgl_lahir'     => $this->tgl_lahir,
            'tempat_lahir'  => $this->tempat_lahir,
            'agama'         => $this->agama,
            'gol_darah'     => $this->gol_darah,
            'pendidikan'    => $this->pendidikan,
            'kontak_darurat'=> $this->kontak_darurat,
            'mulai_kerja'   => $this->mulai_kerja,
            'jabatan'       => $this->jabatan,
            'rekening'      => $this->rekening,
            'alamat'        => $this->alamat,
            'no_telp'       => $this->no_telp,
        ];
    }
}