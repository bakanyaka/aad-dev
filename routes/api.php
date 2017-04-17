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

Route::post('/login', 'Auth\AuthController@login');


Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', 'Auth\AuthController@user');
    Route::post('/logout', 'Auth\AuthController@logout');
});



Route::group(['prefix' => 'users'], function (){
    Route::get('/search', 'Api\Users\UserSearchController@index');
});

Route::group(['prefix' => 'computers'], function (){
    Route::get('/search', 'Api\Computers\ComputerSearchController@index');
    Route::get('/{computer}', 'Api\Computers\ComputerController@show');
});



