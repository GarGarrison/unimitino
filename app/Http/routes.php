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

Route::get('/', 'IndexController@index');
Route::post('/search', 'IndexController@search');

Route::get('/show_cart', 'CartController@show_cart');
Route::post('/add_to_cart', 'CartController@add_to_cart');
Route::post('/delete_from_cart', 'CartController@delete_from_cart');
Route::get('/order_params', 'CartController@order_params');
Route::post('/make_order', 'CartController@make_order');

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@update_user');

Route::get('/test', function(){
    return view('test');
});

Route::get('/admin', 'AdminController@index');
Route::get('/admin/rubric', 'AdminController@view_rubric');
Route::get('/admin/news', 'AdminController@view_news');
Route::get('/admin/users', 'AdminController@view_users');
Route::get('/admin/goods', 'AdminController@view_goods');

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
