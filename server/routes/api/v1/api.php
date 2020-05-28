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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * users apis
*/

    Route::prefix('/user')->group(function() {
        Route::post('/login','api\v1\UserController@login');
        Route::post('/register','api\v1\UserController@register');
        Route::get('/me', 'api\v1\UserController@me')->middleware('auth:api');
        Route::post('/logout', 'api\v1\UserController@logout')->middleware('auth:api');
        Route::get('/myprofile', 'api\v1\UserController@myprofile')->middleware('auth:api');
        Route::get('/profiles','api\v1\UserController@profiles');

    });

    Route::prefix('/post')->group(function() {
    Route::get('/','api\v1\PostController@singePost');
    Route::get('/all','api\v1\PostController@index');
    Route::post('/add','api\v1\PostController@addPost')->middleware('auth:api');
    Route::post('/comment/add','api\v1\CommentController@store')->middleware('auth:api');

    });

    Route::get('/categories','api\v1\CategoryController@index');