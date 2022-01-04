<?php

use App\Http\Controllers\PresentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PresentsController::class,'show'])->name('presents.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/present/create',
    [PresentsController::class, 'createPresent'])->name('presents.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/present/create',
    [PresentsController::class, 'storePresent'])->name('presents.store');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
