<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pegawai\StoreRequest;
use App\Http\Requests\Pegawai\UpdateRequest;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PegawaiController extends Controller
{
    public function index()
    {
        return Pegawai::all();
    }

    public function store(StoreRequest $request)
    {
        Gate::authorize('create', Pegawai::class);

        $data = $request->validated();
        $user = User::create([
            'email'         => $data['email'],
            'password'      => bcrypt('absensi_key_temp'),
        ]);

        $data['id_user'] = $user->id_user;
        Pegawai::create($data);

        return $data;
    }

    public function show(Pegawai $pegawai) 
    {
        return $pegawai;
    }

    public function update(UpdateRequest $request, Pegawai $pegawai) 
    {
        Gate::authorize('create', Pegawai::class);

        $data = $request->validated();

        $pegawai->update($data);

        return response()->json([
            'message' => 'Data pegawai berhasil diperbarui'
        ]);
    }

    public function destroy(Pegawai $pegawai) 
    {
        Gate::authorize('create', Pegawai::class);

        $pegawai->delete();
        return response()->json([
            'message' => 'Data pegawai berhasil dihapus'
        ]);
    }
}
