<?php

use App\Http\Controllers\BinhluanController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\ThuonghieuController;
use App\Http\Controllers\ChungloaiController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\ChitietdonhangController;
use App\Http\Controllers\NguoidungController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ChucNangUserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\GiamgiaController;
use App\Http\Controllers\TraloiController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/sanpham/{sanpham}', [TrangChuController::class, 'show'])->name('sanphamshow');

// Route bình luận
Route::post('/binhluan/{sanpham}', [BinhluanController::class, 'store'])->name('binhluan.store');

// Route trả lời bình luận
Route::post('/traloi/{binhluan}', [TraloiController::class, 'store'])->name('traloi.store');

//Route thanh toán giỏ hàng

Route::get('/', [TrangChuController::class, 'index'])->name('trangchu');
Route::post('/addcart', [TrangChuController::class, 'addToCart'])->name('addToCart');
Route::post('/congcart', [TrangChuController::class, 'CongCart'])->name('CongCart');
Route::post('/trucart', [TrangChuController::class, 'TruCart'])->name('TruCart');
Route::get('/xoacart/{id}', [TrangChuController::class, 'xoaCart'])->name('xoaCart');
Route::get('/shopping', [TrangChuController::class, 'shoppingCart'])->name('shoppingCart');

// thêm đơn hàng + chi tiết đơn hàng bằng giỏ hàng

Route::post('/thanhtoan', [TrangChuController::class, 'ThanhToan'])->name('ThanhToan');

Route::group([
   'prefix' => 'quanli',
   'middleware' => 'auth',
], function () {

   Route::get('/', [SanphamController::class, 'index'])->name('dashboard')->middleware('check.user:dashboard');

   Route::get('/sendcart/{iddonhang}', [MailController::class, 'sendMail'])->name('send.Mail')->middleware('check.user:send.Mail');

   // thương hiệu

   Route::group([
      'prefix' => 'thuonghieu',
      'as' => 'thuonghieu.',
   ], function () {
      Route::get('/', [ThuonghieuController::class, 'index'])->name('index')->middleware('check.user:thuonghieu.index');

      Route::get('/create', [ThuonghieuController::class, 'create'])->name('create')->middleware('check.user:thuonghieu.create');

      Route::post('/', [ThuonghieuController::class, 'store'])->name('store')->middleware('check.user:thuonghieu.store');

      Route::get('/{thuonghieu}/edit', [ThuonghieuController::class, 'edit'])->name('edit')->middleware('check.user:thuonghieu.edit');

      Route::put('/{thuonghieu}', [ThuonghieuController::class, 'update'])->name('update')->middleware('check.user:thuonghieu.update');

      Route::delete('/{thuonghieu}', [ThuonghieuController::class, 'destroy'])->name('destroy')->middleware('check.user:thuonghieu.destroy');
   });


   // chủng loại

   Route::group([
      'prefix' => 'chungloai',
      'as' => 'chungloai.',
   ], function () {
      Route::get('/', [ChungloaiController::class, 'index'])->name('index')->middleware('check.user:chungloai.index');

      Route::get('/create', [ChungloaiController::class, 'create'])->name('create')->middleware('check.user:chungloai.create');

      Route::post('/', [ChungloaiController::class, 'store'])->name('store')->middleware('check.user:chungloai.store');

      Route::get('/{chungloai}/edit', [ChungloaiController::class, 'edit'])->name('edit')->middleware('check.user:chungloai.edit');

      Route::put('/{chungloai}', [ChungloaiController::class, 'update'])->name('update')->middleware('check.user:chungloai.update');

      Route::delete('/{chungloai}', [ChungloaiController::class, 'destroy'])->name('destroy')->middleware('check.user:chungloai.destroy');
   });

   // sản phẩm

   Route::group([
      'prefix' => 'sanpham',
      'as' => 'sanpham.'
   ], function () {
      Route::get('/', [SanphamController::class, 'index'])->name('index')->middleware('check.user:sanpham.index');

      Route::get('/create', [SanphamController::class, 'create'])->name('create')->middleware('check.user:sanpham.create');

      Route::post('/', [SanphamController::class, 'store'])->name('store')->middleware('check.user:sanpham.store');

      Route::get('/{sanpham}/edit', [SanphamController::class, 'edit'])->name('edit')->middleware('check.user:sanpham.edit');

      Route::put('/{sanpham}', [SanphamController::class, 'update'])->name('update')->middleware('check.user:sanpham.update');

      Route::delete('/{sanpham}', [SanphamController::class, 'destroy'])->name('destroy')->middleware('check.user:sanpham.destroy');

      // thêm sale hàng loạt

      Route::get('/sale', [SaleController::class, 'index'])->name('sale')->middleware('check.user:sanpham.sale');
      Route::post('/sale', [SaleController::class, 'sell'])->name('sell')->middleware('check.user:sanpham.sell');

      // tùy chọn giảm giá sản phẩm

      Route::get('/giamgia', [GiamgiaController::class, 'index'])->name('giamgia.index')->middleware('check.user:sanpham.giamgia.index');

      Route::get('/giamgia/create', [GiamgiaController::class, 'create'])->name('giamgia.create')->middleware('check.user:sanpham.giamgia.create');

      Route::post('/giamgia', [GiamgiaController::class, 'store'])->name('giamgia.store')->middleware('check.user:sanpham.giamgia.store');

      Route::get('/giamgia/{idgiamgia}/edit', [GiamgiaController::class, 'edit'])->name('giamgia.edit')->middleware('check.user:sanpham.giamgia.edit');

      Route::put('/giamgia/{idgiamgia}', [GiamgiaController::class, 'update'])->name('giamgia.update')->middleware('check.user:sanpham.giamgia.update');

      Route::delete('/giamgia/{idgiamgia}', [GiamgiaController::class, 'destroy'])->name('giamgia.destroy')->middleware('check.user:sanpham.giamgia.destroy');
   });

   // đơn hàng

   Route::group([
      'prefix' => 'donhang',
      'as' => 'donhang.',
   ], function () {
      Route::get('/', [DonhangController::class, 'index'])->name('index')->middleware('check.user:donhang.index');

      Route::get('/{donhang}', [DonhangController::class, 'show'])->name('show')->middleware('check.user:donhang.show');

      Route::get('/create', [DonhangController::class, 'create'])->name('create')->middleware('check.user:donhang.create');

      Route::post('', [DonhangController::class, 'store'])->name('store')->middleware('check.user:donhang.store');

      Route::get('/{donhang}/edit', [DonhangController::class, 'edit'])->name('edit')->middleware('check.user:donhang.edit');

      Route::put('/{donhang}', [DonhangController::class, 'update'])->name('update')->middleware('check.user:donhang.update');

      Route::delete('/{donhang}', [DonhangController::class, 'destroy'])->name('destroy')->middleware('check.user:donhang.destroy');
   });


   // chi tiết đơn hàng

   Route::group([
      'prefix' => 'chitietdonhang',
      'as' => 'chitietdonhang.',
   ], function () {
      Route::get('', [ChitietdonhangController::class, 'index'])->name('index')->middleware('check.user:chitietdonhang.index');

      Route::get('/create', [ChitietdonhangController::class, 'create'])->name('create')->middleware('check.user:chitietdonhang.create');

      Route::post('', [ChitietdonhangController::class, 'store'])->name('store')->middleware('check.user:.store');

      Route::get('/{chitietdonhang}/edit', [ChitietdonhangController::class, 'edit'])->name('edit')->middleware('check.user:chitietdonhang.edit');

      Route::put('/{chitietdonhang}', [ChitietdonhangController::class, 'update'])->name('update')->middleware('check.user:chitietdonhang.update');

      Route::delete('/{chitietdonhang}', [ChitietdonhangController::class, 'destroy'])->name('destroy')->middleware('check.user:chitietdonhang.destroy');
   });


   // người dùng

   Route::group([
      'prefix' => 'nguoidung',
      'as' => 'nguoidung.',

   ], function () {
      Route::get('/', [NguoidungController::class, 'index'])->name('index')->middleware('check.user:nguoidung.index');

      Route::get('/create', [NguoidungController::class, 'create'])->name('create')->middleware('check.user:nguoidung.create');

      Route::post('/', [NguoidungController::class, 'store'])->name('store')->middleware('check.user:nguoidung.store');

      Route::get('/{nguoidung}/edit', [NguoidungController::class, 'edit'])->name('edit')->middleware('check.user:nguoidung.edit');

      Route::put('/{nguoidung}', [NguoidungController::class, 'update'])->name('update')->middleware('check.user:nguoidung.update');

      Route::delete('/{nguoidung}', [NguoidungController::class, 'destroy'])->name('destroy')->middleware('check.user:nguoidung.destroy');
   });

   // chức năng từng người dùng

   Route::group([
      'prefix' => 'chucnang',
      'as' => 'chucnang.',
      'middleware' => ['AdminLogin:admin@gmail.com'],
   ], function () {
      Route::get('/', [ChucNangUserController::class, 'index'])->name('index');

      Route::get('/create', [ChucNangUserController::class, 'create'])->name('create');

      Route::get('/{idnguoidung}', [ChucNangUserController::class, 'show'])->name('show');

      Route::post('/', [ChucNangUserController::class, 'store'])->name('store');

      Route::get('/{idnguoidung}/edit', [ChucNangUserController::class, 'edit'])->name('edit');

      Route::put('/{idnguoidung}', [ChucNangUserController::class, 'update'])->name('update');

      Route::delete('/{idnguoidung}', [ChucNangUserController::class, 'destroy'])->name('destroy');
   });

   // import excel 

   Route::group([
      'prefix' => 'import',
      'as' => 'import.',
   ], function () {
      Route::post('/sanpham', [ImportExcelController::class, 'store'])->name('sanpham.store');
   });

   //export excel

   Route::group([
      'prefix' => 'export',
      'as' => 'export.',
   ], function () {
      Route::get('/sanpham', [ExportExcelController::class, 'xuatsanpham'])->name('sanpham.xuat');
   });
});
