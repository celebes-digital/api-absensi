<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;

use App\Http\Requests\Shift\StoreRequest;
use App\Http\Requests\Shift\UpdateRequest;
use App\Http\Resources\ShiftKerjaResource;

use App\Services\ShiftKerjaService;
use Illuminate\Http\Request;

class ShiftKerjaController extends Controller
{
    use ApiResponse;

    protected ShiftKerjaService $shiftKerjaService;

    public function __construct(ShiftKerjaService $shiftKerjaService) {
        $this->shiftKerjaService = $shiftKerjaService;
    }

    public function getShiftKerja() 
    {
        $data = $this->shiftKerjaService->getShiftKerjaByUser();
        return $this->success('Berhasil mengambil semua data shift kerja', ShiftKerjaResource::collection($data));
    }


    public function index(Request $request)
    {
        $data = $this->shiftKerjaService->getAllShiftKerja($request);
        return $this->success('Berhasil mengambil semua data shift kerja', ShiftKerjaResource::collection($data));
    }
    
    public function store(StoreRequest $request)
    {
        $data = $this->shiftKerjaService->createShiftKerja($request->validated());
        return $this->success('Berhasil menambahkan data shift kerja', new ShiftKerjaResource($data), 201);
    }
    
    public function show(string $id)
    {
        $shift = $this->shiftKerjaService->getShiftKerjaById($id);
        return $this->success('Berhasil mengambil data shift kerja', new ShiftKerjaResource($shift));
    }
    
    public function update(UpdateRequest $request, string $id)
    {
        $data = $this->shiftKerjaService->updateShiftKerja($request->validated(), $id);
        return $this->success('Berhasil mengubah data shift kerja', new ShiftKerjaResource($data));
    }
    
    public function destroy(string $id)
    {
        $this->shiftKerjaService->deleteShiftKerja($id);
        return $this->success('Berhasil menghapus data shift kerja', null, 200);
    }
}
