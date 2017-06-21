<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/social_login/{provider}', 'SocialController@login');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/', 'IndexController@index');
Route::post('/search', 'IndexController@search');
Route::get('/news', 'IndexController@show_news');
Route::get('/new_goods', 'IndexController@show_new_goods');
Route::get('/rubric/{relid}/{url}', 'RubricController@show_rubric');
Route::post('/rubric/filter', 'RubricController@filter_rubric');
Route::get('/kak-kupit', 'IndexController@how_buy');
Route::get('/contacts', 'IndexController@contacts');
Route::get('/about', 'IndexController@about');

Route::get('/cart', 'CartController@show_cart');
Route::post('/cart/update_count', 'CartController@update_count');
Route::post('/add_to_cart', 'CartController@add_to_cart');
Route::get('/delete_from_cart/{ctd}', 'CartController@delete_from_cart');
Route::get('/checkout', 'CartController@checkout');
Route::get('/payment', 'CartController@payment');

Route::post('/make_order', 'CartController@make_order');

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@update_user');
Route::get('/home/{url}', 'HomeController@user_menu');
// Route::get('/orders', 'HomeController@show_orders');

Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/rubric', 'AdminController@view_rubric');
    Route::get('/admin/news', 'AdminController@view_news');
    Route::get('/admin/users', 'AdminController@view_users');
    Route::get('/admin/goods', 'AdminController@view_goods');
    Route::get('/admin/params', 'AdminController@view_params');

    Route::get('/admin/show_add_rubric', 'RubricController@show_add_rubric');
    Route::get('/admin/show_edit_rubric', 'RubricController@show_edit_rubric');
    Route::post('/admin/add_rubric', 'RubricController@add_rubric');
    Route::post('/admin/edit_rubric', 'RubricController@edit_rubric');
    Route::post('/admin/del_rubric', 'RubricController@del_rubric');

    Route::get('/admin/show_add_news/{id?}', 'NewsController@show_add_news');
    Route::get('/admin/show_edit_news', 'NewsController@show_edit_news');
    Route::post('/admin/add_news', 'NewsController@add_news');
    Route::post('/admin/edit_news', 'NewsController@edit_news');
    Route::post('/admin/del_news', 'NewsController@del_news');
});

Route::group(['middleware' => 'storage'], function(){
    Route::get('/storage/reloadstorage', 'StorageController@reloadstorage');
    Route::get('/storage/checkneworders', 'StorageController@checkneworders');
    Route::post('/storage/changedonecount', 'StorageController@changedonecount');
    Route::post('/storage/changetakeplace', 'StorageController@changetakeplace');
    Route::post('/storage/changestatus', 'StorageController@changestatus');
});