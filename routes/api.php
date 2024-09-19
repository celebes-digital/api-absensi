<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ShiftKerjaController;
use Illuminate\Support\Facades\Route;

Route::post('login',            [AuthController::class, 'login']);
Route::post('logout',           [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('password-reset',   [AuthController::class, 'resetPassword']);

Route::post('send-verification', [EmailController::class, 'sendEmailVerification']);

Route::apiResource('pegawai',   PegawaiController::class);
Route::apiResource('shift',     ShiftKerjaController::class);

Route::get('kehadiran/get-kode-absensi', [KehadiranController::class, 'generateKeyAbsensi'])->middleware('auth:sanctum');
Route::post('kehadiran/confirm-absensi', [KehadiranController::class, 'confirmAbsensi'])->middleware('auth:sanctum');
