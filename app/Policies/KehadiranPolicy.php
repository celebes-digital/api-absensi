<?php

namespace App\Policies;

use App\Constant;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class KehadiranPolicy
{
    public function viewAny(User $user): void
    {
        //
    }

    public function view(User $user): void
    {
        //
    }
    
    public function create(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function update(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function delete(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function restore(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    public function forceDelete(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);        
    }
}
