<?php

use App\Http\Controllers\FetchApi;
use App\Http\Controllers\ProdukController;
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

Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id_produk}', [ProdukController::class, 'destroy'])->name('produk.delete');
Route::patch('/produk/{id_produk}', [ProdukController::class, 'update'])->name('produk.update');

Route::get('/fetch-api', [FetchApi::class, 'fetchApi']);
