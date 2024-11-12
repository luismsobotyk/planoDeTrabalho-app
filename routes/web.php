<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PlanoController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// auth routes
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [MainController::class, 'index']);

    //Check Authorization
    Route::get('/periodos', [PeriodoController::class, 'periodos'])->name('periodos');
    Route::post('/periodos/create', [PeriodoController::class, 'periodoCreate'])->name('periodos.create');

    Route::get('/meusPlanos', [PlanoController::class, 'meusPlanos'])->name('meusPlanos');
    Route::get('/preencher/{plano_id}', [PlanoController::class, 'preencher'])->name('preencher');
});

