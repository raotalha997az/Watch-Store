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
Route::get('/stores/edit', [StoreController::class, 'createOrEdit'])->name('stores.create_edit');
Route::get('/cities/getData', [StoreController::class, 'getCityData'])->name('cities.getData');
Route::get('/landmarks/getData', [StoreController::class, 'getLandMark'])->name('landmarks.getData');
Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');

Route::post('/stores/area', [StoreController::class, 'storeArea'])->name('stores.area');
Route::delete('/stores/area', [StoreController::class, 'storeDelete'])->name('stores.delete');


