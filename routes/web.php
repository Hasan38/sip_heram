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
    return view('auth.login');
});

Auth::routes();


Route::group(["prefix"=>"/sip-admin"], function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('upload', [App\Http\Controllers\UploadController::class, 'store']);

Route::group(["prefix"=>"/setting"], function(){
    Route::get("operator", [App\Http\Controllers\Admin\Setting\SettingController::class,'User'])->name('setting-operator');
    Route::get("jenis_izin", [App\Http\Controllers\Admin\Setting\SettingController::class,'JenisIzin'])->name('setting-jenis_izin');
    Route::get("persyaratan_izin", [App\Http\Controllers\Admin\Setting\SettingController::class,'PersyaratanIzin'])->name('setting-persyaratan_izin');
    Route::get("kelurahan", [App\Http\Controllers\Admin\Setting\SettingController::class,'Kelurahan'])->name('setting-kelurahan');

});

Route::group(["prefix"=>"/pendaftaran"], function(){
    Route::get("pemohon", [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'Pemohon'])->name('pendaftaran-pemohon');
    Route::get("pengajuan", [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'Pengajuan'])->name('pendaftaran-pengajuan');
    Route::get("list-pengajuan", [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'ListPengajuan'])->name('pendaftaran-list-pengajuan');
    Route::get('list-pengajuan/{pengajuan_id}/edit', [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'edit'])->name('pendaftaran-edit-pengajuan');
});

Route::group(["prefix"=>"/loket"], function(){
    Route::get("pemohon", [App\Http\Controllers\Loket\LoketController::class,'Pemohon'])->name('loket-pemohon');
    //Route::get("pengajuan", [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'Pengajuan'])->name('pendaftaran-pengajuan');
    Route::get("list-pengajuan", [App\Http\Controllers\Loket\LoketController::class,'ListPengajuan'])->name('loket-list-pengajuan');
    //Route::get('list-pengajuan/{pengajuan_id}/edit', [App\Http\Controllers\Pendaftaran\PendaftaranController::class,'edit'])->name('pendaftaran-edit-pengajuan');
});


});

Route::get("/storage-link", function () {
    $targetFolder = storage_path("app/public");
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});
Route::get('/clear-route', function() {
    $exitCode = Artisan::call('route:clear');
     return '<h1>Route facade value cleared</h1>';
});