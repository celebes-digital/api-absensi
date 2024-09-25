<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gaji\StoreRequest;
use App\Http\Requests\Gaji\UpdateRequest;
use App\Http\Resources\GajiResource;
use App\Models\Gaji;
use App\Services\GajiService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    use ApiResponse;

    protected $gajiService;

    public function __construct(GajiService $gajiService)
    {
        $this->gajiService = $gajiService;
    }

    public function index()
    {
        $data = $this->gajiService->getAllGaji();
        return $this->success('Berhasil mengambil semua data gaji', GajiResource::collection($data));
    }

    public function store(StoreRequest $request)
    {
        $data = $this->gajiService->createGaji($request->all());
        return $this->success('Berhasil menambahkan data gaji', new GajiResource($data), 201);
    }
    
    public function show($id)
    {
        $data = $this->gajiService->getGajiById($id);
        return $this->success('Berhasil mengambil data gaji', new GajiResource($data));
    }

    public function update(UpdateRequest $request, String $id)
    {
        $data = $this->gajiService->updateGaji($request->all(), $id);
        return $this->success('Berhasil mengubah data gaji', new GajiResource($data));
    }
    
    public function destroy(String $id)
    {
        $this->gajiService->deleteGaji($id);
        return $this->success('Berhasil menghapus data gaji');
    }
}
