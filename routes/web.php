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

Route::get('/documentos', [DocumentosController::class,'create'])->middleware(['auth'])->name('documentos');
Route::get('/incompletos', [DocumentosController::class,'incompletos'])->middleware(['auth'])->name('incompletos');
Route::get('/completos', [DocumentosController::class,'completos'])->middleware(['auth'])->name('completos');
Route::get('/dashboard', [DocumentosController::class,'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/upload', [DocumentosController::class, 'store']);

Route::delete('documento-delete/{id}', [DocumentosController::class, 'destroy']);
