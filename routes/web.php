<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/author', [AuthorController::class, 'index'])->name('author.list');
Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
Route::post('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('author.delete');
