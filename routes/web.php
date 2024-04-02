<?php

use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\InformesController;
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
        Route::resource('/informes', InformesController::class)->names('informes');
        Route::get('/admin', adminController::class)->name('admin');
        Route::post('/addcomercio', [ReportesController::class, 'addcomercio'])->name('addcomercio');
    });
});
