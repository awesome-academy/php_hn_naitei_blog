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

Route::get('/', function () {
    return view('homepage.profile');
});
Route::get('following', 'FollowController@listFollowing')->name('follow.following');
Route::post('following/{id}', 'FollowController@follow')->name('follow.add');
Route::delete('follower/{id}', 'FollowController@destroy')->name('follow.destroy');
Route::get('follower', 'FollowController@listFollower')->name('follow.follower');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
