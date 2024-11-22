<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PlanoController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Middleware\CheckIfUserOwnPlan;
use App\Http\Middleware\CheckIfUserIsAdmin;
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
    Route::middleware([CheckIfUserIsAdmin::class])->group(function () {
        Route::get('/periodos', [PeriodoController::class, 'periodos'])->name('periodos');
        Route::post('/periodos/create', [PeriodoController::class, 'periodoCreate'])->name('periodos.create');
        Route::get('/planos/{semestre?}', [PlanoController::class, 'listaPlanos'])->name('planos');
        Route::get('/planos/revisao/{plano_id}', [PlanoController::class, 'planoRevisar'])->name('planos.revisar');
        Route::post('/planos/revisao/{plano_id}/reprovar', [PlanoController::class, 'planoReprovar'])->name('plano.reprovar');
        Route::post('/planos/revisao/{plano_id}/aprovar', [PlanoController::class, 'planoAprovar'])->name('plano.aprovar');
    });

    Route::get('/meusPlanos', [PlanoController::class, 'meusPlanos'])->name('meusPlanos');
    Route::middleware([CheckIfUserOwnPlan::class])->group(function () {
        Route::get('/meusPlanos/preencher/{plano_id}', [PlanoController::class, 'preencher'])->name('preencher');
        Route::post('/meusPlanos/preencher/{plano_id}/create', [PlanoController::class, 'create'])->name('plano.create');
        Route::post('/meusPlanos/preencher/{plano_id}/submit', [PlanoController::class, 'create'])->name('plano.submitForReview');

        Route::get('/meusPlanos/visualizar/{plano_id}', [PlanoController::class, 'viewPlano'])->name('plano.view');
    });

});

