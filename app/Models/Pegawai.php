<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nik',
        'jk',
        'alamat',
        'no_telp',
        'tgl_lahir',
        'tempat_lahir',
        'agama',
        'gol_darah',
        'pendidikan',
        'kontak_darurat',
        'mulai_kerja',
        'jabatan',
        'rekening'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_pegawai', 'id_pegawai');
    }

    public function gaji() {
        return $this->hasOne(Gaji::class, 'id_pegawai', 'id_pegawai');
    }

    public function payrol() {
        return $this->hasMany(Gaji::class, 'id_pegawai', 'id_pegawai');
    }

    public function jadwalPegawai() {
        return $this->hasOne(JadwalPegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
