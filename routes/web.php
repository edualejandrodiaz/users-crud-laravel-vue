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


Route::get('/', 'HomeController@landing')->name('landing')->middleware('guest');


Auth::routes();


//Products

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/workers', 'Front\Worker\WorkerController@index')->name('workers');

});


/*** Routes login admin
 *
 **/
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.auth');

// Password Admin Reset Routes
Route::get('admin/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

/**Cambio de Password */
Route::post('admin/enlace','Auth\AdminForgotPasswordController@enlace')->name('admin.enlace');

Route::get('admin/clave/{token}', 'Auth\AdminForgotPasswordController@clave')->name('admin.clave');

Route::post('admin/password/reset', 'Auth\AdminForgotPasswordController@cambiar')->name('admin.password.reset');
/**FIn cambio password */

Route::post('admin/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

Route::get('admin/password/reset-form/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset-form');



Route::get('admin/success-resetpass', 'Auth\AdminResetPasswordController@ResetSuccess')->name('admin.password.reset.success');
