<?php

namespace App\Services;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public function resetPassword(ResetPasswordRequest $request) {
        $dataResetToken = DB::table('password_reset_tokens')
                            ->where('token', $request->token)
                            ->firstOrFail();

        // Cek token valid dan email pada token sesuai dengan request email
        if(!$dataResetToken || $dataResetToken->email !== $request->email) {
            return response([
                'message' => 'Token tidak valid',
            ], 401);
        }

        $password = bcrypt($request->password);

        $user = User::where('email', $request->email)->update([
            'password'          => $password,
            'is_email_verified' => true
        ]);

        return $user;
    }
}