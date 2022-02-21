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
                    Route::get('/home/tag/all', 'TagController@GetAllHome');
                    //Get Category
                    Route::get('/category/{id}', 'CategoryController@Get');
                    Route::get('/get/category/featured-one', 'CategoryController@GetFeaturedOne'); 
                    Route::get('/get/category/featured-two', 'CategoryController@GetFeaturedTwo');
                    Route::get('/category/all/{pageNum}', 'CategoryController@GetAll');
                    Route::get('/home/category/all', 'CategoryController@GetAllHome');
                    //Get Location
                    Route::get('/location/{id}', 'LocationController@Get');
                    Route::get('/countries', 'LocationController@GetCountries');
                    Route::get('/state/{id}', 'LocationController@GetStates');
                    Route::get('/city/{id}', 'LocationController@GetCities');
                    Route::get('home/location/all', 'LocationController@GetAllHome');
                    Route::get('/location/all/admin', 'LocationController@GetAll');
                    Route::get('/home/location', 'LocationController@LocationsGet');
 		    // Get sub category
                    Route::get('get-sub-cat/all','SubCategoryController@get_sub_category');
                    Route::get('get-sub-cat/{id}','SubCategoryController@get_sub');
 		            Route::get('sub-cat/all','SubCategoryController@sub_cat_admin');
                    Route::get('sub-cat/category/{id}','SubCategoryController@Subcat_of_category');

                    //sound
                    Route::get('get-sound/front','SoundController@front');
                    Route::get('get-all/sounds','SoundController@Get_All'); 
                    Route::get('/totle-song','SoundController@Count_totle');


                

                    Route::group(['middleware' =>  'auth:sanctum','json.response' ], function () {

                        Route::post('/user/logout', 'UserController@Logout');
                        Route::post('/user/block/{id}', 'UserController@Block');
                        Route::post('/user/unblock/{id}', 'UserController@UnBlock');
                        Route::post('/user-profile/user/{id}', 'UserProfileController@Add');
                        Route::put('/user-profile/user/delete/{id}', 'UserProfileController@delete');
                        Route::put('/user-profile/user/update/{id}', 'UserProfileController@update');

			         //sound
			            Route::Post('/add-sound','SoundController@Add_Sound');
                        Route::post('/block/sound/{id}','SoundController@Block');
                        Route::post('/unBlock/sound/{id}','SoundController@UnBlock');
                        Route::post('/sound/upvote/{id}','SoundController@Upvote');
                        Route::post('/save-sound/{id}','SoundController@Save_Sound');
                       Route::get('/get-my-song/','SoundController@Get_My_Saved_Song');
                        Route::post('/download/sound/{id}','DownloadController@download');
                        Route::post('/delete_song/{id}','SoundController@Delete_Song'); 


                        //sound collection
                         Route::post('/save/collection','CollectionController@Save_Collection');
                          Route::post('collection/add/{id}/{soundId}','CollectionController@CollectionAdd');
                       Route::get('/get/collection','CollectionController@Get_Collections');
                        Route::post('collection/delete/{id}','CollectionController@Delete');

 Route::get('/get/sound/collection','CollectionController@CollectionSound');


                        // current user
                        Route::get('/current-user', function(Request $request) {
                            $user = User::with('get_user_profile')->findOrFail(auth()->user()->id);
                            $role = $user->roles->first()->name;
                            $user->role=$role;
                            return $user;
                        });

              Route::group(['middleware' =>  'role:admin','auth:sanctum','json.response' ], function () {
                        // Category Routes
                        Route::post('/category', 'CategoryController@Add');
                        Route::post('update/category/{id}', 'CategoryController@Update');
                        Route::put('block/category/{id}', 'CategoryController@Block');
                        Route::put('unblock/category/{id}', 'CategoryController@Unblock');
                        Route::put('/category/featured-one/{id}', 'CategoryController@FeaturedOne');
                        Route::put('/category/featured-two/{id}', 'CategoryController@FeaturedTwo');
                        Route::put('/category/un-featured/{id}', 'CategoryController@UnFeatured');

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

			    // sub category routs
                        Route::Post('add/sub/cat','SubCategoryController@add');
                        Route::Post('update-sub-cat/{id}','SubCategoryController@update_sub');
                        Route::Post('sub-cat-block/{id}','SubCategoryController@sub_block');
                        Route::Post('sub-cat-unblock/{id}','SubCategoryController@sub_unblock');
                       
                       //sound admin
                        Route::post('sound/delete/{id}','SoundController@Delete'); 
                        Route::get('sounds/rejected/','SoundController@Rejected');
                        Route::get('sounds/approved/','SoundController@Approved');
                        
                        

                 });    
          });

                }
            );
        }
    );


