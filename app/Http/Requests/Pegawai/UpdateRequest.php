<?php

namespace App\Http\Requests\Pegawai;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'email'          => 'sometimes|required|email',
            'nik'            => 'sometimes|required|numeric:16',
            'nama_lengkap'   => 'sometimes|required',
            'jk'             => 'sometimes|required|in:l,p',
            'tgl_lahir'      => 'sometimes|required',
            'tempat_lahir'   => 'sometimes|required',
            'agama'          => 'sometimes|required|in:islam,katolik,hindu,buddha,konghucu',
            'gol_darah'      => 'sometimes|required|in:A,B,AB,O,A+,B+,AB+,O+,A-,B-,AB-,O-',
            'pendidikan'     => 'sometimes|required',
            'kontak_darurat' => 'sometimes|required',
            'mulai_kerja'    => 'sometimes|required|date',
            'jabatan'        => 'sometimes|required',
            'rekening'       => 'sometimes|required',
            'alamat'         => 'sometimes|required',
            'no_telp'        => 'sometimes|required',
        ];
    }
}
