<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $request->validate([
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Kredensial tidak valid, masukkan email dan password yang benar'
            ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return [
            'data'  => $user,
            'token' => $token
        ];
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'  => 'required|min:6|confirmed',
            'email'     => 'required|email|exists:users,email',
            'token'     => 'required'
        ]);
        
        $dataResetToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        // Cek token valid dan email pada token sesuai dengan request email
        if(!$dataResetToken || $dataResetToken->email !== $request->email) {
            return response([
                'message' => 'Token tidak valid',
            ], 401);
        }

        $password = bcrypt($request->password);

        User::where('email', $request->email)->update([
            'password'          => $password,
            'is_email_verified' => true
        ]);

        return response()->json([
            'message' => 'Success to reset password'
        ]);
    }

    public function logout(Request $request) 
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'User berhasil logout'
        ]);
    }
}
