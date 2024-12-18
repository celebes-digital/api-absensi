<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalPegawaiController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftKerjaController;

Route::post('login',            [AuthController::class, 'login']);
Route::post('password-reset',   [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum', 'isEmailVerify')->group(function () {
    Route::post('logout',               [AuthController::class,         'logout']);
    Route::get('user/payroll',          [PayrollController::class,      'getPayroll']);
    Route::get('user/shift',            [ShiftKerjaController::class,   'getShiftKerja']);
    Route::get('user/kehadiran',        [KehadiranController::class,    'getKehadiran']);

    Route::get('kehadiran/masuk/get-kode',      [KehadiranController::class, 'generateKeyAbsensiMasuk']);
    Route::get('kehadiran/keluar/get-kode',     [KehadiranController::class, 'generateKeyAbsensiKeluar']);

    Route::apiResource('user',          UserController::class);

    Route::middleware('admin')->group(function () {
        Route::post('kehadiran/masuk/confirm',  [KehadiranController::class,    'confirmAbsensiMasuk']);
        Route::post('kehadiran/keluar/confirm', [KehadiranController::class,    'confirmAbsensiKeluar']);
        Route::post('email/send-verification',  [EmailController::class,        'sendEmailVerification']);
        Route::put('jadwal/pegawai',            [JadwalPegawaiController::class,'updateJadwalPegawai']);
        Route::get('jadwal/pegawai',            [JadwalPegawaiController::class,'getJadwalPegawai']);
        
        Route::apiResource('gaji',          GajiController::class);
        Route::apiResource('pegawai',       PegawaiController::class);
        Route::apiResource('payroll',       PayrollController::class);
        Route::apiResource('kehadiran',     KehadiranController::class);
        Route::apiResource('shift',         ShiftController::class);
        Route::apiResource('jadwal',        JadwalController::class);
    });
});
