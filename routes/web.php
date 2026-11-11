<?php
use App\Http\Controllers\AppController as C;
use App\Http\Middleware\KeyAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [C::class, 'home']);
Route::post('/kirim', [C::class, 'store']);
Route::get('/admin/login', fn () => view('login'));
Route::post('/admin/login', [C::class, 'login']);
Route::middleware(KeyAuth::class)->prefix('admin')->group(function () {
    Route::get('/', [C::class, 'dashboard']);
    Route::post('/tambah', [C::class, 'store']);
    Route::delete('/{id}', [C::class, 'destroy']);
    Route::post('/logout', [C::class, 'logout']);
});
