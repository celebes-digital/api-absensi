<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request) 
    {
        $data = $this->authService->login($request);
        return $this->success('Berhasil login', $data, 200);
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
