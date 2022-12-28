<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductsController::class)->prefix('products')->name('products.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('{id}', 'show')->name('show');

    Route::get('create/product', 'create')->name('create');
    Route::post('store', 'store')->name('store');

    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    
    Route::get('{id}/destroy', 'destroy')->name('destroy');
});