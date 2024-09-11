<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return redirect()->route('user.index');
});



//products

Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('product/add/{id}', [ProductController::class, 'add'])->name('product.add');
Route::post('product/aftercreate', [ProductController::class, 'aftercreate'])->name('product.aftercreate');


//USER


Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/insc', [UserController::class, 'insc'])->name('user.insc');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('/user/afterlogin', [UserController::class, 'afterlogin'])->name('users.afterlogin');
