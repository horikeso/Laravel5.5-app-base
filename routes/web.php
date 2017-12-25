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

Route::group(['prefix' => 'sample'], function () {

    // /sample/segment/id
    Route::get('{segment}/{id}', [
        'as' => 'sampleIndex',
        'uses' => 'SampleController@index'
    ])->where([
        'id' => '[0-9]+',
    ]);

    Route::post('execute', [
        'as' => 'sampleExecute',
        'uses' => 'SampleController@execute'
    ]);

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/sample/dashbord', 'SampleController@dashbord');
});
