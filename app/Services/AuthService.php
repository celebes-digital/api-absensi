<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService 
{
    public function checkPassword($user, $password) 
    {
        if (! $user || ! Hash::check($password, $user->password)) {
            throw new UnauthorizedHttpException('' ,'Kredensial tidak valid, masukkan email dan password yang benar');
        }
    }

    public function login($request)
    {
        $user = User::where('email', $request->email)->first();
        $this->checkPassword($user, $request->password);

        $token = $user->createToken($request->email)->plainTextToken;
        $data = [
            'user'  => $user,
            'token' => $token
        ];

        return $data;
    }
}