<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

//user path
Route::group(['middleware' => 'auth'], function () {
    Route::get('profile','UserController@history')->name('profile');
    Route::get('edit-profile','UserController@editProfile')->name('edit-profile');
    Route::post('update-profile','UserController@updateProfile')->name('update-profile');
    Route::post('follow','UserMessageController@sendRequest')->name('follow');
    Route::get('history-product','admin\\ProductController@historyProduct')->name('history-product');
    Route::get('port','UserController@port')->name('port');
    Route::post('update-image','UserController@updateImage')->name('update-image');
});
Route::group([
    'middleware' => 'auth',
    'prefix' => 'orders',
],function (){
    Route::get('getProduct', 'admin\\OrderController@getProduct')->name('getProduct');
    Route::post('getOrder', 'admin\\OrderController@getOrder')->name('getOrder');
    Route::get('select-product','admin\\OrderController@selectProduct')->name('select-product');
    Route::post('select-order','admin\\OrderController@selecyOrder')->name('select-order');
    Route::post('pre-sell','admin\\OrderController@preSell')->name('pre-sell');
    Route::post('sell-order', 'admin\\OrderController@sell')->name('sell-order');
    Route::get('auto-sale/{order}','admin\\OrderController@autoSale')->name('auto-sale');
    Route::post('set-price/{order}','admin\\OrderController@sale')->name('set-price');
});



//admin path
Route::group(['middleware' => ['auth','admin']], function () {
    Route::view('admin/home', 'admin.dashboard');
    Route::resource('admin/post', 'admin\\PostController');
    Route::resource('admin/role', 'admin\\RoleController');
    Route::resource('admin/order', 'admin\\OrderController');
    Route::resource('admin/product', 'admin\\ProductController');
    Route::get('admin/users','UserController@index')->name('users');
    Route::get('admin/users/create','UserController@showCreateForm')->name('users/create');
    Route::post('users/store','UserController@store')->name('store');
    Route::get('update/round','UserController@roundUser')->name('update/round');
    Route::get('admin/contacts','ContactController@index');
    Route::get('admin/events','EventController@showEventForm')->name('events');
    Route::get('admin/events/create','EventController@create')->name('events/create');
    Route::post('admin/events/store','EventController@store')->name('event_store');
});



//public path
Route::view('/', 'frontend.index')->name('index');
Route::get('products', 'admin\\ProductController@home')->name('products');
Route::get('ranking','RankController@ranking')->name('ranking');
Route::get('rule','RankController@raw')->name('rule');
Route::post('send','ContactController@getMessage')->name('send');
Route::get('/send/email', 'UserController@mail');
Route::get('product-follow', 'UserMessageController@index')->name('product-follow');
Route::get('month','RankController@selectRound')->name('month');

Route::group([
    'prefix' => 'posts'
],function (){
    Route::get('/', 'admin\\PostController@post')->name('posts');
    Route::get('content/{post}','admin\\PostController@content')->name('content');
});

Route::get('user-ranking','RankController@userRanking')->name('user-ranking');
Route::get('edt-pro','RankController@editPro');