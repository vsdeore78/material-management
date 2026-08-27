<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTransactionController;

Route::get('/', function () {
    return redirect()->route('materials.index');
});

Route::resource('categories', CategoryController::class);
Route::resource('materials', MaterialController::class);
Route::resource('transactions', MaterialTransactionController::class);