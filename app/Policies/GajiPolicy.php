<?php

namespace App\Policies;

use App\Constant;

use App\Models\Gaji;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GajiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gaji $gaji): Response
    {
        return $user->is_admin || $user->id_user == $gaji->id_user 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gaji $gaji): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gaji $gaji): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gaji $gaji): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gaji $gaji): Response
    {
        return $user->is_admin 
                    ? Response::allow() 
                    : Response::deny(Constant::ERROR_MESSAGE_UNAUTHORIZED);
    }
}
