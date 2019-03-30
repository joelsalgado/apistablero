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

Route::resource('cts', 'CtController');

Route::get('graf1', 'ApiController@graf1');
Route::get('grafEdu1', 'ApiController@grafEdu1');
Route::get('grafEdu2/{value}', 'ApiController@grafEdu2');
Route::get('grafEdu3/{value}', 'ApiController@grafEdu3');
Route::get('grafOtros1', 'ApiController@grafOtros1');
Route::get('grafOtros2', 'ApiController@grafOtros2');
Route::get('grafAdmin1', 'ApiController@grafAdmin1');

Route::get('getCts/{mun}/{tipo}/{cual}', 'ApiController@getCts');

