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

Route::group(['prefix' => 'sample'], function () {

    // /sample/segment/id
    Route::get('{segment}/{id}', 'SampleController@index')->where(['id' => '[0-9]+'])->name('sampleIndex');
    Route::post('execute', 'SampleController@execute')->name('sampleExecute');

});


Route::get('/', function () {
    return view('welcome');
});

// front auth
Auth::routes();// Authentication Routes... Registration Routes... Password Reset Routes...
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/backend', function () {
    return view('backend.welcome');
});

// backend auth
Route::group(['prefix' => 'backend'], function() {

    // Authentication Routes...
    $this->get('login', 'BackendAuth\LoginController@showLoginForm')->name('backend.login');
    $this->post('login', 'BackendAuth\LoginController@login');
    $this->post('logout', 'BackendAuth\LoginController@logout')->name('backend.logout');

    // Registration Routes...
    $this->get('register', 'BackendAuth\RegisterController@showRegistrationForm')->name('backend.register');
    $this->post('register', 'BackendAuth\RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'BackendAuth\ForgotPasswordController@showLinkRequestForm')->name('backend.password.request');
    $this->post('password/email', 'BackendAuth\ForgotPasswordController@sendResetLinkEmail')->name('backend.password.email');
    $this->get('password/reset/{token}', 'BackendAuth\ResetPasswordController@showResetForm')->name('backend.password.reset');
    $this->post('password/reset', 'BackendAuth\ResetPasswordController@reset');

    // can:admin 権限判定（admin Gateを通過したユーザーのみアクセス可能）
    Route::group(['middleware' => ['auth:backend_web', 'can:admin']], function () {
        Route::get('home', 'BackendHomeController@index')->name('backend.home');
    });
});