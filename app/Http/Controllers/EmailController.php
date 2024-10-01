<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailVerification;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use App\Traits\ApiResponse;
use Exception;

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

        $this->emailService->sendResetLink($request);
        return $this->success(['message' => 'Email verifikasi terkirim']);
    }
}
