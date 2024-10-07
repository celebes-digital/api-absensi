<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table        = 'shift';
    protected $primaryKey   = 'id_shift';

    protected $fillable     = [
        'nama_shift',
        'jam_masuk',
        'jam_keluar',
        'jam_istirahat_mulai',
        'jam_istirahat_selesai',
        'toleransi_keterlambatan',
        'status',
        'warna'
    ];
}
