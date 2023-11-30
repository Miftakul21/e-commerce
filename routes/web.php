<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailPesananController;


// Route Login & Register User
Route::get('/', [AdminController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::post('/register', [AdminController::class, 'store']);
Route::post('/authlogin', [AdminController::class, 'authlogin'])->name('auth');
Route::post('/logout', [AdminController::class, 'logout']);
Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard-admin')->middleware('auth');
// Route User
Route::get('/home', [UserController::class, 'index'])->name('home'); // ->middleware('auth');
Route::get('/list-product', [UserController::class, 'product']);
Route::get('/pesanan', [UserController::class, 'pesanan']);
Route::get('/detail-product/{kd}', [DetailPesananController::class, 'detail_product']);
Route::get('/product-category/{id}', [UserController::class, 'product_kategori']);
Route::get('/settings', [UserController::class, 'settings'])->middleware('auth');
// Route Pesanan
Route::post('/pesan', [PesananController::class, 'pesan_product']);
Route::get('/checkout', [PesananController::class, 'checkout']);
Route::post('/checkout', [PesananController::class, 'store_checkout']);
Route::get('/total_pesanan', [PesananController::class, 'total_pesanan']);
// Route Region
Route::get('/provinces', [RegionController::class, 'provinces']);
Route::get('/cities/{id}', [RegionController::class, 'cities']);
Route::post('/ongkir', [RegionController::class, 'ongkir_pengiriman']);
// Route Category
Route::get('/category', [CategoryController::class, 'index'])->name('category')->middleware('auth');
Route::post('/category', [CategoryController::class, 'store']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);
Route::patch('/category/{id}', [CategoryController::class, 'update']);
Route::get('/delete/image/category/{id}', [CategoryController::class, 'delete_image']);
Route::get('/add-category', [CategoryController::class, 'create'])->name('create_category');
Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
// Route Iklan
Route::get('/iklan', [IklanController::class, 'index'])->name('iklan')->middleware('auth');
Route::post('/iklan', [IklanController::class, 'store']);
Route::delete('/iklan/{id}', [IklanController::class, 'delete']);
Route::patch('/iklan/{id}', [IklanController::class, 'update']);
Route::get('/delete/image/iklan/{id}', [IklanController::class, 'delete_image']);
Route::get('/add-iklan', [IklanController::class, 'create'])->name('create_iklan');
Route::get('/edit-iklan/{id}', [IklanController::class, 'edit'])->name('edit-iklan');
// Route Product
Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('auth');
Route::post('/product', [ProductController::class, 'store']);
Route::delete('/product/{id}', [ProductController::class, 'delete']);
Route::patch('/product/{id}', [ProductController::class, 'update']);
Route::get('/delete/image/product/{id}', [ProductController::class, 'delete_image']);
Route::get('/add-product', [ProductController::class, 'create'])->name('create_product');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');