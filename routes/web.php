<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\orderitemController;



Route::get('/', function () {
    return redirect()->route('user.index');
});



//products

Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('product/add/{id}', [ProductController::class, 'add'])->name('product.add');
Route::post('product/aftercreate', [ProductController::class, 'aftercreate'])->name('product.aftercreate');
Route::post('/product/filterProducts', [ProductController::class, 'filterProducts'])->name('filter.filterProducts');
Route::get('/product/getfilter', [ProductController::class, 'getfilter'])->name('activities.getfilter');
Route::post('/product/findProducts', [ProductController::class, 'findProducts'])->name('product.find');
Route::get('/product/buy/{id}', [ProductController::class, 'buy'])->name('product.buy');



//orderitem
Route::get('/orderitem/panier', [orderitemController::class, 'panier'])->name('orderitem.panier');
Route::delete('/orderitem/{id}', [OrderItemController::class, 'delete'])->name('orderitem.delete');


//order
Route::post('/order/confirm/{id}', [orderController::class, 'confirm'])->name('order.confirm');

//USER



Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/insc', [UserController::class, 'insc'])->name('user.insc');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('/user/afterlogin', [UserController::class, 'afterlogin'])->name('users.afterlogin');
