<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shift\StoreRequest;
use App\Http\Requests\Shift\UpdateRequest;
use App\Models\ShiftKerja;
use Illuminate\Http\Request;

class ShiftKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShiftKerja::all()->load('pegawai');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return ShiftKerja::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ShiftKerja::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $shift = ShiftKerja::find($id);
        $shift->update($request->all());
        
        return $shift;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ShiftKerja::destroy($id);
    }
}
