<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/inicio', [DocumentosController::class,'inicio'])->middleware(['auth'])->name('inicio');
Route::get('/documentos', [DocumentosController::class,'create'])->middleware(['auth'])->name('documentos');
Route::get('/informacoes', [DocumentosController::class,'createInformacoes'])->middleware(['auth'])->name('informacoes');
Route::get('/dashboard', [DocumentosController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/completos', [DocumentosController::class,'completos'])->middleware(['auth'])->name('completos');
Route::get('/incompletos', [DocumentosController::class,'incompletos'])->middleware(['auth'])->name('incompletos');

require __DIR__.'/auth.php';

Route::post('/upload', [DocumentosController::class, 'store']);

Route::post('/salvar-informacoes', [DocumentosController::class, 'salvarInformacoes']);

Route::put('/editar-informacoes/{id}', [DocumentosController::class, 'editarInformacoes']);

Route::get('export', [DocumentosController::class,'export'])->name('export');

Route::delete('documento-delete/{id}', [DocumentosController::class, 'destroy']);
