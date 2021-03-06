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

Auth::routes();

Route::group(['middleware' => ['auth','sessionData']], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('permissions', 'PermissionController');

    Route::resource('roles', 'RoleController');

    Route::resource('admin-users', 'AdminUserController');

    Route::resource('organizations', 'OrganizationController');

    Route::resource('students', 'StudentController');

    Route::resource('sections', 'SectionController');

    Route::resource('org-admin', 'SchoolAdminUserController');

    Route::get('/getClassDetailsMappedWithOrg','SectionController@getClassDetailsMappedWithOrg')->name('getClassDetailsMappedWithOrg');

    Route::resource('teachers','TeacherController');
});
