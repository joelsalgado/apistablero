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
Route::get('getSexoSecu/{id}', 'ApiController@getSexoSecu');
Route::get('getGruposSecu/{id}/{grado}/{turno}', 'ApiController@getGruposSecu');
Route::get('getAlumSec/{grupo_id}', 'ApiController@getAlumSec');
Route::get('getGrupoSecu/{id}/{grado}/{turno}/{desciption}', 'ApiController@getGrupoSecu');
Route::get('getCalifSecu/{alumno_id}', 'ApiController@getCalifSecu');

Route::get('getGradosPres/{id}', 'ApiController@getGradosPres');
Route::get('getSexoPres/{id}', 'ApiController@getSexoPres');
Route::get('getGruposPres/{id}/{grado}', 'ApiController@getGruposPres');
Route::get('getAlumPres/{grupo_id}', 'ApiController@getAlumPres');
Route::get('getGrupoPres/{id}/{grado}/{description}', 'ApiController@getGrupoPres');

Route::get('getGralCt/{claveCt}', 'ApiController@getGralCt');

Route::get('getPlantilla/{claveCt}', 'ApiController@getPlantilla');

Route::get('getGeneralEmpleados/{rfc}', 'ApiController@getGeneralEmpleados');

Route::get('getClavePresupuestal/{rfc}', 'ApiController@getClavePresupuestal');

Route::get('searchAlumnos/{nombre}', 'ApiController@searchAlumnos');
Route::get('searchEscuelas/{nombre}', 'ApiController@searchEscuelas');
Route::get('searchDocentes/{nombre}', 'ApiController@searchDocentes');

Route::get('searchUser/{user}', 'ApiController@searchUser');
Route::get('loginFor/{user}/{pass}', 'ApiController@loginFor');

Route::get('filterEscuelas/{array1}/{array2}/{nombre}', 'ApiController@filterEscuelas');
Route::get('filterAlumnos/{array1}/{array2}/{nombre}', 'ApiController@filterAlumnos');
Route::get('filterDocentes/{nombre}/{mun}', 'ApiController@filterDocentes');

Route::get('blog', 'ApiController@blog');
Route::get('article/{id}', 'ApiController@article');
