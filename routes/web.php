<?php

use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\GraficosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware('check_user_status')->group(function () {
        Route::resource('/reportes', ReportesController::class)->names('reportes');
        Route::resource('/coordinador', CoordinadorController::class)->names('coordinador');
        Route::resource('/personals', PersonalsController::class)->names('personals');
        Route::get('/admin', adminController::class)->name('admin');
        Route::post('/addcomercio', [ReportesController::class, 'addcomercio'])->name('addcomercio');
        Route::get('/busqueda', [DireccionesController::class, 'index'])->name('busqueda');
        Route::prefix('informes')->group(function () {
            Route::get('/ConteoDia', [GraficosController::class, 'ConteoRegistrosxDia'])->name('ConteoDia');
            Route::get('/filtro', [GraficosController::class, 'ReportesFilter']);
            Route::get('/General', [GraficosController::class, 'ReportesTotalesxmes'])->name('General');
        });
    });
});
