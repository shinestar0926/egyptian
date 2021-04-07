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
   // return view('welcome');
    return redirect()->route('dashboard.index');
});


Route::get('fakka', function () {
  // return ('welcome');
    return redirect()->route('website.index');
});
////////// send sms to mobile
Route::get('/send/message', 'Web\SmsController@sendMessage');
/////////////

////////// send mail
Route::get('/send/mail', 'Dashboard\ContactsController@contact_mail');
/////////////

Route::get('delete_client', 'Web\WelcomeController@delete_client');


Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
