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

Route::get('/management-dropdown', 'HomeController@managementDropdown')->name('management.dropdown');
Route::get('/get-permission', 'HomeController@getPermission')->name('get.permission');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/manage-permission', 'DashboardController@managePermission')->name('manage.permission');

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', 'ManageUserController@list')->name('list');
        Route::get('/add', 'ManageUserController@add')->name('add');
        Route::get('/edit/{id?}', 'ManageUserController@edit')->name('edit');
        Route::post('/save/{id?}', 'ManageUserController@save')->name('save');
        Route::get('/delete/{id?}', 'ManageUserController@delete')->name('delete');
    });

    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/', 'RoleController@list')->name('list');
        Route::get('/add', 'RoleController@add')->name('add');
        Route::get('/edit/{id?}', 'RoleController@edit')->name('edit');
        Route::post('/save/{id?}', 'RoleController@save')->name('save');
    });

    Route::prefix('permissions')->name('permission.')->group(function () {
        Route::get('/', 'PermissionController@list')->name('list');
        Route::get('/add', 'PermissionController@add')->name('add');
        Route::get('/edit/{id?}', 'PermissionController@edit')->name('edit');
        Route::post('/save/{id?}', 'PermissionController@save')->name('save');
    });

    Route::prefix('coworking')->name('coworking.')->group(function () {
        Route::get('/space', 'CoworkingController@list')->name('list');
        Route::get('/add', 'CoworkingController@add')->name('add');
        Route::get('/edit/{id?}', 'CoworkingController@edit')->name('edit');
        Route::post('/save/{id?}', 'CoworkingController@save')->name('save');
        Route::get('/page', 'CoworkingController@page_coworking')->name('page');
    });

    Route::prefix('extra')->name('extra.')->group(function () {

        Route::post('/save', 'CoworkingExtraController@save')->name('save');
        Route::get('/delete/{id}', 'CoworkingExtraController@delete')->name('delete');
    });

    Route::prefix('location')->name('location.')->group(function () {
        Route::get('/', 'LocationController@list')->name('list');
        Route::get('/add', 'LocationController@add')->name('add');
        Route::get('/edit/{id?}', 'LocationController@edit')->name('edit');
        Route::post('/save/{id?}', 'LocationController@save')->name('save');
        Route::get('/delete/{id}', 'LocationController@delete')->name('delete');
    });

});
