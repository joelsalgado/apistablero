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
Route::get('municipios', 'ApiController@municipios');
Route::get('ctsmap', 'ApiController@ctsmaps');
Route::get('ctsmap2/{array1}/{array2}', 'ApiController@ctsmaps2');

Route::get('getCts/{mun}/{tipo}/{cual}', 'ApiController@getCts');

Route::get('getGradosPrimaria/{id}', 'ApiController@getGradosPrimaria');
Route::get('getSexoPrimaria/{id}', 'ApiController@getSexoPrimaria');
Route::get('getGruposPrimaria/{id}/{grado}', 'ApiController@getGruposPrimaria');
Route::get('getAlumnosPrimaria/{grupo_id}', 'ApiController@getAlumnosPrimaria');
Route::get('getAlumPrim/{grupo_id}', 'ApiController@getAlumPrim');
Route::get('getCt/{clave}', 'ApiController@getCt');
Route::get('getGrupoPrimaria/{id}/{grado}/{description}', 'ApiController@getGrupoPrimaria');
Route::get('getCalifPrim/{alumno_id}', 'ApiController@getCalifPrim');
Route::get('getDatosGralPrim/{alumno_id}', 'ApiController@getDatosGralPrim');
Route::get('getDireccionPrim/{alumno_id}', 'ApiController@getDireccionPrim');
Route::get('getTutoPrim/{alumno_id}', 'ApiController@getTutoPrim');
Route::get('getAdicionalesPrim/{alumno_id}', 'ApiController@getAdicionalesPrim');
Route::get('getContactoPrim/{alumno_id}', 'ApiController@getContactoPrim');

Route::get('getGradosSecundaria/{id}', 'ApiController@getGradosSecundaria');

