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

//Admin Guest Routes
Route::group(['prefix' => "admin", 'namespace' => "Admin"], function () {
    Route::get('login', ['uses' => 'SessionController@login', 'as' => 'admin.login']);
    Route::post('doLogin', ['uses' => 'SessionController@doLogin', 'as' => 'admin.doLogin']);
    Route::post('logout', ['uses' => 'SessionController@logout', 'as' => 'admin.logout']);

});

//Admin Auth Routes
Route::group(['middleware' => "auth.isAdmin", 'prefix' => "admin", 'as' => 'admin.', 'namespace' => "Admin"], function () {
    Route::resource('locations', 'LocationsController');
    Route::get('locations/{id}/eliminar', ['uses' => 'LocationsController@eliminar', 'as' => 'locations.eliminar']);
    Route::resource('categories', 'CategoriesController');
    Route::post('categories/{id}/updateAvailability', ['uses' => 'CategoriesController@updateAvailability', 'as' => 'categories.updateAvailability']);
    Route::get('categories/{id}/eliminar', ['uses' => 'CategoriesController@eliminar', 'as' => 'categories.eliminar']);
    Route::resource('bookings', 'BookingsController');
});

//Admin Guest Routes
Route::group(['prefix' => "front", 'namespace' => "Front"], function () {
    Route::get('login', ['uses' => 'SessionController@login', 'as' => 'front.login']);
    Route::post('doLogin', ['uses' => 'SessionController@doLogin', 'as' => 'front.doLogin']);
    Route::post('logout', ['uses' => 'SessionController@logout', 'as' => 'front.logout']);

});

//User Auth Routes
Route::group(['middleware' => "auth.isUser", 'prefix' => "front", 'as' => 'front.', 'namespace' => "Front"], function () {
    Route::get('home', ['uses' => 'HomeController@home', 'as' => 'home']);
    Route::resource('bookings', 'BookingsController');
    Route::post('search', ['uses' => 'HomeController@search', 'as' => 'search']);
    Route::post('preview', ['uses' => 'HomeController@preview', 'as' => 'preview']);
    Route::get('bookings/{id}/sendEmai', ['uses' => 'BookingsController@sendEmai', 'as' => 'bookings.sendEmai']);
    Route::post('bookings/{id}/pay', ['uses' => 'BookingsController@pay', 'as' => 'bookings.pay']);
    Route::get('bookings/{id}/getPayment', ['uses' => 'BookingsController@getPayment', 'as' => 'bookings.getPayment']);
    Route::post('bookings/{id}/cancel', ['uses' => 'BookingsController@cancel', 'as' => 'bookings.cancel']);




});
