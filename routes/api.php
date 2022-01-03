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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/register', 'App\Http\Controllers\UserController@Register');
Route::post('/user/login', 'App\Http\Controllers\UserController@Login');
Route::get('/user/all/{pageNum}', 'App\Http\Controllers\UserController@GetAll');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@Get');
Route::post('password/email', 'App\Http\Controllers\ForgotPasswordController@forgot');
Route::post('password/reset', 'App\Http\Controllers\ForgotPasswordController@reset');

 Route::group(['middleware' =>  'auth:sanctum','json.response' ], function () {
    Route::post('/user/logout', 'App\Http\Controllers\UserController@Logout');
    Route::post('/user/block/{id}', 'App\Http\Controllers\UserController@Block');
    Route::post('/user/unblock/{id}', 'App\Http\Controllers\UserController@UnBlock');
    Route::post('/user-profile/user/{id}', 'App\Http\Controllers\UserProfileController@Add');
    Route::put('/user-profile/user/delete/{id}', 'App\Http\Controllers\UserProfileController@delete');
    Route::put('/user-profile/user/update/{id}', 'App\Http\Controllers\UserProfileController@update');
 });
