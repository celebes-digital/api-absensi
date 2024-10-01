<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ShiftKerjaController;
use App\Http\Controllers\UserController;

Route::post('login',            [AuthController::class, 'login']);
Route::post('password-reset',   [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum', 'isEmailVerify')->group(function () {
    Route::post('logout',               [AuthController::class, 'logout']);
    Route::get('kehadiran/get-kode',    [KehadiranController::class, 'generateKeyAbsensi']);

    Route::middleware('admin')->group(function () {
        Route::post('kehadiran/confirm',        [KehadiranController::class, 'confirmAbsensi']);
        Route::post('email/send-verification',  [EmailController::class, 'sendEmailVerification']);
        
        Route::apiResource('gaji',          GajiController::class);
        Route::apiResource('user',          UserController::class);
        Route::apiResource('pegawai',       PegawaiController::class);
        Route::apiResource('payroll',       PayrollController::class);
        Route::apiResource('kehadiran',     KehadiranController::class);
        Route::apiResource('shift',         ShiftKerjaController::class);
    });
});
