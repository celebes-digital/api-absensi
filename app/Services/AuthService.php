<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService 
{
    public function login($request)
    {
        $user = $this->findUserByEmail($request->email);
        $this->checkPassword($user, $request->password);

        $token = $user->createToken($request->email)->plainTextToken;
        $data = [
            'user'  => $user,
            'token' => $token
        ];

        return $data;
    }

    public function resetPassword(ResetPasswordRequest $request) {
        $dataResetToken = DB::table('password_reset_tokens')
                            ->where('token', $request->token)
                            ->first();

        if(!$dataResetToken || $dataResetToken->email !== $request->email) {
            throw new BadRequestHttpException('Token tidak valid');
        }

        $password = bcrypt($request->password);

        $user = $this->findUserByEmail($request->email);
        $user->update([
            'password'          => $password,
            'is_email_verified' => true
        ]);

        return $user;
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
    }
    
    protected function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    protected function checkPassword($user, $password) 
    {
        if (! $user || ! Hash::check($password, $user->password)) {
            throw new UnauthorizedHttpException('' ,'Kredensial tidak valid, masukkan email dan password yang benar');
        }
    }
}