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

Auth::routes();

// Guest User
Route::get('/', 'GuestController@welcome');
Route::get('/home', 'GuestController@welcome')->name('home');
Route::get('/about', 'GuestController@about');
Route::get('/privacy', function() {
    return view('pages.privacy');
});

Route::get('/term_of_service', function() {
    return view('pages.terms');
});

// Route::get('/register', 'Auth\RegisterController');

// Authenticated User 
Route::get('/order/{desc}', 'HomeController@order');
Route::post('/add_to_cart', 'HomeController@addToCart'); 
Route::get('/orders', 'HomeController@orderList');
Route::get('/orders/{id}', 'HomeController@orderDetails');
Route::get('/cart', 'HomeController@cart');
Route::get('/cart/success', 'HomeController@success');
Route::get('/remove/{id}', 'HomeController@removeFromCart');
Route::get('/getTime', 'HomeController@getTime');
Route::get('/approve/{id}', 'HomeController@approve');
Route::post('/approve/{id}', 'HomeController@approvePost');
Route::get('/profile', 'HomeController@profile');
Route::get('/edit_profile', 'HomeController@editProfileGet');
Route::post('/edit_profile', 'HomeController@editProfilePost');
Route::get('/change_password', 'HomeController@changePasswordGet');
Route::post('/change_password', 'HomeController@changePasswordPost');
Route::get('/withdrawal', 'HomeController@withdrawal');
Route::post('/withdrawal', 'HomeController@withdrawalPost');
Route::get('/bank_details', 'HomeController@bankDeatils');
Route::post('/bank_details', 'HomeController@bankDeatilsPost');

// Blog 
Route::get('/blog', 'BlogController@getPosts');
Route::get('/blog/{id}', 'BlogController@getPost');
Route::post('/submitComment', 'BlogController@submitComment');
Route::post('/submitReply', 'BlogController@submitReply');


// Writer route

// Test route
Route::get('/test', 'GuestController@test');

// Payment controller
Route::get('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/paynow', 'PaymentController@redirectToPay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
