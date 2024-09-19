<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftKerja extends Model
{
    use HasFactory;

    protected $table = 'shift_kerja';
    protected $primaryKey = 'id_shift_kerja';

    protected $fillable = [
        'id_shift_kerja',
        'hari',
        'jam_masuk',
        'jam_keluar',
        'id_pegawai'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
