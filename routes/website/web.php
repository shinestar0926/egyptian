<?php
Route::group(
  ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
  function () {

    Route::prefix('mediacare')->name('mediacare.')->middleware(['webauth'])->group(function () {
    });
    /////////////////////////home///////////
    Route::prefix('')->name('mediacare.')->group(function () {
      Route::get('/', 'WelcomeController@index')->name('index');


      Route::get('details/{id}', 'WelcomeController@details')->name('details');

      // categoriesflater
      Route::get('categoriesflater{id}', 'WelcomeController@categoriesflater')->name('categoriesflater');



      Route::get('home-to-cart/{id}', 'WelcomeController@getAddToCart')->name('home.addToCart');
      Route::get('gold_price', 'WelcomeController@gold_price')->name('home.gold_price');

      Route::get('about_us', 'WelcomeController@about_us')->name('about_us');

      ////////////////archives//////////
      Route::get('archives', 'WelcomeController@archives')->name('archives');
      Route::get('archivesdetails/{id}', 'WelcomeController@archivesdetails')->name('archivesdetails');
////////////////////comments/////////////////
      Route::any('savecomment', 'WelcomeController@savecomment')->name('savecomment');
      Route::any('replaycomment', 'WelcomeController@replaycomment')->name('replaycomment');
      
      Route::any('Alerts', 'WelcomeController@Alerts')->name('Alerts');
    


      //product routes//////////////////////////////////
      Route::resource('products', 'ProductController')->except(['show']);
      Route::any('postdate', 'ProductController@postDate');
      Route::get('productdetails/{id}', 'ProductController@productdetails')->name('productdetails');
      /////client routes//////////////////////////////////
      Route::resource('client', 'RegisterController')->except(['show']);
      Route::get('login', 'RegisterController@login')->name('login');
      Route::post('postlogin', 'RegisterController@postlogin')->name('postlogin');
      Route::post('logout', 'RegisterController@logout')->name('logout');
      Route::get('logout2', 'RegisterController@logout')->name('logout2');
      Route::get('resetpassword', 'RegisterController@resetpassword')->name('resetpassword');
      Route::post('resetnewpassword', 'RegisterController@forgetpassword')->name('resetnewpassword');
      Route::get('makenewpassword/{user}', 'RegisterController@newpassword')->name('makenewpassword');
      Route::post('updatenewpass', 'RegisterController@updatenewpass')->name('updatenewpass');


      /////////////



      /////////////////////shopping cart/////////////////////
      Route::get('newproduct', 'ProductController@index')->name('product.index');





      //////////////contactus////////////////////////
      Route::resource('contactus', 'ContactUsController')->except(['show']);
      
      Route::any('savecontact', 'ContactUsController@store')->name('savecontact');
      //////////////////////////////////////////////////


      //////////////////////////////////////
      //////////////profile/////////////////////
      Route::resource('profile', 'ProfileController')->except(['show'])->middleware(['webauth']);
      Route::get('newpassword/{id}', 'ProfileController@newpassword')->name('newpassword')->middleware(['webauth']);
      Route::get('update_address/{id}', 'ProfileController@update_address')->name('update_address');
      Route::get('delete_image/{id}', 'ProfileController@delete_image')->name('delete_image');
      Route::get('delete_iban/{id}', 'ProfileController@delete_iban')->name('delete_iban');
      Route::post('ajax-image-upload', 'ProfileController@store')->name('image.ajax.store');
      Route::get('certifcates/{id}', 'ProfileController@certifcates')->name('certifcates');
      Route::get('printcertifcates/{id}', 'ProfileController@printcertifcates')->name('printcertifcates');
      Route::get('downloadcertifcates/{id}', 'ProfileController@downloadPDF')->name('downloadcertifcates');

      Route::post('slfe-image-upload', 'ProfileController@slfestore')->name('image.slfestore');
      Route::get('delete_selfeimage/{id}', 'ProfileController@delete_selfeimage')->name('delete_selfeimage');

      ///////////////////termcondtions/////////////////////////
      Route::resource('termcondtions', 'TermsController')->except(['show']);
      /////////////////////////policy///////////////////
      Route::get('policy', 'TermsController@policy')->name('policy');
    });
  }
);
