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

//Auth Routes
Route::auth();

//Home Route
Route::get('/home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

//Create New Company Route
Route::get('/company', [
    'as' => 'company',
    'uses' => 'CompanyController@index'
]);

//View Company Detail Route
Route::get('/companydetail/{id}', [
    'as' => 'companydetail',
    'uses' => 'CompanyController@show'
]);

//Edit Company Info Route
Route::get('/companyinfo/{id}', [
    'as' => 'companyinfo',
    'uses' => 'CompanyController@edit'
]);

//Check Sub-domain Route
Route::get('/domain', [
    'as' => 'domain',
    'uses' => 'DomainChecker@index'
]);

//View Company User Information Route
Route::get('/user/{id}', [
    'as' => 'user',
    'uses' => 'CompanyController@adduser'
]);

//Company User Login Route
Route::get('/companylogin', [
    'as' => 'companylogin',
    'uses' => 'DomainChecker@companyUserLogin'
]);

// Post Routes

//Post Route to register new company
Route::post('/registerCompany', [
    'as' => 'registerCompany',
    'uses' => 'CompanyController@store'
]);

//Post Route to update company info
Route::post('/updateCompany', [
    'as' => 'updateCompany',
    'uses' => 'CompanyController@update'
]);

//Post Route to create company user
Route::post('/companyUser', [
    'as' => 'companyUser',
    'uses' => 'CompanyUsersController@store'
]);

//Post Route to delete company
Route::post('/companyDelete', [
    'as' => 'companyDelete',
    'uses' => 'CompanyController@companyDelete'
]);

//Post Route to delete company user
Route::post('/companyUserDelete', [
    'as' => 'companyUserDelete',
    'uses' => 'CompanyUsersController@companyUserDelete'
]);

//Post Route to check sub-domain
Route::post('/checkDomain', [
    'as' => 'checkDomain',
    'uses' => 'DomainChecker@domainChecker'
]);

//Post Route to login company user
Route::post('/companylogin', [
    'as' => 'postCompanylogin',
    'uses' => 'DomainChecker@postCompanyLogin'
]);

//Company User after login routes group
Route::group(['middleware' => 'setDbConn'], function (){
    //Company Home Route
    Route::get('/companyHome', [
        'as' => 'companyHome',
        'uses' => 'DomainChecker@companyHome'
    ]);

    //Save Company user Log Route
    Route::post('/saveLog', [
        'as' => 'saveLog',
        'uses' => 'CompanyUsersController@saveLog'
    ]);
});
