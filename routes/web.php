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

/* Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); */

Route::get('/', function () { return view('auth/login'); });
Route::get('/home', 'IndexController@index')->name('index');
Auth::routes();

//Route::get('/users', 'Manage\UserController@index')->name('manage.users');

Route::prefix('manage')->group(function(){
    Route::get('/', 'Manage\UserController@index');
    Route::resource('/users', 'Manage\UserController');
    Route::post('/update-user/{id}', 'Manage\UserController@update_user')->name('update.user');
    Route::get('/password-reset/{id}', 'Manage\UserController@password_reset')->name('password.reset');
    Route::get('/activate/{id}', 'Manage\UserController@activation')->name('activate.user');
    Route::get('/deactivate/{id}', 'Manage\UserController@deactivation')->name('deactivate.user');

    Route::get('/activity-logs', 'Manage\LogsController@index')->name('activity.logs');
    /* Route::get('/roles', 'Manage\RoleController@index')->name('manage.roles');
    Route::get('/permissions', 'Manage\PermissionController@index')->name('manage.permissions');*/
});

Route::prefix('equipment')->group(function(){
    Route::get('/', 'Equipment\OperationController@index');

    Route::resource('/management', 'Equipment\ManagementController');
    Route::post('/update-equipment/{id}', 'Equipment\ManagementController@update')->name('equipment.update.equipment');

    //equipment classification
    Route::post('/management/equipment-store-classification', 'Equipment\ManagementController@store_classification')->name('equipment.store.classification');
    Route::get('/classification', 'Equipment\ManagementController@load_classification')->name('equipment.load.classification');
    Route::post('/update-classification/{id}', 'Equipment\ManagementController@update_classification')->name('equipment.update.classification');

    //equipment operations
    Route::resource('/operations', 'Equipment\OperationController');
    Route::get('/view-operations/{id}', 'Equipment\OperationController@get_index')->name('equipment.load.index');

    //>>issuance
    Route::get('/issuance/{id}', 'Equipment\OperationController@load_issuance')->name('equipment.load.issuance');
    Route::get('/add-equipment/{id}', 'Equipment\OperationController@add_equipment')->name('equipment.add.equipment');
    Route::delete('/remove-equipment', 'Equipment\OperationController@remove_equipment')->name('equipment.remove.equipment');
    Route::post('/store-new-issuance/{id}', 'Equipment\OperationController@store_issuance')->name('equipment.store.issuance');

    //>>turnin
    Route::get('/turn-in/{id}', 'Equipment\OperationController@load_turnin')->name('equipment.load.turnin');
    Route::post('/store-new-turn-in/{id}', 'Equipment\OperationController@store_turnin')->name('equipment.store.turnin');

    //>>report
    Route::get('/report/{id}', 'Equipment\OperationController@load_report')->name('equipment.load.report');
    Route::post('/store-new-report/{id}', 'Equipment\OperationController@store_report')->name('equipment.store.report');

    //reports
    Route::get('/report/equipment/status', 'Equipment\ReportController@load_equipment_status')->name('equipment.report.equipment');
    Route::get('/report/inventory/status', 'Equipment\ReportController@load_inventory_status')->name('equipment.report.inventory');

});