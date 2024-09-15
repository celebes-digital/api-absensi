<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return Pegawai::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik'            => 'required|numeric:16|unique:pegawai,nik',
            'nama_lengkap'   => 'required',
            'jk'             => 'required|in:l,p',
            'tgl_lahir'      => 'required',
            'tempat_lahir'   => 'required',
            'agama'          => 'required|in:islam,katolik,hindu,buddha,konghucu',
            'gol_darah'      => 'required|in:A,B,AB,O,A+,B+,AB+,O+,A-,B-,AB-,O-',
            'pendidikan'     => 'required',
            'kontak_darurat' => 'required',
            'mulai_kerja'    => 'required|date',
            'jabatan'        => 'required',
            'rekening'       => 'required',
            'alamat'         => 'required',
            'no_telp'        => 'required',
        ]);

        return Pegawai::create($data);
    }

    public function show(Pegawai $pegawai) {
        return $pegawai;
    }

    public function update(Request $request, Pegawai $pegawai) {
        $data = $request->validate([
            'nik'            => 'required|numeric:16|unique:pegawai,nik',
            'nama_lengkap'   => 'required',
            'jk'             => 'required|in:l,p',
            'tgl_lahir'      => 'required',
            'tempat_lahir'   => 'required',
            'agama'          => 'required|in:islam,katolik,hindu,buddha,konghucu',
            'gol_darah'      => 'required|in:A,B,AB,O,A+,B+,AB+,O+,A-,B-,AB-,O-',
            'pendidikan'     => 'required',
            'kontak_darurat' => 'required',
            'mulai_kerja'    => 'required|date',
            'jabatan'        => 'required',
            'rekening'       => 'required',
            'alamat'         => 'required',
            'no_telp'        => 'required',
        ]);

        $pegawai->update($data);

        return "Update success";
    }

    public function destroy(Pegawai $pegawai) {
        $pegawai->delete();
        return ["message" => "Delete success"];
    }
}
