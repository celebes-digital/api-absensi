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
}
