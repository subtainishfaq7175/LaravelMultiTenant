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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/company', 'CompanyController@index')->name('company');
Route::get('/companydetail/{id}', 'CompanyController@show')->name('companydetail');
Route::get('/companyinfo/{id}', 'CompanyController@edit')->name('companyinfo');
Route::post('/registerCompany', 'CompanyController@store')->name('registerCompany');
Route::post('/updateCompany', 'CompanyController@update')->name('updateCompany');
Route::get('/user/{id}', 'CompanyController@adduser')->name('user');
Route::post('/companyUser', 'CompanyUsersController@store')->name('companyUser');
Route::post('/companyDelete', 'CompanyController@companyDelete')->name('companyDelete');
Route::post('/companyUserDelete', 'CompanyUsersController@companyUserDelete')->name('companyUserDelete');
