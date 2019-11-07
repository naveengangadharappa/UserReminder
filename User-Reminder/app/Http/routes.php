<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/NavigationOption', 'NavigationOptionController@index');

Route::get('/Adminlogin', 'AdminController@index');

Route::get('/ChildrenVaccin', 'ChildrenVaccinController@index');

Route::post('/ChildrenVaccin', 'ChildrenVaccinController@postdata');

Route::get('/VehicleService', 'VehicleServiceController@index');

Route::post('/VehicleService', 'VehicleServiceController@postdata');

Route::get('/LIC', 'LICController@index');

Route::post('/LIC', 'LICController@postdata');

Route::get('/Mediclaim', 'MediclaimController@index');

Route::post('/Mediclaim', 'MediclaimController@postdata');

Route::get('/AddMyReminder', 'AddMyReminderController@index');

Route::get('/Electronics', 'ElectronicsController@index');

Route::post('/Electronics', 'ElectronicsController@postdata');

Route::get('/AddVaccination', 'AddVaccinationController@index');

Route::post('/AddVaccination', 'AddVaccinationController@postdata');

Route::get('/getchild/{email}', 'AddVaccinationController@getchild');

