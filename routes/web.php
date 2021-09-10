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

Route::get('/management-dropdown', 'HomeController@managementDropdown')->name('management.dropdown');
Route::get('/get-permission', 'HomeController@getPermission')->name('get.permission');
Route::get('/get-service', 'HomeController@getService')->name('get.service');
Route::get('/get-extras', 'HomeController@getExtras')->name('get.extras');
Route::get('/get-booking-customer', 'HomeController@getBookingCustomer')->name('get.booking.customer');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/manage-permission', 'DashboardController@managePermission')->name('manage.permission');

    Route::prefix('bookings')->name('booking.')->group(function () {
        Route::get('/list', 'BookingController@list')->name('list');
        Route::post('/get', 'BookingController@get')->name('get');
        Route::post('/get-by-date', 'BookingController@getByDate')->name('get.by.date');
        Route::get('/add', 'BookingController@add')->name('add');
        Route::get('/edit/{id?}', 'BookingController@edit')->name('edit');
        Route::post('/save/{id?}', 'BookingController@save')->name('save');
        Route::get('/delete/{id?}', 'BookingController@delete')->name('delete');
    });

    Route::prefix('events')->name('event.')->group(function () {
        Route::get('/list', 'EventController@list')->name('list');
        Route::get('/add', 'EventController@add')->name('add');
        Route::get('/edit/{id?}', 'EventController@edit')->name('edit');
        Route::post('/save/{id?}', 'EventController@save')->name('save');
        Route::get('/delete/{id?}', 'EventController@delete')->name('delete');
    });

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/list', 'ManageUserController@list')->name('list');
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
        Route::get('/delete/{id?}', 'RoleController@delete')->name('delete');
    });

    Route::prefix('permissions')->name('permission.')->group(function () {
        Route::get('/', 'PermissionController@list')->name('list');
        Route::get('/add', 'PermissionController@add')->name('add');
        Route::get('/edit/{id?}', 'PermissionController@edit')->name('edit');
        Route::post('/save/{id?}', 'PermissionController@save')->name('save');
    });

    Route::prefix('extras')->name('extra.')->group(function () {
        Route::get('/list', 'ExtrasController@list')->name('list');
        Route::get('/add', 'ExtrasController@add')->name('add');
        Route::get('/edit/{id?}', 'ExtrasController@edit')->name('edit');
        Route::post('/save/{id?}', 'ExtrasController@save')->name('save');
        Route::post('/delete/{id?}', 'ExtrasController@delete')->name('delete');
    });

    Route::prefix('coworking')->name('coworking.')->group(function () {
        Route::get('/space', 'CoworkingController@list')->name('list');
        Route::get('/add', 'CoworkingController@add')->name('add');
        Route::get('/edit/{id?}', 'CoworkingController@edit')->name('edit');
        Route::post('/save/{id?}', 'CoworkingController@save')->name('save');
        Route::get('/page', 'CoworkingController@page_coworking')->name('page');
    });

    Route::prefix('location')->name('location.')->group(function () {
        Route::get('/', 'LocationController@list')->name('list');
        Route::get('/add', 'LocationController@add')->name('add');
        Route::get('/edit/{id?}', 'LocationController@edit')->name('edit');
        Route::post('/save/{id?}', 'LocationController@save')->name('save');
        Route::get('/delete/{id?}', 'LocationController@delete')->name('delete');
    });

    Route::prefix('book-categories')->name('book.category.')->group(function () {
        Route::get('/', 'BookCategoryController@list')->name('list');
        Route::get('/add', 'BookCategoryController@add')->name('add');
        Route::get('/edit/{id?}', 'BookCategoryController@edit')->name('edit');
        Route::post('/save/{id?}', 'BookCategoryController@save')->name('save');
        Route::get('/delete/{id?}', 'BookCategoryController@delete')->name('delete');
    });

    Route::prefix('book-authors')->name('book.author.')->group(function () {
        Route::get('/', 'BookAuthorController@list')->name('list');
        Route::get('/add', 'BookAuthorController@add')->name('add');
        Route::get('/edit/{id?}', 'BookAuthorController@edit')->name('edit');
        Route::post('/save/{id?}', 'BookAuthorController@save')->name('save');
        Route::get('/delete/{id?}', 'BookAuthorController@delete')->name('delete');
    });

    Route::prefix('books')->name('book.')->group(function () {
        Route::get('/list', 'BookController@list')->name('list');
        Route::get('/add', 'BookController@add')->name('add');
        Route::get('/edit/{id?}', 'BookController@edit')->name('edit');
        Route::post('/save/{id?}', 'BookController@save')->name('save');
        Route::get('/delete/{id?}', 'BookController@delete')->name('delete');
    });

    Route::prefix('equipments')->name('equipment.')->group(function () {
        Route::get('/list', 'EquipmentController@list')->name('list');
        Route::get('/add', 'EquipmentController@add')->name('add');
        Route::get('/edit/{id?}', 'EquipmentController@edit')->name('edit');
        Route::post('/save/{id?}', 'EquipmentController@save')->name('save');
        Route::get('/delete/{id?}', 'EquipmentController@delete')->name('delete');
    });

});
