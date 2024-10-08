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
Route::get('/product/indexadmin', [ProductController::class, 'indexadmin'])->name('product.indexadmin');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('product/add/{id}', [ProductController::class, 'add'])->name('product.add');
Route::post('product/aftercreate', [ProductController::class, 'aftercreate'])->name('product.aftercreate');
Route::post('/product/filterProducts', [ProductController::class, 'filterProducts'])->name('filter.filterProducts');
Route::get('/product/getfilter', [ProductController::class, 'getfilter'])->name('activities.getfilter');
Route::post('/product/findProducts', [ProductController::class, 'findProducts'])->name('product.find');
Route::get('/product/buy/{id}', [ProductController::class, 'buy'])->name('product.buy');
Route::get('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::put('/product/update/{id}', [ProductController::class, 'afterupdate'])->name('product.afterupdate');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
//orderitem
Route::get('/orderitem/panier', [orderitemController::class, 'panier'])->name('orderitem.panier');
Route::delete('/orderitem/{id}', [OrderItemController::class, 'delete'])->name('orderitem.delete');
Route::get('/orderitem/confirmed', [orderitemController::class, 'confirmed'])->name('orderitem.confirmed');
Route::get('/orderitem/history', [orderitemController::class, 'history'])->name('orderitem.history');

//order
Route::post('/order/confirm/{id}', [orderController::class, 'confirm'])->name('order.confirm');

//USER



Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/insc', [UserController::class, 'insc'])->name('user.insc');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('/user/afterlogin', [UserController::class, 'afterlogin'])->name('users.afterlogin');

Route::get('/user/profil', [UserController::class, 'profil'])->name('user.profil');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
route::get('/disconnect', [UserController::class, 'disconnect'])->name('user.disconnect');