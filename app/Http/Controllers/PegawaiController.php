<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponse;

use App\Http\Requests\Pegawai\StoreRequest;
use App\Http\Requests\Pegawai\UpdateRequest;
use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use App\Models\User;

class PegawaiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        Gate::authorize('viewAny', Pegawai::class);
        $data = Pegawai::all();

        return $this->success('Berhasil mengambil semua data pegawai', PegawaiResource::collection($data));
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

        return $this->success('Berhasil menambahkan data pegawai', new PegawaiResource($data), 201);
    }

    public function show(Pegawai $pegawai) 
    {
        Gate::authorize('view', $pegawai);
        return $this->success('Berhasil mengambil data pegawai', new PegawaiResource($pegawai));
    }

    public function update(UpdateRequest $request, Pegawai $pegawai) 
    {
        Gate::authorize('update', Pegawai::class);

        $data = $request->validated();
        $pegawai->update($data);

        return $this->success('Berhasil mengubah data pegawai', new PegawaiResource($data));
    }

    public function destroy(Pegawai $pegawai) 
    {
        Gate::authorize('delete', Pegawai::class);

        $pegawai->delete(); 
        return $this->success('Berhasil menghapus data pegawai');
    }
}
