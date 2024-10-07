<?php

namespace App\Services;

use App\Models\Shift;
use App\Traits\ApiResponse;

class ShiftService
{
    use ApiResponse;

    public function getAllShift($request) 
    {
        $shift = Shift::all();

        if($filter = $request->filter) {
            switch ($filter) {
            case 'arsip':
                $shift = $shift->where('status', 'Arsip');
                break;
            case 'all':
                $shift = $shift;
                break;
            default:
                $shift = $shift->where('status', 'Aktif');
                break;
            }
            
            return $shift;
        }

        $shift = $shift->where('status', 'Aktif');
        return $shift;
    }

    public function createShift($data) 
    {
        $shiftKerja = Shift::create($data);
        return $shiftKerja;
    }

    public function getShiftById($id) 
    {
        return Shift::findOrFail($id);
    }

    public function updateShift($data, $id) 
    {
        $shiftKerja = $this->getShiftById($id);
        $shiftKerja->update($data);
        return $shiftKerja;
    }

    public function deleteShift($id) 
    {
        $this->getShiftById($id);
        return Shift::destroy($id);
    }
}