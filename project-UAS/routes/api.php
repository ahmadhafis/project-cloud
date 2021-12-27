<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('/buku', 'BukuController')->middleware('privilege:admin');
    Route::get('/buku-search', 'BukuController@search')->name('buku.search')->middleware('privilege:admin');
    Route::resource('/anggota', 'AnggotaController')->middleware('privilege:admin');
    Route::get('/anggota-search', 'AnggotaController@search')->name('anggota.search')->middleware('privilege:admin');
    Route::resource('/transaksi', 'TransaksiController')->middleware('privilege:admin&user');
    Route::get('/transaksi-search', 'TransaksiController@search')->name('transaksi.search')->middleware('privilege:admin&user');
    Route::resource('/riwayat', 'HistoryController')->middleware('privilege:admin&user');
    Route::get('/all', 'HistoryController@showAll')->name('riwayat.all')->middleware('privilege:admin&user');
    Route::get('/laporan', 'LaporanController@index')->name('laporan.index')->middleware('privilege:admin&user');
    Route::get('/buku-pdf', 'LaporanController@bukuPdf')->name('buku.pdf')->middleware('privilege:admin&user');
    Route::get('/buku-excel', 'LaporanController@bukuExcel')->name('buku.excel')->middleware('privilege:admin&user');
    Route::get('/transaksi-pdf', 'LaporanController@transaksiPdf')->name('transaksi.pdf')->middleware('privilege:admin&user');
    Route::get('/transaksi-excel', 'LaporanController@transaksiExcel')->name('transaksi.excel')->middleware('privilege:admin&user');
    Route::resource('/petugas', 'PetugasController');
});
