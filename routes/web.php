<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('home');
});

// 2. Các route CRUD cho Quản lý Danh mục
Route::resource('category', CategoryController::class);