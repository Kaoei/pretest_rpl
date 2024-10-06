<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('index');
});


//routes buku
Route::get('/buku',[BookController::class,'getBooks']);
Route::post('/buku/create',[BookController::class,'createBook']);
Route::delete('/buku/delete/{id}',[BookController::class,'deleteBook']);
Route::put('/buku/update/{id}',[BookController::class,'updateBook']);

//routes peminjaman
Route::get('/peminjaman',[PeminjamanController::class,'getPeminjaman']);
Route::post('/peminjaman/create',[PeminjamanController::class,'createPeminjaman']);
Route::delete('/peminjaman/delete/{id}',[PeminjamanController::class,'deletePeminjaman']);
Route::put('/peminjaman/update/{id}',[PeminjamanController::class,'updatePeminjaman']);