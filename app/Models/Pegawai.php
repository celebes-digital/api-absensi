<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_user',
        'nama',
        'kelamin',
        'tgl_lahir',
        'no_telp',
        'no_telp_darurat',
        'tgl_registrasi',
        'alamat',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
