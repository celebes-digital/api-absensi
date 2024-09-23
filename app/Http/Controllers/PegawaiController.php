<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponse;

use App\Http\Requests\Pegawai\StoreRequest;
use App\Http\Requests\Pegawai\UpdateRequest;
use App\Http\Resources\PegawaiResource;

use App\Models\Pegawai;
use App\Services\PegawaiService;

class PegawaiController extends Controller
{
    use ApiResponse;

    protected $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    public function index()
    {
        Gate::authorize('viewAny', Pegawai::class);

        $data = $this->pegawaiService->getAllPegawai();
        return $this->success('Berhasil mengambil semua data pegawai', PegawaiResource::collection($data));
    }

    public function store(StoreRequest $request)
    {
        Gate::authorize('create', Pegawai::class);

        $data = $this->pegawaiService->createPegawai($request->validated());
        return $this->success('Berhasil menambahkan data pegawai', new PegawaiResource($data), 201);
    }

    public function show(String $id) 
    {
        Gate::authorize('view', [Pegawai::class, $id]);

        $data = $this->pegawaiService->getPegawaiById($id);
        return $this->success('Berhasil mengambil data pegawai', new PegawaiResource($data));
    }

    public function update(UpdateRequest $request, Pegawai $pegawai) 
    {
        Gate::authorize('update', Pegawai::class);

        $data = $this->pegawaiService->updatePegawai($pegawai, $request->validated());
        return $this->success('Berhasil mengubah data pegawai', new PegawaiResource($data));
    }

    public function destroy(int $id)
    {
        Gate::authorize('delete', Pegawai::class);
        
        $this->pegawaiService->deletePegawai($id);
        return $this->success('Berhasil menghapus data pegawai', null, 204);
    }
}
