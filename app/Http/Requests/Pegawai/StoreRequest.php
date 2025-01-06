<?php

namespace App\Http\Requests\Pegawai;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'          => 'required|email|unique:users,email',
            'nik'            => 'required|numeric:16|unique:pegawai,nik',
            'nama_lengkap'   => 'required',
            'jk'             => 'required|in:l,p',
            'tgl_lahir'      => 'required',
            'tempat_lahir'   => 'required',
            'agama'          => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
            'gol_darah'      => 'required|in:A,B,AB,O,A+,B+,AB+,O+,A-,B-,AB-,O-',
            'pendidikan'     => 'required',
            'kontak_darurat' => 'required',
            'mulai_kerja'    => 'required|date',
            'jabatan'        => 'required',
            'rekening'       => 'required',
            'alamat'         => 'required',
            'no_telp'        => 'required',
        ];
    }
}
