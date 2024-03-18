<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

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



Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/getData', [StoreController::class, 'getData'])->name('stores.getData');
Route::get('/stores/{store?}/edit', [StoreController::class, 'createOrEdit'])->name('stores.create_edit');
Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
