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

Route::get('/', 'Content\ContentController@index')->name('home');

/** Public routes */
//Catalog routes
Route::get('/catalog/{slug}', 'Catalog\CatalogController@show')->name('catalog.slug');
Route::get('/catalog', 'Catalog\CatalogController@index')->name('catalog.index');

//Product routes
Route::get('/product/{slug}', 'Product\ProductController@show')->name('product.slug');

/** Backoffice routes */
Route::get('/backoffice/', 'Backoffice\Admin\AdminController@index')->name('backoffice.index');
Route::resource('backoffice/catalog','Catalog\Admin\CatalogController');
Route::resource('backoffice/product','Product\Admin\ProductController');
Route::resource('backoffice/brand','Brand\Admin\BrandController');
Route::post('backoffice/catalog/{id}/image-store', 'Catalog\Admin\CatalogController@imageStore')->name('category.image.store');
Route::post('backoffice/product/{id}/image-store', 'Product\Admin\ProductController@imageStore')->name('product.image.store');
Route::post('backoffice/brand/{id}/image-store', 'Brand\Admin\BrandController@imageStore')->name('brand.image.store');