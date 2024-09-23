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
        'id_gaji',
        'periode',
        'potongan',
        'total_pembayaran',
        'tanggal_bayar'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji', 'id_gaji');
    }
}
