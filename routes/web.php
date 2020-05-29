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

Route::get('/', function () {
    return view('welcome');
});

    Route::post('/createPerson', 'PersonController@createPerson');
    Route::post('/login', 'UserController@login');
    Route::put('/updatePerson/{id}', 'PersonController@updatePerson');
    Route::get('/searchPerson/{id}', 'PersonController@searchPerson');
    Route::get('/searchPersonByUserId/{id}', 'PersonController@searchPersonByUserId');
    Route::delete('/deletePerson/{id}', 'PersonController@deletePerson');

    Route::get('/plan/{id}','PlanController@getPlan');
    Route::get('/ingredients','IngredientsController@ingredients');

