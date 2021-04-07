<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/////////
Route::middleware('jwtAuth')->group(function() {
    Route::get('logout','AuthController@logout');
    Route::get('me','AuthController@me');
    Route::get('payload','AuthController@payload');
  Route::post('directsale','TitleController@directsale');
  Route::post('allads','TitleController@allads');
  Route::get('add_details/{id}','TitleController@add_details');
  Route::get('my_adds/{id}','TitleController@my_adds');
  Route::post('book_product','TitleController@book_product');
  Route::get('allbooked/{id}','TitleController@allbooked');
  Route::post('acceptadds/{id}/{publisher}','TitleController@acceptadds');
   
});



  Route::post('register', 'AuthController@register');
Route::post('login','AuthController@login');
Route::resource('posts','postController');
Route::resource('sale_type','SaleTypeController');
Route::resource('title','TitleController');


//Route::middleware('jwt.auth')->post('login', 'API/AuthController@login');
