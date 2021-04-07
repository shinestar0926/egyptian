<?php

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('index');

            Route::post('logout', 'RegisterController@logout')->name('logout');
            Route::get('forgetpass', 'RegisterController@forgetpass')->name('forgetpass');
            Route::post('saveemailadmin', 'RegisterController@saveemailadmin')->name('saveemailadmin');
            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
        
            Route::any('mainmenu', 'CategoryController@mainmenu');
            
        
         
            //product routes
            Route::resource('products', 'ProductController')->except(['show']);
            Route::any('getpostdetails', 'ProductController@getpostdetails')->name('getpostdetails');
            

            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
            //contacts routes
            Route::resource('contacts', 'ContactsController')->except(['show']);
            ////////subscription
            Route::resource('subscription', 'SubscriptionController')->except(['show']);

            ////////advertisement
            Route::resource('advertisement', 'AdvertisementController')->except(['show']);

            //order routes
            Route::resource('orders', 'OrderController');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

            /////////homecontrol
            
            Route::resource('homepage', 'HomepageController')->except(['show']);
            Route::get('/showheader', 'CategoryController@showheader')->name('showheader');
            Route::any('postdate', 'HomepageController@get_postsbycategories');
            Route::any('vediosdata', 'HomepageController@vediosdata');
            Route::any('importantposts', 'HomepageController@importantposts');
            Route::any('vedioshow', 'HomepageController@vedioshow');
            Route::any('slideshow', 'HomepageController@slideshow');
            Route::any('selectedcat', 'HomepageController@selectedcat');
            
            Route::any('importantshow', 'HomepageController@importantshow');
            //////////////////////

            
///////////////////////comments approve
            Route::resource('comments', 'CommentsController')->except(['show']);
            Route::resource('replaycomments', 'ReplaycommentsController')->except(['show']);
             
///////////////////////archives
             Route::resource('archives', 'ArchivesController')->except(['show']);
            ////////////////////////////
        
            Route::resource('users', 'UserController')->except(['show']);
        }); //end of dashboard routes
    }
);
