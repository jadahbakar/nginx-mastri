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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login-post');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('beranda', 'BerandaController@index')->name('beranda');

Route::resource('data-sp2d', 'DataSp2dController');
Route::resource('data-spj', 'DataSpjController');

Route::post('laporan', 'LaporanController@cetak')->name('cetak-laporan');
Route::get('laporan', 'LaporanController@index');

Route::post('user/cek-validasi', 'UserController@cekValidasi');
Route::resource('user', 'UserController');

Route::post('ganti-password', 'LainLainController@updatePassword')->name('ganti-password');
Route::get('ganti-password', 'LainLainController@formGantiPassword');
