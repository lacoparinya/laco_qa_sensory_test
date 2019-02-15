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

Route::get('/', 'SensoryMastersController@index');

Auth::routes();

Route::resource('qa-sample-datas', 'QaSampleDatasController');
Route::resource('sensory-masters', 'SensoryMastersController');
Route::resource('sensory-tests', 'SensoryTestsController');
Route::resource('groups', 'GroupsController');
Route::resource('users', 'UsersController');

Route::get('/qa/upload', 'QaSampleDatasController@upload');
Route::post('/qa/uploadAction', 'QaSampleDatasController@uploadAction');
Route::get('/sensory/generate', 'SensoryMastersController@generateTest');
Route::post('/sensory/generateAction', 'SensoryMastersController@generateTestAction');
Route::get('/sensory/editset/{id}', 'SensoryMastersController@editset');
Route::post('/sensory/editsetAction/{id}', 'SensoryMastersController@editsetAction');
Route::get('/sensory/startTest/{id}', 'SensoryMastersController@startTest');
Route::get('/sensory/stopTest/{id}', 'SensoryMastersController@stopTest');
Route::get('/sensory/endTest/{id}', 'SensoryMastersController@endTest');
Route::get('/sensory/printform/{id}', 'SensoryMastersController@printform');


Route::get('/sensory/submitTest/{id}', 'SensoryMastersController@submitTest');
Route::post('/sensory/submitAction/{id}', 'SensoryMastersController@submitTestAction');
Route::get('/sensory/runtest/{id}', 'SensoryTestsController@runtest');
Route::post('/sensory/runtestAction/{id}', 'SensoryTestsController@runtestAction');
Route::get('/sensory/edittest/{id}', 'SensoryTestsController@edittest');
Route::post('/sensory/edittestAction/{id}', 'SensoryTestsController@edittestAction');
Route::get('/sensory/viewtest/{id}', 'SensoryTestsController@viewtest');
Route::get('/sensory/sendtest/{id}', 'SensoryTestsController@sendtest');
Route::get('/sensory/listsurvey/{id}', 'SensoryTestsController@listsurvey');

Route::get('/reports/summaryreport/{id}', 'ReportsController@summaryreport');

