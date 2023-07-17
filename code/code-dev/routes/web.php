<?php

use Illuminate\Support\Facades\Route;

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



//RUTAS DE Autentificacion
Route::get('/','ConnectController@getLogin')->name('login');
Route::get('/inicio_sesion','ConnectController@getLogin')->name('login');
Route::post('/inicio_sesion','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');

Route::get('/citas_del_dia_rx', 'PatientDayController@getPatientDayRx')->name('patient_day');
Route::get('/citas_del_dia_umd/{filtrado}', 'PatientDayController@getPatientDayUmd')->name('patient_day');
Route::get('/citas_del_dia/{id}/materiales', 'PatientDayController@getMaterials')->name('materials');
Route::post('/citas_del_dia/materiales', 'PatientDayController@postMaterials')->name('materials'); 
Route::get('/citas_del_dia/acciones/{id}/comentario/{text}', 'PatientDayController@getAppointmentComment')->name('materials'); 
Route::get('/citas_del_dia/acciones/{id}/solicitud_reprogramacion', 'PatientDayController@getAppointmentReschedule')->name('materials'); 
Route::get('/citas_del_dia/acciones/{id}/ausente_examen', 'PatientDayController@getAppointmentNot')->name('materials'); 
Route::get('/citas_del_dia/acciones/{id}/agregar_estudio/{area}/{study}/{comment}', 'PatientDayController@getAppointmentAddExamen')->name('materials'); 

//Request Ajax
Route::get('/agem/api/load/name/study/{id}', 'ApiController@getStudyName');
Route::get('/agem/api/load/name/study/all/{type}', 'ApiController@getStudy');