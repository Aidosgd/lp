<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('catalog/{catalog}', 'HomeController@catalog');
Route::get('catalog/{catalog}/{slug}', 'HomeController@show');
Route::get('search', 'HomeController@search');

Route::get('pages/{slug?}', 'PagesController@show');
Route::get('contacts', 'PagesController@contacts');

Route::post('callbacks', 'MailController@callbacks');
Route::post('orders', 'MailController@orders');

