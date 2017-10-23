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

Auth::routes();

Route::get('/register/confirm', 'Auth\RegisterController@confirm')->name('register.confirm');

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/chat', 'ChatController@index')->name('chat');

Route::resource('users', 'UsersController');
Route::get('/profiles/{user}', 'UserProfilesController@show')->name('profiles');

Route::resource('channels', 'ChannelsController');

Route::post('channels/{channel}/join', 'JoinChannelController@join');
Route::post('channels/{channel}/leave', 'JoinChannelController@leave');

Route::resource('channels/{channel}/messages', 'MessagesController')->only(['index', 'store']);
