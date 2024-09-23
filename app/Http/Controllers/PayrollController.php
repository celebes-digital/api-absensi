<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        return Payroll::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_gaji' => 'required',
            'potongan' => 'required',
        ]);

        $data['periode'] = date('Y-m-d');

        return [
            'data' => Payroll::create($data)
        ];
    }

    public function show(string $id)
    {
        return Payroll::find($id);
    }

    public function update(Request $request, string $id)
    {
        return Payroll::find($id)->update($request->all());
    }

    public function destroy(string $id)
    {
        return Payroll::destroy($id);
    }
}
