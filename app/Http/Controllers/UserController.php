<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $data = User::find(Auth::user()->id_user);
        $data->load('pegawai');

        return $this->success('Berhasil mengambil data user', new UserResource($data));
    }
}
