<?php

namespace App\Http\Requests\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_jadwal'       => 'required|string|max:50',
            'is_default'        => 'boolean',
            'jadwal.*.id_shift' => 'required',
            'jadwal.*.hari'     => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hariArray = array_column($this->input('jadwal'), 'hari');
            
            if (count($hariArray) !== count(array_unique($hariArray))) {
                $validator->errors()->add('jadwalshift', 'Hari tidak boleh duplikat.');
            }
        });
    }
}
