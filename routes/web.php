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
/*
Route::get('/', function () {
    return view('welcome');
});

*/

///Route::get('/test_1','App\Http\Controllers\ProductController@createNewOrder');


Route::Resource('/test_1','App\Http\Controllers\SiteController');

Route::Resource('/','App\Http\Controllers\SiteController');

Route::get('products', ["uses"=>"App\Http\Controllers\ProductController@index", "as"=> "allProducts"]);

Route::get('addToCart/{id}','App\Http\Controllers\ProductController@addProductToCart');

Route::get('cart','App\Http\Controllers\ProductController@showCart');

Route::get('men','App\Http\Controllers\ProductController@menProducts');


Route::get('women','App\Http\Controllers\ProductController@womenProducts');


Route::get('deleteItemFromCart/{id}','App\Http\Controllers\ProductController@deleteItemFromCart');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//increase single product in cart
Route::get('product/increaseSingleProduct/{id}',['uses'=>'App\Http\Controllers\ProductController@increaseSingleProduct','as'=>'IncreaseSingleProduct']);

Route::get('checkoutProducts','App\Http\Controllers\ProductController@checkoutProducts');

//decrease single product in cart
Route::get('product/decreaseSingleProduct/{id}',['uses'=>'App\Http\Controllers\ProductController@decreaseSingleProduct','as'=>'DecreaseSingleProduct']);



///Route::get('product/checkoutProducts/',['uses'=>'App\Http\Controllers\ProductController@checkoutProducts','as'=>'checkoutProducts']);

///Route::post('product/createNewOrder/',['uses'=>'App\Http\Controllers\ProductController@createNewOrder','as'=>'createNewOrder']);

Route::post('/createNeworder','App\Http\Controllers\ProductController@createNewOrder');
///Route::get('product/createNewOrder/',['uses'=>'App\Http\Controllers\ProductController@createNewOrder','as'=>'createNewOrder']);

Route::get('product/createOrder/',['uses'=>'App\Http\Controllers\ProductController@createOrder','as'=>'createOrder']);

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth', 'admin']], function() {

Route::Resource('/product','App\Http\Controllers\admin\AdminProductController');
Route::Resource('/product_list','App\Http\Controllers\admin\ProductListController');
Route::Resource('/dashboard','App\Http\Controllers\AdminDashboardController');

});