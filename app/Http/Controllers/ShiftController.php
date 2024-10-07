<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shift\StoreRequest;
use App\Http\Requests\Shift\UpdateRequest;
use App\Traits\ApiResponse;

use App\Services\ShiftService;
use Illuminate\Http\Request;
use App\Http\Resources\ShiftResource;


class ShiftController extends Controller
{
    use ApiResponse;

    protected ShiftService $shiftService;

    public function __construct(ShiftService $shiftService) 
    {
        $this->shiftService = $shiftService;
    }

    public function index(Request $request)
    {
        $data = $this->shiftService->getAllShift($request);
        return $this->success('Berhasil mengambil semua data shift', ShiftResource::collection($data));
    }
    
    public function store(StoreRequest $request)
    {
        $data = $this->shiftService->createShift($request->validated());
        return $this->success('Berhasil menambahkan data shift', new ShiftResource($data), 201);
    }
    
    public function show(string $id)
    {
        $shift = $this->shiftService->getShiftById($id);
        return $this->success('Berhasil mengambil data shift', new ShiftResource($shift));
    }
    
    public function update(UpdateRequest $request, string $id)
    {
        $data = $this->shiftService->updateShift($request->validated(), $id);
        return $this->success('Berhasil mengubah data shift', new ShiftResource($data));
    }
    
    public function destroy(string $id)
    {
        $this->shiftService->deleteShift($id);
        return $this->success('Berhasil menghapus data shift', null, 200);
    }
}
