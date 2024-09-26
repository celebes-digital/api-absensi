<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';
    protected $primaryKey = 'id_payroll';

    protected $fillable = [
        'id_pegawai',
        'periode',
        'potongan',
        'total_pembayaran',
        'tanggal_bayar'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
