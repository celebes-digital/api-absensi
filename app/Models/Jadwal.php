<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table        = 'jadwal';
    protected $primaryKey   = 'id_jadwal';

    protected $fillable     = [
        'nama_jadwal',
        'is_jadwal_default',
    ];

    public function jadwalshift()
    {
        return $this->hasMany(JadwalShift::class, 'id_jadwal', 'id_jadwal');
    }
}
