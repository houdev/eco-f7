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

Route::get('/{any}','Web\AppController@index')->where('any', '.*');



Route::prefix('web/category')->group(function () {
    Route::post('add','Web\CategoriesController@addNewCategory');
    Route::post('update/{categoryID}','Web\CategoriesController@updateCategory');
    Route::post('delete/{categoryID}','Web\CategoriesController@deleteCategory');
});

Route::prefix('web/product')->group(function () {
    Route::post('add','Web\ProductsController@addProduct');
    Route::post('update/{productID}','Web\ProductsController@updateProduct');
    Route::post('delete/{productID}','Web\ProductsController@deleteProduct');
});




