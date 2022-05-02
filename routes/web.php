<?php

use App\Http\Controllers\DashboardImagesController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardCourierController;
use App\Http\Controllers\DashboardDiscountController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\OngkirController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\TransactionDetailController;
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

Route::get('/', function () {
    return view('welcome');
});

*/

Auth::routes();
Auth::routes(['verify' => true]); //verifikasi email

Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/detail_produk/{id}', [HomeController::class, 'detail_produk'])->name('detail_produk');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/addCarts', [CartController::class, 'addCarts'])->name('addCarts');
    Route::get('/charts', [CartController::class, 'index'])->name('charts');
    Route::post('/delete', [CartController::class, 'delete']);
    Route::post('/minus', [CartController::class, 'minus']);
    Route::post('/plus', [CartController::class, 'plus']);
    Route::post('/address', [OngkirController::class, 'address'])->name('address');
    Route::post('/ongkir', [OngkirController::class, 'ongkir'])->name('ongkir');
    Route::post('/getongkir', [OngkirController::class, 'index'])->name('getongkir');
    Route::get('/getCity/ajax/{id}', [OngkirController::class, 'getCitiesAjax']);
    Route::post('/check_out/{ongkir}', [CheckOutController::class, 'index'])->name('check_out');
    Route::post('/pesan', [TransactionController::class, 'store']);
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi');
    Route::get('/transaksi_detail/{id}', [TransactionDetailController::class, 'transaksi_detail'])->name('transaksi_detail');
    Route::post('/transaksi/pembayaran', [TransactionDetailController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/transaksi/update', [TransactionDetailController::class, 'update'])->name('update');
    Route::post('/transaksi/review/{product_id}', [TransactionDetailController::class, 'review'])->name('review');
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'profile'])->name('userprofile');
});

Route::get('/admin', [App\Http\Controllers\Admin\LoginControllerAdmin::class, 'loginAdmin'])->name('loginadmin');
Route::post('actionlogin', [App\Http\Controllers\Admin\LoginControllerAdmin::class, 'action'])->name('actionlogin');
Route::get('logoutAdmin', [App\Http\Controllers\Admin\LoginControllerAdmin::class, 'logoutAdmin'])->name('logoutadmin');
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name ('dashboard');
  });
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/products', DashboardProductController::class);
  Route::post('/respons/{id}', [DashboardProductController::class, 'respons'])->name('respons');
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/images', DashboardImagesController::class);
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/category', DashboardCategoryController::class);
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/courier', DashboardCourierController::class);
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/discount', DashboardDiscountController::class);
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
  Route::resource('/transaction', DashboardTransactionController::class);
  Route::post('/verified', [DashboardTransactionController::class, 'verified'])->name('verified');
  Route::post('/kirim', [DashboardTransactionController::class, 'kirim'])->name('kirim');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

