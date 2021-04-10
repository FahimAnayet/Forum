<?php

use App\Channel;
use Illuminate\Http\Request;

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
	$users = \App\User::all();

	return view('welcome', compact('users'));
});

Route::get('/jquery', function () {
	return view('jquery');
});

Route::post('/ajaxRequest', 'NotificationController@jquery');

Auth::routes();
Route::group(['prefix' => 'forum'], function () {
	Route::resources([
		'channel' => 'ChannelController',
		'notification' => 'NotificationController',
		'problem' => 'ProblemController',
	]);
});
Route::patch('/forum/problem/{problem}/status', 'ProblemController@status')->name('problem.status');
Route::patch('/reply/{solution}/status/{problem}', 'SolutionController@status')->name('solution.status');
Route::post('/reply/{problem}', 'SolutionController@store')->name('post.reply');
Route::get('/home', 'HomeController@index')->name('home');
