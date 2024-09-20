<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gaji\StoreRequest;
use App\Http\Requests\Gaji\UpdateRequest;
use App\Models\Gaji;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        return Gaji::all();
    }

    public function store(StoreRequest $request)
    {
        return Gaji::create($request->all());
    }
    
    public function show(Gaji $gaji)
    {
        return $gaji;
    }

    public function update(UpdateRequest $request, String $id)
    {
        Gaji::find($id)->update($request->all());
        $gaji = Gaji::find($id);
        return [
            'gaji' => $gaji,
            'data'  => request()->all()
        ];
    }
    
    public function destroy(String $id)
    {
        Gaji::findOrFail($id)->delete();
        return ['message' => 'data deleted' ];
    }
}
