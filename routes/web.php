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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@index')->name('articles');

Route::get('article/add','IndexController@add')->name('addArticle');

Route::post('/article/add', 'IndexController@store')->name('articleStore');

Route::get('/article/{id}',['uses'=>'IndexController@show','as'=>'articleShow', 'middleware'=>'myMiddle']);

Route::delete('/article/delete/{article}',['uses'=>'IndexController@formDelete'])->name('articleDelete');

Route::post('/article/destroy', 'IndexController@destroy')->name('articleDestroy');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
