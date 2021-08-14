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
Route::get('/user-role', function () {
    return view('back.roles.page-userrole');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', 'ManageUserController@list')->name('list');
        Route::post('/save', 'ManageUserController@save')->name('save');
        Route::get('/delete/{id}', 'ManageUserController@delete')->name('delete');
    });


    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/', 'RoleController@list')->name('list');
    });
    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/', 'RoleController@list')->name('list');
        Route::post('/permissions', 'RoleController@permissions')->name('permissions');
    });
    Route::prefix('coworking')->name('coworking.')->group(function () {
        Route::get('/list', 'CoworkingController@list')->name('list');
        Route::get('/page', 'CoworkingController@page_coworking')->name('page');
        Route::post('/save', 'CoworkingController@save')->name('save');
    });
    Route::prefix('extra')->name('extra.')->group(function () {

        Route::post('/save', 'CoworkingExtraController@save')->name('save');
        Route::get('/delete/{id}', 'CoworkingExtraController@delete')->name('delete');
    });
    Route::prefix('location')->name('location.')->group(function () {
        Route::get('/list', 'LocationController@list')->name('list');

        Route::post('/save', 'LocationController@save')->name('save');
        Route::get('/delete/{id}', 'LocationController@delete')->name('delete');
    });

});
