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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');


Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/decks', 'AdminController@decks')->name('decks');
Route::get('/sessions', 'AdminController@sessions')->name('sessions');
Route::get('/roles', 'AdminController@roles')->name('roles');
