<?php

use App\Http\Controllers\PollController;
use App\Http\Middleware\ControlloCredito;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/home/{poll}/vote1','PollVoteController@store');
Route::delete('/home/{poll}/vote2','PollVoteController@destroy');

Route::post('/polls','PollController@store');
Route::delete('/polls/{id}','PollController@destroy');


Auth::routes();

Route::post('/home/insertPlayer','PlayerController@store');
Route::delete('/player/{id}','PlayerController@destroy');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/fetch','HomeController@fetch')->name('home.fetch');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/profiles/{user}','ProfilesController@show');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');


Route::group(['middleware' => [
    'auth'
]], function(){
    Route::post('/publish/{id}', 'GraphController@publishToProfile');
});