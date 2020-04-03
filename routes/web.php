<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Exports\AlumnosExport;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth','permission']], function () {
        Route::get('nuevo', 'RegistroController@crear')->name('registro');
    });



Route::post('crear', 'RegistroController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/materias/{materia}','MateriasController@more')->name('more');

Route::get('/escoge/{materia}','SeleccionController@elige')->name('elige');

Route::get('/semestre','SemestreController@ciclo')->name('ciclo');

Route::post('/crear_semestre','SemestreController@neww')->name('crearsem');

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('/export',function(AlumnosExport $usersExport){
    return $usersExport->download('users.xlsx'); //si queremos guardarlo localmente con store, si queremos pdf solo conterminacion .pdf

});


Route::get('/import', 'ImportController@import');

Route::get('/materias', 'MateriasController@materias')->name('materias');

Route::get('/profesores', 'SecretarioController@profesores')->name('profesores');

Route::get('/alumnos', 'SecretarioController@alumnos')->name('alumnos');

Route::get('/alumnos/buscar', 'SecretarioController@buscar');

Route::get('/alumnos/{alumno}', 'SecretarioController@detalles')->name('alumnos.detalles');

Route::get('/mihorario', 'MateriasController@mismaterias')->name('mihora');

Route::get('/mismate', 'MateriasController@mishoras')->name('mishoras');

Route::get('/escogematerias', 'HomeController@escogerm')->name('escogem');

Route::get('/escogelaboratorio', 'HomeController@escogerl')->name('escogel');

Route::post('/escoge/materia','SeleccionController@pre')->name('pre');

Route::post('/mismate/baja','SeleccionController@baja')->name('baja');

Route::get('/profesores/{profesor}/editar', 'SecretarioController@edit')->name('profesores.edit');

Route::put('/profesores/{profesor}', 'SecretarioController@update');

Route::delete('/profesores/{profesor}', 'SecretarioController@destroy')->name('profesores.destroy');





