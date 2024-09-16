<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pegawai\StoreRequest;
use App\Http\Requests\Pegawai\UpdateRequest;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        return Pegawai::all();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        return Pegawai::create($data);
    }

    public function show(Pegawai $pegawai) 
    {
        return $pegawai;
    }

    public function update(UpdateRequest $request, Pegawai $pegawai) 
    {
        $data = $request->validated();

        $pegawai->update($data);

        return response()->json([
            'message' => 'Data pegawai berhasil diperbarui'
        ]);
    }

    public function destroy(Pegawai $pegawai) 
    {
        $pegawai->delete();
        return response()->json([
            'message' => 'Data pegawai berhasil dihapus'
        ]);
    }
}
