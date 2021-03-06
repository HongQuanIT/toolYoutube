<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\RenderController;

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


Route::get('/', 'WelcomeController@welcome')->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/home', [ HomeController::class ,'index'])->name('home')->middleware('verified');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/table-list', [ HomeController::class ,'tableList'])->name('tableList');
	Route::get('/youtube', [ YoutubeController::class ,'index'])->name('youtube');
	Route::get('/render', [ RenderController::class ,'index'])->name('render');
	Route::post('/render', [ RenderController::class ,'render'])->name('render.create');
	Route::get('/typography', [ HomeController::class ,'typography'])->name('typography');
	Route::get('/icons', [ HomeController::class ,'icons'])->name('icons');
	Route::get('/map', [ HomeController::class ,'map'])->name('map');
	Route::get('/notifications', [ HomeController::class ,'notifications'])->name('notifications');
	Route::get('/rtl-support', [ HomeController::class ,'language'])->name('language');
	Route::get('/upgrade', [ HomeController::class ,'upgrade'])->name('upgrade');
});
// user profile
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

