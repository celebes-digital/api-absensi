<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password'  => 'required|min:6|confirmed',
            'email'     => 'required|email|exists:users,email',
            'token'     => 'required'
        ];
    }
}
