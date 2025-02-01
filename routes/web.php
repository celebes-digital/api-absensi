<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kehadiran/export', [\App\Http\Controllers\KehadiranController::class, 'export']);
