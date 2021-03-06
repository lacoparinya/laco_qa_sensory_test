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
Route::resource('qa-samplings', 'QaSamplingsController');
Route::resource('test-suits', 'TestSuitsController');

Route::get('/qasample/upload', 'QaSamplingsController@upload');
Route::post('/qasample/uploadAction', 'QaSamplingsController@uploadAction');
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
Route::get('/reports/xlssummaryreport/{id}', 'ReportsController@xlsreport');
Route::get('/reports/rangereport', 'ReportsController@rangereport');
Route::post('/reports/rangereportAction', 'ReportsController@rangereportAction');

Route::get('/test-suits/changeStatus/{id}/{status}', 'TestSuitsController@changeStatus');
Route::get('/test-suits/runtest/{test_suit_m_id}', 'TestSuitsController@runtest');
Route::post('/test-suits/runtestAction/{test_suit_m_id}', 'TestSuitsController@runtestAction');
Route::get('/test-suits/confirmtest/{ans_suit_m_id}', 'TestSuitsController@confirmtest');
Route::get('/test-suits/confirmtestAction/{ans_suit_m_id}', 'TestSuitsController@confirmtestAction');
Route::get('/test-suits/edittest/{ans_suit_m_id}', 'TestSuitsController@edittest');
Route::post('/test-suits/edittestAction/{ans_suit_m_id}', 'TestSuitsController@edittestAction');
Route::get('/test-suits/showResult/{test_suit_m_id}', 'TestSuitsController@showResult');
Route::get('/test-suits/exportExcel/{test_suit_m_id}', 'TestSuitsController@exportExcel');
Route::get('/test-suits/printform/{id}', 'TestSuitsController@printform');

Route::get('storage/capture/{id}/{filename}', function ($id,$filename) {
    $path = storage_path( 'app/capture/' . $id .'/'. $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});