<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CopyController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/ingredientes', [HomeController::class, 'ingredientes'])->name('ingredientes');
Route::post('/ingredientes', [HomeController::class, 'ingredientesAcao'])->name('ingredientesAcao');

Route::get('/copy', [CopyController::class, 'index'])->name('copy');
Route::post('/copy', [CopyController::class, 'copyAcao'])->name('copyAcao');
