<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Http\Requests\Payroll\StoreRequest;
use App\Http\Requests\Payroll\UpdateRequest;
use App\Http\Resources\PayrollResource;
use Illuminate\Http\Request;

use App\Services\PayrollService;

class PayrollController extends Controller
{
    use ApiResponse;

    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function index(Request $request)
    {
        $data = $this->payrollService->getAllPayroll($request);
        return $this->success('Berhasil mengambil semuasdcds data payroll', PayrollResource::collection($data));
    }

    public function store(StoreRequest $request)
    {
        $data = $this->payrollService->createPayroll($request->all());
        return $this->success('Berhasil menambahkan data payroll', new PayrollResource($data), 201);
    }

    public function show(string $id)
    {
        $data = $this->payrollService->getPayrollById($id);
        return $this->success('Berhasil mengambil data payroll', new PayrollResource($data));
    }

    public function update(UpdateRequest $request, string $id)
    {
        $data = $this->payrollService->updatePayroll($id, $request->all());
        return $this->success('Berhasil mengubah data payroll', new PayrollResource($data));
    }

    public function destroy(string $id)
    {
        $this->payrollService->deletePayroll($id);
        return $this->success('Berhasil menghapus data payroll');
    }
}
