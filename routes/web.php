<?php

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

Route::prefix('shops')->group(function () {

    Route::get('','ShopController@index')->name('shop.index');
    Route::get('create', 'ShopController@create')->name('shop.create');
    Route::post('store', 'ShopController@store')->name('shop.store');
    Route::get('edit/{shop}', 'ShopController@edit')->name('shop.edit');
    Route::post('update/{shop}', 'ShopController@update')->name('shop.update');
    Route::post('delete/{shop}', 'ShopController@destroy' )->name('shop.destroy');
    Route::get('show/{shop}', 'ShopController@show')->name('shop.show');
    Route::get('search','ShopController@search')->name('shop.search');
    // Route::get('filter','ShopController@filter')->name('shop.filter')->middleware('auth');
    // Route::get('/pdf','ShopController@generatePDF')->name('shop.pdf')->middleware('auth');
    // Route::get('pdfShop/{shop}','ShopController@generateShopPDF')->name('shop.pdfshop')->middleware('auth');
    // Route::get('generateStatistics','ShopController@generateStatisticsPDF')->name('shop.generatestatistics')->middleware('auth');

});

Route::prefix('products')->group(function () {

    Route::get('','ProductController@index')->name('product.index');
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('update/{product}', 'ProductController@update')->name('product.update');
    Route::post('delete/{product}', 'ProductController@destroy' )->name('product.destroy');
    Route::get('show/{product}', 'ProductController@show')->name('product.show');
    Route::get('search','ProductController@search')->name('product.search');
    // Route::get('filter','ProductController@filter')->name('product.filter')->middleware('auth');
    // Route::get('/pdf','ProductController@generatePDF')->name('product.pdf')->middleware('auth');
    // Route::get('pdfProduct/{product}','ProductController@generateProductPDF')->name('product.pdfproduct')->middleware('auth');
    // Route::get('generateStatistics','ProductController@generateStatisticsPDF')->name('product.generatestatistics')->middleware('auth');

});
Route::prefix('categories')->group(function () {

    Route::get('','CategoryController@index')->name('category.index');
    Route::get('create', 'CategoryController@create')->name('category.create');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::get('edit/{category}', 'CategoryController@edit')->name('category.edit');
    Route::post('update/{category}', 'CategoryController@update')->name('category.update');
    Route::post('delete/{category}', 'CategoryController@destroy' )->name('category.destroy');
    Route::get('show/{category}', 'CategoryController@show')->name('category.show');
    Route::get('search','CategoryController@search')->name('category.search');
    // Route::get('filter','CategoryController@filter')->name('category.filter')->middleware('auth');
    // Route::get('/pdf','CategoryController@generatePDF')->name('category.pdf')->middleware('auth');
    // Route::get('pdfCategory/{category}','CategoryController@generateCategoryPDF')->name('category.pdfcategory')->middleware('auth');
    // Route::get('generateStatistics','CategoryController@generateStatisticsPDF')->name('category.generatestatistics')->middleware('auth');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
