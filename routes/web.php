<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PinjamanController;

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

Route::get('dashboard',['middleware'=>'auth', function () {
    return view('Dashboard');
}]);

Route::resource('nasabah', NasabahController::class);

Route::post('nasabah/search', [NasabahController::class,'search']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('nasabah/transaksi', [NasabahController::class,'transaksi']);

Route::get('laporan/lappdf',[App\Http\Controllers\LaporanController::class,'lapPdf']);

Route::get('laporan/lapxls',[App\Http\Controllers\LaporanController::class,'lapXls']);

Route::resource('pinjaman', PinjamanController::class);

Route::post('pinjaman/search', [PinjamanController::class,'search']);

Route::get('shu', [App\Http\Controllers\ShuController::class, 'index']);

Route::post('shu/proc', [App\Http\Controllers\ShuController::class,'proc']);

Route::post('pinjaman/get_name', [App\Http\Controllers\PinjamanController::class, 'get_name']);

Route::get('shu/ttp_buku',[App\Http\Controllers\ShuController::class,'ttp_buku']);

Route::post('shu/ttp',[App\Http\Controllers\ShuController::class,'ttp']);

Route::get('operator',[App\Http\Controllers\HomeController::class,'operator'])->name('operator');

Route::delete('delete_user/{home}',[App\Http\Controllers\HomeController::class,'destroy']);

Route::post('adduser', [App\Http\Controllers\HomeController::class,'create']);

Route::post('laporan/transNas',[App\Http\Controllers\LaporanController::class,'transNas']);

Route::post('laporan/pinjNas',[App\Http\Controllers\LaporanController::class,'pinjNas']);