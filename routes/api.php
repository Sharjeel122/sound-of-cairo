<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::middleware(['json.response'])
    ->group(
        function ()
        {
            Route::group(
                ['namespace' => 'App\Http\Controllers\API'],
                function () {
                    Route::post('/user/register', 'UserController@Register');
                    Route::post('/user/login', 'UserController@Login');
                    Route::get('/user/all/{pageNum}', 'UserController@GetAll');
                    Route::get('/user/{id}', 'UserController@Get');
                    Route::post('password/email', 'ForgotPasswordController@forgot');
                    Route::post('password/reset', 'ForgotPasswordController@reset');
                     //Get tag
                    Route::get('/tag/{id}', 'TagController@Get');
                    Route::get('/tag/all/{pageNum}', 'TagController@GetAll');
                    //Get Category
                    Route::get('/category/{id}', 'CategoryController@Get');
                    Route::get('/category/all/{pageNum}', 'CategoryController@GetAll');
                    //Get Location
                    Route::get('/location/{id}', 'LocationController@Get');
                    Route::get('/location/all/{pageNum}', 'LocationController@GetAll');

                    Route::group(['middleware' =>  'auth:sanctum','json.response' ], function () {
                        Route::post('/user/logout', 'UserController@Logout');
                        Route::post('/user/block/{id}', 'UserController@Block');
                        Route::post('/user/unblock/{id}', 'UserController@UnBlock');
                        Route::post('/user-profile/user/{id}', 'UserProfileController@Add');
                        Route::put('/user-profile/user/delete/{id}', 'UserProfileController@delete');
                        Route::put('/user-profile/user/update/{id}', 'UserProfileController@update');

                        // Category Routes
                        Route::post('/category', 'CategoryController@Add');
                        Route::put('/category/{id}', 'CategoryController@Update');
                        Route::put('/category/block/{id}', 'CategoryController@Block');
                        Route::put('/category/unblock/{id}', 'CategoryController@Unblock');

                        // Tag Routes
                        Route::post('/tag', 'TagController@Add');
                        Route::put('/tag/{id}', 'TagController@Update');
                        Route::put('/tag/block/{id}', 'TagController@Block');
                        Route::put('/tag/unblock/{id}', 'TagController@Unblock');

                        // Location Routes
                        Route::post('/location', 'LocationController@Add');
                        Route::put('/location/{id}', 'LocationController@Update');
                        Route::put('/location/block/{id}', 'LocationController@Block');
                        Route::put('/location/unblock/{id}', 'LocationController@Unblock');
                        

                        // current user
                        Route::get('/current-user', function() {
                            $user = User::with('get_user_profile')->findOrFail(auth()->user()->id);
                            $role = $user->roles->first()->name;
                            $user->role=$role;
                            return $user;
                        });
                    });

                }
            );
        }
    );


