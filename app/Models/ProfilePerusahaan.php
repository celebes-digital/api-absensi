<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePerusahaan extends Model
{
    protected $table = 'profile_perusahaan';
    protected $primaryKey = 'id_perusahaan';

    protected $fillable = [
        'id_perusahaan',
        'nama',
        'alamat',
        'logo',
        'no_telp',
        'email',
    ];

    use HasFactory;
}
