<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Traits\ApiResponse;

class EmailController extends Controller
{
    use ApiResponse;

    protected EmailService $emailService;

    public function __construct(EmailService $emailService) 
    {
        $this->emailService = $emailService;
    }

    public function sendEmailVerification(Request $request)
    {    
        $data = $request->validate([
            'email'     => 'required|email',
            'url'       => 'required|url',
        ]);

        $this->emailService->sendResetLink($data);
        return $this->success('Email verifikasi terkirim');
    }
}
