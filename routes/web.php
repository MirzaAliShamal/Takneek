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
    
});
