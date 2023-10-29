<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', [IndexController::class,'index'])->name('admin');

Route::get('product/all',[ProductController::class,'alldata'])->name('Product.all');

Route::group(['as'=>'dashboard.'],function(){
    Route::get('settings',[SettingController::class,'index'])->name('settings.index');

    Route::put('settings/{setting}/update',[SettingController::class , 'update'])->name('settings.update');
    Route::get('categories/ajax',[CategoryController::class , 'getall'])->name('categories.getall');
    Route::delete('categories/delete',[CategoryController::class,'delete'])->name('categories.delete');
    Route::resource('products',ProductController::class);



    Route::resource('categories',CategoryController::class);
});





