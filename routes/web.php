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

//https://www.itsolutionstuff.com/post/laravel-6-auth-login-with-username-or-email-tutorialexample.html (login using username tutorial)

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('myLogout');
Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Lesen Memburu
Route::get('/lesen/memburu',[App\Http\Controllers\LesenController::class,'index'])->middleware();
Route::post('/lesen/memburu/loadLesenDatatable', [App\Http\Controllers\LesenController::class,'loadLesenDatatable'])->middleware();
Route::get('/lesen/memburu/view/{id}', [App\Http\Controllers\LesenController::class,'viewEditLesen'])->middleware();
Route::post('/lesen/memburu/view/postSaveSubmit', [App\Http\Controllers\LesenController::class,'postSaveSubmit'])->middleware();
Route::post('/lesen/memburu/view/postSaveSpeciesBuruan', [App\Http\Controllers\LesenController::class,'postSaveSpeciesBuruan'])->middleware();
Route::post('/lesen/memburu/view/postDeleteSpesies', [App\Http\Controllers\LesenController::class,'postDeleteSpesies'])->middleware();
Route::get('/lesen/memburu/baru',[App\Http\Controllers\LesenController::class,'lesenBaru'])->middleware();
Route::post('/lesen/memburu/new/postSaveSubmit', [App\Http\Controllers\LesenController::class,'postSaveSubmitNew'])->middleware();
Route::post('/lesen/memburu/postDeleteLesen', [App\Http\Controllers\LesenController::class,'postDeleteLesen'])->middleware();
Route::post('/lesen/memburu/view/postSaveDraft', [App\Http\Controllers\LesenController::class,'postSaveDraft'])->middleware();
Route::post('/lesen/memburu/new/postSaveDraftNew', [App\Http\Controllers\LesenController::class,'postSaveDraftNew'])->middleware();
Route::post('/lesen/memburu/view/postSahkan', [App\Http\Controllers\LesenController::class,'postSahkan'])->middleware();
Route::post('/lesen/memburu/view/postKembalikan', [App\Http\Controllers\LesenController::class,'postKembalikan'])->middleware();
Route::post('/lesen/memburu/view/postApprove', [App\Http\Controllers\LesenController::class,'postApprove'])->middleware();
Route::post('/lesen/memburu/view/postReject', [App\Http\Controllers\LesenController::class,'postReject'])->middleware();
Route::post('/lesen/memburu/view/postUpdateResitAm', [App\Http\Controllers\LesenController::class,'postUpdateResitAm'])->middleware();
Route::post('/lesen/memburu/view/postCheckKawasan', [App\Http\Controllers\LesenController::class,'postCheckKawasan'])->middleware();
Route::post('/lesen/memburu/postRenewPermit',[App\Http\Controllers\LesenController::class,'postRenewPermit'])->middleware();

//Lesen Pungutan Tumbuhan
Route::get('/lesen/tumbuhan', [App\Http\Controllers\LesenTumbuhanController::class,'index'])->middleware();
Route::post('/lesen/tumbuhan/loadLesenDatatable', [App\Http\Controllers\LesenTumbuhanController::class,'loadLesenDatatable'])->middleware();
Route::get('/lesen/tumbuhan/baru', [App\Http\Controllers\LesenTumbuhanController::class,'lesenBaru'])->middleware();
Route::post('/lesen/tumbuhan/new/postSaveSubmit', [App\Http\Controllers\LesenTumbuhanController::class,'postSaveSubmitNew'])->middleware();
Route::post('/lesen/tumbuhan/view/postSaveSubmit', [App\Http\Controllers\LesenTumbuhanController::class,'postSaveSubmit'])->middleware();
Route::post('/lesen/tumbuhan/view/postSaveSpeciesDipohon', [App\Http\Controllers\LesenTumbuhanController::class,'postSaveSpeciesDipohon'])->middleware();
Route::post('/lesen/tumbuhan/view/postDeleteSpesies', [App\Http\Controllers\LesenTumbuhanController::class,'postDeleteSpesies'])->middleware();
Route::get('/lesen/tumbuhan/view/{id}', [App\Http\Controllers\LesenTumbuhanController::class,'viewEditLesen'])->middleware();
Route::post('/lesen/tumbuhan/postDeleteLesen', [App\Http\Controllers\LesenTumbuhanController::class,'postDeleteLesen'])->middleware();
Route::post('/lesen/tumbuhan/view/postSaveDraft', [App\Http\Controllers\LesenTumbuhanController::class,'postSaveDraft'])->middleware();
Route::post('/lesen/tumbuhan/new/postSaveDraftNew', [App\Http\Controllers\LesenTumbuhanController::class,'postSaveDraftNew'])->middleware();
Route::post('/lesen/tumbuhan/view/postSahkan', [App\Http\Controllers\LesenTumbuhanController::class,'postSahkan'])->middleware();
Route::post('/lesen/tumbuhan/view/postKembalikan', [App\Http\Controllers\LesenTumbuhanController::class,'postKembalikan'])->middleware();
Route::post('/lesen/tumbuhan/view/postApprove', [App\Http\Controllers\LesenTumbuhanController::class,'postApprove'])->middleware();
Route::post('/lesen/tumbuhan/view/postReject', [App\Http\Controllers\LesenTumbuhanController::class,'postReject'])->middleware();
Route::post('/lesen/tumbuhan/view/postUpdateResitAm', [App\Http\Controllers\LesenTumbuhanController::class,'postUpdateResitAm'])->middleware();
Route::post('/lesen/tumbuhan/view/postCheckKawasan', [App\Http\Controllers\LesenTumbuhanController::class,'postCheckKawasan'])->middleware();
Route::post('/lesen/tumbuhan/postRenewPermit',[App\Http\Controllers\LesenTumbuhanController::class,'postRenewPermit'])->middleware();

//Users
Route::get('/pengguna',[App\Http\Controllers\PenggunaController::class,'index'])->middleware();
Route::post('/pengguna/loadUserDatatable', [App\Http\Controllers\PenggunaController::class,'loadUserDatatable'])->middleware();
Route::post('/pengguna/postNewUser',[App\Http\Controllers\PenggunaController::class,'postNewUser'])->middleware();
Route::post('/pengguna/postUpdateUser',[App\Http\Controllers\PenggunaController::class,'postUpdateUser'])->middleware();
Route::get('/permohonan/semak',[App\Http\Controllers\SemakController::class,'index']);
Route::post('/permohonan/semak/postGetInfo',[App\Http\Controllers\SemakController::class,'postGetInfo']);
Route::post('/pengguna/postDeleteUser',[App\Http\Controllers\PenggunaController::class,'postDeleteUser'])->middleware();

//General
Route::post('/lesen/postUpdatePejabatPembayaran',[App\Http\Controllers\GeneralController::class,'postUpdatePejabatPembayaran'])->middleware();

//Permit Penternakan
Route::get('/permit/penternakan', [App\Http\Controllers\PermitPenternakanController::class,'index'])->name('penternakan.index')->middleware();
Route::get('/permit/penternakan/baru',[App\Http\Controllers\PermitPenternakanController::class,'permohonan_baru'])->middleware();
Route::post('/permit/penternakan/postSubmitPermit',[App\Http\Controllers\PermitPenternakanController::class,'postSubmitPermit'])->middleware();
Route::post('/permit/penternakan/postSaveSpesis',[App\Http\Controllers\PermitPenternakanController::class,'postSaveSpesis'])->middleware();
Route::post('/permit/penternakan/loadPermitDatatable', [App\Http\Controllers\PermitPenternakanController::class,'loadPermitDatatable'])->middleware();
Route::get('/permit/penternakan/view/{id}', [App\Http\Controllers\PermitPenternakanController::class,'viewEditPermit'])->middleware();
Route::get('/permit/penternakan/download/{id}', [App\Http\Controllers\PermitPenternakanController::class,'downloadPermitFile'])->middleware();
Route::get('/permit/penternakan/deletefile/{id}', [App\Http\Controllers\PermitPenternakanController::class,'deletePermitFile'])->middleware();
Route::post('/permit/penternakan/postLoadSpesies',[App\Http\Controllers\PermitPenternakanController::class,'postLoadSpesies'])->middleware();
Route::post('/permit/penternakan/postSahkanBorang',[App\Http\Controllers\PermitPenternakanController::class,'postSahkanBorang'])->middleware();
Route::post('/permit/penternakan/postApproveBorang',[App\Http\Controllers\PermitPenternakanController::class,'postApprove'])->middleware();
Route::post('/permit/penternakan/postRejectBorang',[App\Http\Controllers\PermitPenternakanController::class,'postReject'])->middleware();
Route::post('/permit/penternakan/postKembaliBorang',[App\Http\Controllers\PermitPenternakanController::class,'postKembaliBorang'])->middleware();
Route::post('/permit/penternakan/postSubmitPermitSemula',[App\Http\Controllers\PermitPenternakanController::class,'postSubmitPermitSemula'])->middleware();
Route::post('/permit/postUpdateResitAm',[App\Http\Controllers\PermitPenternakanController::class,'postUpdateResitAm'])->middleware();
Route::post('/permit/postUploadPermitFile',[App\Http\Controllers\PermitPenternakanController::class,'postUploadPermitFile'])->middleware();
Route::post('/permit/postDeletePermitFile', [App\Http\Controllers\PermitPenternakanController::class,'deleteUserPermitFile'])->middleware();
Route::get('/permit/download/{id}', [App\Http\Controllers\PermitPenternakanController::class,'downloadFile'])->middleware();
Route::post('/permit/penternakan/postRenewPermit',[App\Http\Controllers\PermitPenternakanController::class,'postRenewPermit'])->middleware();
Route::post('/permit/postDeletePermit', [App\Http\Controllers\PermitPenternakanController::class,'postDeletePermit'])->middleware();
Route::get('/permit/penternakan/downloadLS/{id}', [App\Http\Controllers\PermitPenternakanController::class,'downloadLaporanSite'])->middleware();
Route::get('/permit/penternakan/deleteLS/{id}', [App\Http\Controllers\PermitPenternakanController::class,'deleteLaporanSite'])->middleware();

//Peniaga
Route::get('/permit/peniaga', [App\Http\Controllers\PermitPeniagaController::class,'index'])->name('peniaga.index')->middleware();
Route::post('/permit/perniagaan/loadBorangPeniaga', [App\Http\Controllers\PermitPeniagaController::class,'loadBorangPeniaga'])->middleware();
Route::get('/permit/peniaga/baru/{type}', [App\Http\Controllers\PermitPeniagaController::class,'new'])->middleware();
Route::post('/permit/perniagaan/postSubmitPeniagaHaiwan', [App\Http\Controllers\PermitPeniagaController::class,'postSubmitPeniagaHaiwan'])->middleware();
Route::post('/permit/perniagaan/postSubmitPeniagaDaging', [App\Http\Controllers\PermitPeniagaController::class,'postSubmitPeniagaDaging'])->middleware();
Route::post('/permit/perniagaan/postSubmitPeniagaTumbuhan', [App\Http\Controllers\PermitPeniagaController::class,'postSubmitPeniagaTumbuhan'])->middleware();
Route::post('/permit/perniagaan/postDeleteBorang', [App\Http\Controllers\PermitPeniagaController::class,'postDeleteBorang'])->middleware();
Route::get('/permit/peniaga/view/{type}/{id}', [App\Http\Controllers\PermitPeniagaController::class,'view'])->middleware();
Route::get('/permit/peniaga/download/{type}/{id}', [App\Http\Controllers\PermitPeniagaController::class,'downloadPermitFile'])->middleware();
Route::get('/permit/peniaga/deletefile/{type}/{id}', [App\Http\Controllers\PermitPeniagaController::class,'deletePermitFile'])->middleware();
Route::post('/permit/peniaga/postUpdatePeniagaHaiwan', [App\Http\Controllers\PermitPeniagaController::class,'postUpdatePeniagaHaiwan'])->middleware();
Route::post('/permit/peniaga/postUpdatePeniagaDaging', [App\Http\Controllers\PermitPeniagaController::class,'postUpdatePeniagaDaging'])->middleware();
Route::post('/permit/peniaga/postUpdatePeniagaTumbuhan', [App\Http\Controllers\PermitPeniagaController::class,'postUpdatePeniagaTumbuhan'])->middleware();
Route::post('/permit/perniagaan/postUpdateResitAm',[App\Http\Controllers\PermitPeniagaController::class,'postUpdateResitAm'])->middleware();
Route::post('/permit/perniagaan/postSahkanBorang',[App\Http\Controllers\PermitPeniagaController::class,'postSahkanBorang'])->middleware();
Route::post('/permit/perniagaan/postApproveBorang',[App\Http\Controllers\PermitPeniagaController::class,'postApprove'])->middleware();
Route::post('/permit/perniagaan/postRejectBorang',[App\Http\Controllers\PermitPeniagaController::class,'postReject'])->middleware();
Route::post('/permit/perniagaan/postReturn', [App\Http\Controllers\PermitPeniagaController::class,'postReturn'])->middleware();
Route::post('/permit/peniaga/postRenewPermit',[App\Http\Controllers\PermitPeniagaController::class,'postRenewPermit'])->middleware();


//Membawa Keluar
Route::get('/permit/membawakeluar', [App\Http\Controllers\PermitKeluarController::class,'index'])->middleware();
Route::get('/permit/membawakeluar/baru', [App\Http\Controllers\PermitKeluarController::class,'new'])->middleware();
Route::post('/permit/membawakeluar/postSubmit', [App\Http\Controllers\PermitKeluarController::class,'postSubmit'])->middleware();
Route::post('/permit/membawakeluar/postUpdate', [App\Http\Controllers\PermitKeluarController::class,'postUpdate'])->middleware();
Route::post('/permit/membawakeluar/loadBorang', [App\Http\Controllers\PermitKeluarController::class,'loadBorang'])->middleware();
Route::get('/permit/membawakeluar/view/{id}', [App\Http\Controllers\PermitKeluarController::class,'view'])->middleware();
Route::post('/permit/membawakeluar/postDeleteSpesis', [App\Http\Controllers\PermitKeluarController::class,'postDeleteSpesis'])->middleware();
Route::get('/permit/membawakeluar/download/{id}', [App\Http\Controllers\PermitKeluarController::class,'downloadSenaraiIc'])->middleware();
Route::get('/permit/membawakeluar/deletefile/{id}', [App\Http\Controllers\PermitKeluarController::class,'deleteSalinanIc'])->middleware();
Route::post('/permit/membawakeluar/postDeleteBorang', [App\Http\Controllers\PermitKeluarController::class,'postDeleteBorang'])->middleware();
Route::post('/permit/membawakeluar/postReturn', [App\Http\Controllers\PermitKeluarController::class,'postReturn'])->middleware();
Route::post('/permit/membawakeluar/postUpdateResitAm',[App\Http\Controllers\PermitKeluarController::class,'postUpdateResitAm'])->middleware();
Route::post('/permit/membawakeluar/postSahkanBorang',[App\Http\Controllers\PermitKeluarController::class,'postSahkanBorang'])->middleware();
Route::post('/permit/membawakeluar/postApproveBorang',[App\Http\Controllers\PermitKeluarController::class,'postApprove'])->middleware();
Route::post('/permit/membawakeluar/postRejectBorang',[App\Http\Controllers\PermitKeluarController::class,'postReject'])->middleware();
Route::post('/permit/membawakeluar/postRenewPermit',[App\Http\Controllers\PermitKeluarController::class,'postRenewPermit'])->middleware();

//Membawa Masuk
Route::get('/permit/membawamasuk', [App\Http\Controllers\PermitMasukController::class,'index'])->middleware();
Route::get('/permit/membawamasuk/baru', [App\Http\Controllers\PermitMasukController::class,'new'])->middleware();
Route::post('/permit/membawamasuk/postSubmit', [App\Http\Controllers\PermitMasukController::class,'postSubmit'])->middleware();
Route::post('/permit/membawamasuk/postUpdate', [App\Http\Controllers\PermitMasukController::class,'postUpdate'])->middleware();
Route::post('/permit/membawamasuk/loadBorang', [App\Http\Controllers\PermitMasukController::class,'loadBorang'])->middleware();
Route::get('/permit/membawamasuk/view/{id}', [App\Http\Controllers\PermitMasukController::class,'view'])->middleware();
Route::post('/permit/membawamasuk/postDeleteSpesis', [App\Http\Controllers\PermitMasukController::class,'postDeleteSpesis'])->middleware();
Route::post('/permit/membawamasuk/postDeleteBorang', [App\Http\Controllers\PermitMasukController::class,'postDeleteBorang'])->middleware();
Route::post('/permit/membawamasuk/postReturn', [App\Http\Controllers\PermitMasukController::class,'postReturn'])->middleware();
Route::post('/permit/membawamasuk/postUpdateResitAm',[App\Http\Controllers\PermitMasukController::class,'postUpdateResitAm'])->middleware();
Route::post('/permit/membawamasuk/postSahkanBorang',[App\Http\Controllers\PermitMasukController::class,'postSahkanBorang'])->middleware();
Route::post('/permit/membawamasuk/postApproveBorang',[App\Http\Controllers\PermitMasukController::class,'postApprove'])->middleware();
Route::post('/permit/membawamasuk/postRejectBorang',[App\Http\Controllers\PermitMasukController::class,'postReject'])->middleware();
Route::post('/permit/membawamasuk/postRenewPermit',[App\Http\Controllers\PermitMasukController::class,'postRenewPermit'])->middleware();

//Haiwan Tawanan
Route::get('/permit/haiwantawanan', [App\Http\Controllers\PermitTawananController::class,'index'])->middleware();
Route::get('/permit/haiwantawanan/baru', [App\Http\Controllers\PermitTawananController::class,'new'])->middleware();
Route::post('/permit/haiwantawanan/postSubmit', [App\Http\Controllers\PermitTawananController::class,'postSubmit'])->middleware();
Route::post('/permit/haiwantawanan/postUpdate', [App\Http\Controllers\PermitTawananController::class,'postUpdate'])->middleware();
Route::post('/permit/haiwantawanan/loadBorang', [App\Http\Controllers\PermitTawananController::class,'loadBorang'])->middleware();
Route::get('/permit/haiwantawanan/view/{id}', [App\Http\Controllers\PermitTawananController::class,'view'])->middleware();
Route::post('/permit/haiwantawanan/postDeleteSpesis', [App\Http\Controllers\PermitTawananController::class,'postDeleteSpesis'])->middleware();
Route::post('/permit/haiwantawanan/postDeleteBorang', [App\Http\Controllers\PermitTawananController::class,'postDeleteBorang'])->middleware();
Route::post('/permit/haiwantawanan/postReturn', [App\Http\Controllers\PermitTawananController::class,'postReturn'])->middleware();
Route::get('/permit/haiwantawanan/download/{id}', [App\Http\Controllers\PermitTawananController::class,'downloadSalinanSijilKesihatan'])->middleware();
Route::get('/permit/haiwantawanan/deletefile/{id}', [App\Http\Controllers\PermitTawananController::class,'deleteSalinanSijilKesihatan'])->middleware();
Route::post('/permit/haiwantawanan/postUpdateResitAm',[App\Http\Controllers\PermitTawananController::class,'postUpdateResitAm'])->middleware();
Route::post('/permit/haiwantawanan/postSahkanBorang',[App\Http\Controllers\PermitTawananController::class,'postSahkanBorang'])->middleware();
Route::post('/permit/haiwantawanan/postApproveBorang',[App\Http\Controllers\PermitTawananController::class,'postApprove'])->middleware();
Route::post('/permit/haiwantawanan/postRejectBorang',[App\Http\Controllers\PermitTawananController::class,'postReject'])->middleware();
Route::post('/permit/haiwantawanan/postRenewPermit',[App\Http\Controllers\PermitTawananController::class,'postRenewPermit'])->middleware();

//PDF Generate
Route::get('/testpdf', [App\Http\Controllers\PDFController::class, 'generatePDF'])->middleware();
Route::get('/permit/pp/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfPenternakanPenanaman'])->middleware();
Route::get('/permit/pdf/{type}/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfPeniaga'])->middleware();
Route::get('/permit/bawakeluar/pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfBawaKeluar'])->middleware();
Route::get('/permit/bawamasuk/pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfBawaMasuk'])->middleware();
Route::get('/permit/tawanan/pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfTawanan'])->middleware();
Route::get('/lesen/memburu/pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfMemburu'])->middleware();
Route::get('/lesen/tumbuhan/pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePdfTumbuhan'])->middleware();
