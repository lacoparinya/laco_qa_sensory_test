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
    return view('welcome');
});

Route::resource('qa-sample-datas', 'QaSampleDatasController');
Route::resource('sensory-masters', 'SensoryMastersController');
Route::resource('sensory-tests', 'SensoryTestsController');

Route::get('/qa/upload', 'QaSampleDatasController@upload');
Route::post('/qa/uploadAction', 'QaSampleDatasController@uploadAction');
Route::get('/sensory/generate', 'SensoryMastersController@generateTest');
Route::post('/sensory/generateAction', 'SensoryMastersController@generateTestAction');
Route::get('/sensory/submitTest/{id}', 'SensoryMastersController@submitTest');
Route::post('/sensory/submitAction/{id}', 'SensoryMastersController@submitTestAction');
Route::get('/sensory/runtest/{id}', 'SensoryTestsController@runtest');
Route::post('/sensory/runtestAction/{id}', 'SensoryTestsController@runtestAction');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
