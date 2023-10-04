<?php

use App\Http\Controllers\AnggotaGroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\GroupWaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\SendWaController;
use App\Http\Controllers\TendikController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
Route::resource('dosen', DosenController::class)->middleware('auth');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::post('/import-mahasiswa', [MahasiswaController::class, 'importData'])->name('upload-mahasiswa');
Route::post('/import-dosen', [DosenController::class, 'importDosen'])->name('upload-dosen');
Route::resource('sendWa', SendWaController::class)->middleware('auth');
Route::resource('prodi', ProgramStudiController::class)->middleware('auth');
Route::post('upload-prodi', [ProgramStudiController::class, 'import_prodi'])->name('upload-prodi')->middleware('auth');
Route::resource('kontak', KontakController::class)->middleware('auth');
Route::post('kontak/{kontak}/update-alumni',[KontakController::class,'updateAlumni']);
Route::controller(KontakController::class)->group(function () {
    Route::post('import-kontak', 'importData')->name('upload-kontak');
    Route::get('kontak-sync', 'dataSync')->name('kontak-sync');
    Route::get('getCount', 'getCount')->name('gets.counts');
    Route::get('mhsSync', 'syncMahasiswa')->name('mahasiswa-sync');
    Route::get('dosenSync', 'syncDosen')->name('dosen-sync');
    Route::get('tendikSync', 'syncTendik')->name('tendik-sync');
    Route::get('getDosen', 'getDosen')->name('getDosen');
    Route::get('getPegawai', 'getPegawai')->name('getPegawai');
    Route::get('getMahasiswa', 'getMahasiswa')->name('getMahasiswa');
    Route::get('getNon', 'getNon')->name('getNonKontak');
})->middleware('auth');
// Route::post('/import-kontak',[KontakController::class,'importData'])->name('upload-kontak');
Route::resource('local', LocalController::class)->middleware('auth');
Route::resource('tendik', TendikController::class)->middleware('auth');
Route::controller(TendikController::class)->group(function () {
    Route::post('/import-tendik', 'import')->name('import-tendik');
})->middleware('auth');
Route::get('reload-tendik', [TendikController::class, 'reload'])->name('tendik-reload');
Route::resource('anggotaGroup', AnggotaGroupController::class)->middleware('auth');
Route::get('/anggotaGroup/{anggotaGroup}/get-data', [AnggotaGroupController::class, 'getData'])->name('anggota.getData');
Route::resource('groupWa', GroupWaController::class)->middleware('auth');
Route::controller(GroupWaController::class)->group(function () {
    Route::get('/get-Dosen/{group_id}', 'getDosen')->name('get-dosen');
    Route::get('/get-anggota/{group_id}', 'getAnggota')->name('get-data');
    Route::get('/get-Pegawai/{group_id}', 'getPegawai')->name('get-pegawai');
    Route::get('/get-Mahasiswa/{group_id}', 'getMahasiswa')->name('get-mahasiswa');
    Route::get('/get-Non/{group_id}', 'getAnggota')->name('get-non');
    Route::get('/get-data', 'getGroup')->name('data-group');
});
// Route::get('get-data',[GroupWaController::class,'getGroup'])->name('data-group');
// Route::get('/getAnggota/{group_id}',[GroupWaController::class,'getAnggota'])->name('get-data');
