<?php

namespace App\Services;

use App\Mail\SendEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use ErrorException;
use Exception;
use Illuminate\Support\Facades\DB;

class EmailService
{
    public function sendResetLink($request)
    {
        $user = $this->findUserByEmail($request['email']);
        if (!$user) {
            throw new BadRequestHttpException('Email belum terdaftar');
        }

        $token = $this->getOrCreateToken($request['email']);
        $data = [
            'email' => $request['email'],
            'url'   => $request['url'],
            'token' => $token
        ];
        
        try {
            $this->sendResetEmail($request['email'], $data);

            return true;
        } catch (Exception $e) {
            throw new ErrorException('Gagal mengirim email verifikasi, ' . $e->getMessage());
        }
    }

    private function sendResetEmail($email, $data)
    {
        Mail::to($email)->send(new SendEmailVerification($data));
    }
    
    protected function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    private function getOrCreateToken($email)
    {
        $resetToken = DB::table('password_reset_tokens')
                        ->where('email', $email)
                        ->first();

        if (!$resetToken) {
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token
            ]);
            return $token;
        }

        return $resetToken->token;
    }
}