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

// メインページ
Route::get('/', 'MainPageController@index')->name('mainPage');


// メンテナンスページ
Route::group(['middleware' => 'ipLimit'], function () {
    Route::get('mainte', 'MaintenancePageController@index')->name('maintenancePage');
    Route::get('apitest', 'MaintenancePageController@apitest')->name('apiTestPage');
});
