<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PresentsController;
use Illuminate\Http\Request;
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
Route::middleware(['auth:sanctum', 'verified'])->get('/present/delete/{present}',
    [PresentsController::class, 'deletePresent'])->name('presents.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/present/release/{present}',
    [PresentsController::class, 'releasePresent'])->name('presents.release');
Route::middleware(['auth:sanctum', 'verified'])->get('/present/draft/{present}',
    [PresentsController::class, 'draftPresent'])->name('presents.draft');
Route::middleware(['auth:sanctum', 'verified'])->get('/present/create',
    [PresentsController::class, 'createPresent'])->name('presents.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/present/edit/{present}',
    [PresentsController::class, 'editPresent'])->name('presents.edit');
Route::get('/present/details/{present}',
    [PresentsController::class, 'detailsPresent'])->name('presents.details');
Route::get('/present/share/{present}',
    [PresentsController::class, 'selectPresent'])->name('presents.share');
Route::post('/present/resetuser',
    [PresentsController::class, 'resetUserPresent'])->name('presents.resetUser');
Route::middleware(['auth:sanctum', 'verified'])->post('/present/reset/{present}',
    [PresentsController::class, 'resetPresent'])->name('presents.reset');
Route::middleware(['auth:sanctum', 'verified'])->post('/present/save/{present}',
    [PresentsController::class, 'savePresent'])->name('presents.save');
Route::middleware(['auth:sanctum', 'verified'])->post('/present/create',
    [PresentsController::class, 'storePresent'])->name('presents.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/present/list',
    [PresentsController::class, 'presentManagement'])->name('presents.management');
Route::middleware(['auth:sanctum', 'verified'])
    ->post('/uploadFile', [FileController::class, 'uploadFile'])->name('uploadFile');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
