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

Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/clockin', 'TimeClocksController@clockin')->name('clockin');
    Route::get('/clockout', 'TimeClocksController@clockout')->name('clockout');

    Route::get('/reports/daily', 'UserReportsController@showDailyReport')->name('users.reports.daily');
    Route::get('/reports/monthly', 'UserReportsController@showMonthlyReport')->name('users.reports.monthly');
});

Route::middleware('required.admin')->prefix('admin')->group(function () {

    // Rutas para gestión de Tipo de registros de tiempo
    Route::resource('clocktypes', 'ClockTypesController')->except(['show']);

    // Rutas para gestión de usuario
    Route::resource('users', 'UserManagementController')->except(['show']);

});


