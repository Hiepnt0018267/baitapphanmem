<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController; // Nhúng thêm ProductController

Route::get('/', function () {
    return view('home');
});

// Các route CRUD cho Quản lý Danh mục
Route::resource('category', CategoryController::class);

// Các route CRUD cho Quản lý Sản phẩm
Route::resource('product', ProductController::class);