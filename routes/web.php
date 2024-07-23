<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PenjualanController; 
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanStockController;
use App\Http\Controllers\TerapisController;
use App\Http\Controllers\TransController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'postLogin'])->name('postlogin');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Route::group(['middleware' => ['auth']], function () {

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/packlist', [TransaksiController::class, 'index'])->name('packlist');
// Route::get('/packlist/update', [TransaksiController::class, 'update'])->name('packlistupdate');

Route::get('/room', [RoomController::class, 'index'])->name('room');
Route::post('/roompost', [RoomController::class, 'post'])->name('roompost');
Route::get('/room/{room}/edit', [RoomController::class, 'getedit'])->name('roomedit');
Route::post('/room/{room}', [RoomController::class, 'update'])->name('roomupdate');
Route::post('/room/delete/{room}', [RoomController::class, 'delete'])->name('roomdelete');
Route::post('/room', [RoomController::class, 'getroom'])->name('getroom');

Route::get('/jasa', [JasaController::class, 'index'])->name('jasa');
Route::post('/jasapost', [JasaController::class, 'post'])->name('jasapost');
Route::get('/jasa/{jasa}/edit', [JasaController::class, 'getedit'])->name('jasaedit');
Route::post('/jasa/{jasa}', [JasaController::class, 'update'])->name('jasaupdate');
Route::post('/jasa/delete/{jasa}', [JasaController::class, 'delete'])->name('Jasadelete');
Route::post('/jasa', [JasaController::class, 'getjasa'])->name('getjasa');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('bookingpost', [BookingController::class, 'post'])->name('bookingpost');
Route::get('bookinglist', [BookingController::class, 'list'])->name('bookinglist');
Route::get('/book/{book}/edit', [BookingController::class, 'getedit'])->name('bookingedit');
Route::post('/booking/{booking}', [BookingController::class, 'update'])->name('bookingupdate');
Route::post('/booking/delete/{booking}', [BookingController::class, 'delete'])->name('bookingdelete');

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::post('penjualanpost', [PenjualanController::class, 'post'])->name('penjualanpost');
Route::get('penjualanlist', [PenjualanController::class, 'list'])->name('penjualanlist');
Route::get('/penjualan/{penjualan}/edit', [PenjualanController::class, 'getedit'])->name('penjualanedit');
Route::post('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualanupdate');
Route::post('/penjualan/delete/{penjualan}', [PenjualanController::class, 'delete'])->name('penjualandelete');
Route::get('/penjualan/{penjualan}/Print', [PenjualanController::class, 'printpdfpenjualan'])->name('penjualanprintmatrix');
// Route::get('/penjualan/{penjualan}/print', [PenjualanController::class, 'printpdfpenjualan'])->name('penjualanprintmatrix');

Route::get('/terapis', [TerapisController::class, 'index'])->name('terapis');
Route::post('/terapispost', [TerapisController::class, 'post'])->name('terapispost');
Route::get('/terapis/{terapis}/edit', [TerapisController::class, 'getedit'])->name('terapis edit');
Route::post('/terapis/{terapis}', [TerapisController::class, 'update'])->name('terapisupdate');
Route::post('/terapis/delete/{terapis}', [TerapisController::class, 'delete'])->name('terapisdelete');
Route::post('/getcustomer', [TerapisController::class, 'getterapis'])->name('getterapis');

Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
Route::post('/pemasukanpost', [PemasukanController::class, 'post'])->name('pemasukanpost');
Route::get('/pemasukanlist', [PemasukanController::class, 'list'])->name('pemasukanlist');
Route::get('/pemasukan/{pemasukan}/edit', [PemasukanController::class, 'getedit'])->name('pemasukangetedit');
Route::post('/pemasukan/{pemasukan}', [PemasukanController::class, 'update'])->name('pemasukanupdt');
Route::post('/pemasukan/delete/{pemasukan}', [PemasukanController::class, 'delete'])->name('pemasukandelete');

Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
// Route::post('/pengeluaranpost', [PengeluaranController::class, 'post'])->name('pengeluaranpost');
Route::post('/pengeluaranpost', [PengeluaranController::class, 'post'])->name('pengeluaranpost');
Route::get('/pengeluaranlist', [PengeluaranController::class, 'list'])->name('pengeluaranlist');
Route::get('/pengeluaran/{pengeluaran}/edit', [PengeluaranController::class, 'getedit'])->name('pengelgetedit');
Route::post('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaranupdt');
Route::post('/pengeluaran/delete/{pengeluaran}', [PengeluaranController::class, 'delete'])->name('pengeluarandelete');

Route::get('/Trans', [TransController::class, 'index'])->name('Trans');
Route::post('/Transpost', [TransController::class, 'post'])->name('Transpost');


Route::get('/laporanpenjualan', [LaporanPenjualanController::class, 'index'])->name('laporanpenjualan');
Route::get('/laporanpenjualanpost', [LaporanPenjualanController::class, 'post'])->name('laporanpenjualanpost');

Route::get('/lapstock', [LaporanStockController::class, 'index'])->name('lapstock');
Route::get('/lapstockpost', [LaporanStockController::class, 'post'])->name('lapstockpost');
// });