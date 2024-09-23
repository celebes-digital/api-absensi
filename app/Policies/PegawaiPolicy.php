<?php

namespace App\Policies;

use Constant;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PegawaiPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    public function view(User $user, Pegawai $pegawai)
    {
        return $user->id_user == $pegawai->id_user;
    }

    public function create(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function update(User $user, Pegawai $pegawai): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function delete(User $user, Pegawai $pegawai): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function restore(User $user, Pegawai $pegawai): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function forceDelete(User $user, Pegawai $pegawai): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }
}
