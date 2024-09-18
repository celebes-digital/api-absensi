<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table        = 'kehadiran';
    protected $primaryKey   = 'id_kehadiran';
    protected $timestamp    = false;
    
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'id_pegawai',
        'kode_kehadiran',
        'tgl_kehadiran',
        'jam_masuk',
        'jam_keluar',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
