<?php

use Illuminate\Http\Request;

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

#region auth
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
#endregion



#endregion
Route::group([ 'middleware' => ['auth:api']], function () {
#region posts
    Route::get("posts","PostController@get_all");
    Route::get("posts/{post_id}","PostController@getSinglePost");
    Route::post("posts","PostController@save_post");
    Route::put("posts/{post_id}","PostController@update_post");
    Route::delete("posts/{post_id}","PostController@deletePost");
#endregion
});
