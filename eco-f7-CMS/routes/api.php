<?php
header('Access-Control-Allow-Origin : *');
header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
header('Access-Control-Expose-Headers : X-Auth-Token, Authorization');
header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('products')->group(function () {
	Route::get('view','Api\ProductsController@view');
	Route::get('category/{categoryId}','Api\ProductsController@viewByCategoryId');
	Route::get('gallery/{productId}','Api\ProductsController@getProductWithGallery');
});


Route::get('category', 'Api\CategoryController@view');
Route::get('CategoriesWithProducts', 'Api\CategoryController@CategoriesWithProducts');

Route::prefix('cart')->group(function () {
	Route::post('view', 'Api\CartController@myCart');
	Route::post('add', 'Api\CartController@addToMyCart');
	Route::post('remove/{cartId}', 'Api\CartController@removeFromMyCart');
	Route::post('total', 'Api\CartController@myCartTotal');
	Route::post('clear', 'Api\CartController@clearMyCart');
});

Route::prefix('orders')->group(function () {
	Route::post('view', 'Api\OrdersController@MyOrders');
	Route::post('order/{orderId}', 'Api\OrdersController@MyOrder');
	Route::post('add', 'Api\OrdersController@AddToMyOrder');
});


Route::prefix('auth')->group(function () {
	    Route::post('register','Api\AuthController@register');
	    Route::post('login','Api\AuthController@login');
	    Route::post('adminLogin','AdminAuthController@login');
	    Route::post('logout','Api\AuthController@logout');
	    Route::post('me','Api\AuthController@me');
    });

