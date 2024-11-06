<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table        = 'gaji';
    protected $primaryKey   = 'id_gaji';

    protected $fillable = [
        'id_pegawai',
        'gaji_pokok',
        'tunjangan',
        'rekening',
        'nama_bank',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function payroll() 
    {
        return $this->hasMany(Payroll::class, 'id_gaji', 'id_gaji');
    }
}
