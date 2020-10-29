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

//LOGIN
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('beranda', 'BerandaController@index');

//PROGNOSIS
Route::prefix('prognosis')->group(function () {
	//KODE KEGIATAN
    Route::post('kode-kegiatan/organisasi', 'Prognosis\KodeKegiatanController@getOrganisasi');
	Route::post('kode-kegiatan/kode-program', 'Prognosis\KodeKegiatanController@getKodeProgram');
	Route::get('kode-kegiatan/kode-program', 'Prognosis\KodeKegiatanController@getListKodeProgram');
    Route::resource('kode-kegiatan', 'Prognosis\KodeKegiatanController');
	//KODE RINCIAN OBJEK
    Route::post('kode-rincian-objek/organisasi', 'Prognosis\KodeRincianObjekController@getOrganisasi');
	Route::post('kode-rincian-objek/kode-rincian-objek', 'Prognosis\KodeRincianObjekController@getKodeRincianObjek');
	Route::get('kode-rincian-objek/kode-rincian-objek', 'Prognosis\KodeRincianObjekController@getListKodeRincianObjek');
	Route::post('kode-rincian-objek/kode-kegiatan', 'Prognosis\KodeRincianObjekController@getKodeKegiatan');
	Route::get('kode-rincian-objek/kode-kegiatan', 'Prognosis\KodeRincianObjekController@getListKodeKegiatan');
    Route::resource('kode-rincian-objek', 'Prognosis\KodeRincianObjekController');
    //KONVERT KODE AKUN PROGNOSIS
    Route::resource('konvert-akun-prognosis', 'Prognosis\KonvertAkunPrognosisController');
    //LAPORAN
    Route::get('laporan/lra-prognosis-sap', 'Prognosis\LaporanController@formLraPrognosisSap');
    Route::post('laporan/lra-prognosis-sap', 'Prognosis\LaporanController@printLraPrognosisSap');
    Route::get('laporan/lra-prognosis-permen', 'Prognosis\LaporanController@formLraPrognosisPermen');
    Route::post('laporan/lra-prognosis-permen', 'Prognosis\LaporanController@printLraPrognosisPermen');
    Route::get('laporan/lra-rincian-prognosis', 'Prognosis\LaporanController@formLraRincianPrognosis');
    Route::post('laporan/lra-rincian-prognosis', 'Prognosis\LaporanController@printLraRincianPrognosis');
    Route::get('laporan/lra-penjabaran-prognosis', 'Prognosis\LaporanController@formLraPenjabaranPrognosis');
    Route::post('laporan/lra-penjabaran-prognosis', 'Prognosis\LaporanController@printLraPenjabaranPrognosis');
});

Route::prefix('entry-data')->group(function () {
    Route::get('skpd/akuntansi/posting/jurnal', 'EntryData\SKPD\Akuntansi\PostingController@tabelJurnal');
    Route::post('skpd/akuntansi/posting/jurnal', 'EntryData\SKPD\Akuntansi\PostingController@simpanJurnal');
    Route::resource('skpd/akuntansi/posting', 'EntryData\SKPD\Akuntansi\PostingController');
});

//KONSOLIDASI
Route::prefix('konsolidasi')->group(function () {
    //PROGNOSIS
    Route::get('prognosis/lra-prognosis-sap', 'Konsolidasi\LaporanPrognosisController@formLraPrognosisSap');
    Route::post('prognosis/lra-prognosis-sap', 'Konsolidasi\LaporanPrognosisController@printLraPrognosisSap');
    Route::get('prognosis/lra-prognosis-permen', 'Konsolidasi\LaporanPrognosisController@formLraPrognosisPermen');
    Route::post('prognosis/lra-prognosis-permen', 'Konsolidasi\LaporanPrognosisController@printLraPrognosisPermen');
});

Route::prefix('pengaturan')->group(function () {
    //TANDA TANGAN
    Route::get('laporan/tanda-tangan', 'Pengaturan\LaporanController@formTandaTangan');
    Route::post('laporan/tanda-tangan', 'Pengaturan\LaporanController@updateTandaTangan');
});

//helper
Route::get('convert-kd-kegiatan', 'Helper\ConvertController@converKodeKegiatan');

