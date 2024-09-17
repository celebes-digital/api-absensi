<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailVerification;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

class EmailController extends Controller
{
    public function sendEmailVerification(Request $request)
    {    
        $data = $request->validate([
            'email'     => 'required|email',
            'url'       => 'required|url',
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response([
                    'message' => 'Email tidak terdaftar'
                ], 400);
            }

            
            $dataPasswordResetToken = DB::select('SELECT email, token FROM password_reset_tokens WHERE email = ?', [$request->email]);
            
            
            if(!$dataPasswordResetToken) {
                $token          = Str::random(64);
                DB::insert(
                    'INSERT INTO password_reset_tokens (email, token) VALUES (?, ?)',
                    [$request->email, $token]
                );
            } else {
                $token = $dataPasswordResetToken[0]->token;
            }
            $data['token']  = $token;
            Mail::to($request->email)->send(new SendEmailVerification($data));

            return response()->json([
                'message' => 'Success to send email verifikasi',
            ]);
        } catch (Exception $e) {
            return response([
                'message'   => 'Gagal mengirim email verifikasi',
                'error'     => $e->getMessage()
            ], 500);
        }

    }
}
