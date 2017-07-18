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

Route::get('/home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('/company', [
    'as' => 'company',
    'uses' => 'CompanyController@index'
]);

Route::get('/companydetail/{id}', [
    'as' => 'companydetail',
    'uses' => 'CompanyController@show'
]);

Route::get('/companyinfo/{id}', [
    'as' => 'companyinfo',
    'uses' => 'CompanyController@edit'
]);

Route::get('/domain', [
    'as' => 'domain',
    'uses' => 'DomainChecker@index'
]);

Route::get('/user/{id}', [
    'as' => 'user',
    'uses' => 'CompanyController@adduser'
]);

Route::get('/companylogin', [
    'as' => 'companylogin',
    'uses' => 'DomainChecker@companyUserLogin'
]);

// Post Routes

Route::post('/registerCompany', [
    'as' => 'registerCompany',
    'uses' => 'CompanyController@store'
]);

Route::post('/updateCompany', [
    'as' => 'updateCompany',
    'uses' => 'CompanyController@update'
]);

Route::post('/companyUser', [
    'as' => 'companyUser',
    'uses' => 'CompanyUsersController@store'
]);

Route::post('/companyDelete', [
    'as' => 'companyDelete',
    'uses' => 'CompanyController@companyDelete'
]);

Route::post('/companyUserDelete', [
    'as' => 'companyUserDelete',
    'uses' => 'CompanyUsersController@companyUserDelete'
]);

Route::post('/checkDomain', [
    'as' => 'checkDomain',
    'uses' => 'DomainChecker@domainChecker'
]);

Route::post('/companylogin', [
    'as' => 'postCompanylogin',
    'uses' => 'DomainChecker@postCompanyLogin'
]);


Route::group(['middleware' => 'setDbConn'], function (){
    Route::get('/companyHome', [
        'as' => 'companyHome',
        'uses' => 'DomainChecker@companyHome'
    ]);

    Route::post('/saveLog', [
        'as' => 'saveLog',
        'uses' => 'CompanyUsersController@saveLog'
    ]);
});
