<?php

namespace App\Policies;

use App\Constant;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class PegawaiPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function view(User $user, int $id): Response
    {
        return $user->id_user == $id || $user->is_admin ?
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function create(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function update(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function delete(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function restore(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function forceDelete(User $user): Response
    {
        return $user->is_admin ? 
                    Response::allow() : 
                    Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }
}
