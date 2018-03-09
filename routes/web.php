<?php

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

Route::resource('admin/catalog','Catalog\Admin\CatalogController');
Route::resource('admin/product','Product\Admin\ProductController');
Route::resource('admin/brand','Brand\Admin\BrandController');
Route::post('admin/catalog/{id}/image-store', 'Catalog\Admin\CatalogController@imageStore')->name('category.image.store');
Route::post('admin/product/{id}/image-store', 'Product\Admin\ProductController@imageStore')->name('product.image.store');
Route::post('admin/brand/{id}/image-store', 'Brand\Admin\BrandController@imageStore')->name('brand.image.store');