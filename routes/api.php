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

Route::prefix('auth')->group(function () {
    Route::post('/login', 'CommonController@login');
});



Route::middleware('auth:api')->group(function() {
    Route::post('/auth/logout', 'CommonController@logout');
    
    // For frontend
    Route::prefix('slug')->group(function () {
        Route::get('/','SlugController@index'); 
        Route::get('/{slug}', 'SlugController@show');
        Route::post('/', 'SlugController@store');
        Route::put('/{id}','SlugController@update')->where('id', '[0-9]+');    
        Route::delete('/{id}', 'SlugController@destroy')->where('id', '[0-9]+');
    });

    // For postman
    Route::get('/','SlugController@index'); 
    Route::get('/{slug}', 'SlugController@show');
    Route::post('/', 'SlugController@store');
    Route::put('/{id}','SlugController@update')->where('id', '[0-9]+');    
    Route::delete('/{id}', 'SlugController@destroy')->where('id', '[0-9]+');
});

