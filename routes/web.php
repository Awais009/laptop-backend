<?php

use App\Livewire\Category\Categories;
use App\Livewire\Dashboard;
use App\Livewire\ManageHome;
use App\Livewire\Navigation\Navigations;
use App\Livewire\Order\Invoice;
use App\Livewire\Order\OrderDetail;
use App\Livewire\Order\OrderList;
use App\Livewire\Products\AddProduct;
use App\Livewire\Products\ProductList;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('home');
Route::get('/product-list', ProductList::class)->name('product.list');
Route::get('/add-product', AddProduct::class)->name('product.add');
Route::get('/order-list', OrderList::class)->name('order.list');
Route::get('/order-detail/{id}', OrderDetail::class)->name('order.detail');
Route::get('/navigation', Navigations::class)->name('navigation');
Route::get('/filter', Categories::class)->name('category');
Route::get('/invoice/{id}', Invoice::class)->name('invoice');
Route::get('/manage-home', ManageHome::class)->name('manage.home');


