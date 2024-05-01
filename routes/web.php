<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');
Route::get('main/transaksi', [MainController::class, 'transaksi'])->name('main.transaksi');
Route::resource('main', 'MainController')->except(['show']);
Route::get('main/{main}', [MainController::class, 'show'])->name('main.show');  