<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_user', 'AdminController@getAllUsers');
Route::post('/set_role', 'AdminController@setRole');
Route::get('/get_roles', 'AdminController@getRoles');
Route::post('/new_deck', 'AdminController@newDeck');
Route::get('/get_decks', 'AdminController@getDecks');
Route::post('/del_deck', 'AdminController@delDeck');
Route::post('/upload_cards', 'AdminController@uploadCards');
Route::post('/get_cards', 'AdminController@getCards');
Route::post('/del_card', 'AdminController@delCard');
Route::get('/get_sessions', 'AdminController@getSessions');
Route::post('/del_session', 'AdminController@delSession');
Route::post('/save_session', 'AdminController@saveSession');
Route::post('/new_role', 'AdminController@newRoles');
Route::post('/del_role', 'AdminController@delRoles');
Route::get('/get_roles_list', 'AdminController@getRolesList');


Route::post('/get_user_sessions', 'ApiController@getSessions');
Route::post('/game_decks', 'ApiController@getDecks');
Route::post('/game_questions', 'ApiController@getQuestions');
