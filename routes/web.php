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
use App\Http\Controllers\QuanlimenuController;
use App\Http\Controllers\RoleController;
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

// Chi tiet san pham
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

// chức năng từng người dùng
Route::group([
    'prefix' => 'chucnang',
    'as' => 'chucnang.',
    'middleware' => ['AdminLogin', 'auth'],
], function () {
    Route::get('/', [ChucNangUserController::class, 'index'])->name('index');

    Route::get('/create', [ChucNangUserController::class, 'create'])->name('create');

    Route::get('/{idnguoidung}', [ChucNangUserController::class, 'show'])->name('show');

    Route::post('/', [ChucNangUserController::class, 'store'])->name('store');

    Route::get('/{idnguoidung}/edit', [ChucNangUserController::class, 'edit'])->name('edit');

    Route::put('/{idnguoidung}', [ChucNangUserController::class, 'update'])->name('update');

    Route::delete('/{idnguoidung}', [ChucNangUserController::class, 'destroy'])->name('destroy');

    //route them menu quyen
    Route::get('/menu', [RoleController::class, 'index'])->name('menu_index');

    Route::get('/menu/create', [RoleController::class, 'create'])->name('menu_create');

    Route::post('/menu', [RoleController::class, 'store'])->name('menu_store');

});




// Route USER
Route::group([
    'prefix' => 'quanli',
    'middleware' => ['auth', 'check.user'],
], function () {
    Route::get('/', [SanphamController::class, 'index'])->name('dashboard');

    Route::get('/sendcart/{iddonhang}', [MailController::class, 'sendMail'])->name('send.Mail');

    // thương hiệu
    Route::group([
        'prefix' => 'thuonghieu',
        'as' => 'thuonghieu.',
    ], function () {
        Route::get('/', [ThuonghieuController::class, 'index'])->name('index');

        Route::get('/create', [ThuonghieuController::class, 'create'])->name('create');

        Route::post('/', [ThuonghieuController::class, 'store'])->name('store');

        Route::get('/{thuonghieu}/edit', [ThuonghieuController::class, 'edit'])->name('edit');

        Route::put('/{thuonghieu}', [ThuonghieuController::class, 'update'])->name('update');

        Route::delete('/{thuonghieu}', [ThuonghieuController::class, 'destroy'])->name('destroy');
    });


    // chủng loại
    Route::group([
        'prefix' => 'chungloai',
        'as' => 'chungloai.',
    ], function () {
        Route::get('/', [ChungloaiController::class, 'index'])->name('index');

        Route::get('/create', [ChungloaiController::class, 'create'])->name('create');

        Route::post('/', [ChungloaiController::class, 'store'])->name('store');

        Route::get('/{chungloai}/edit', [ChungloaiController::class, 'edit'])->name('edit');

        Route::put('/{chungloai}', [ChungloaiController::class, 'update'])->name('update');

        Route::delete('/{chungloai}', [ChungloaiController::class, 'destroy'])->name('destroy');
    });

    // sản phẩm
    Route::group([
        'prefix' => 'sanpham',
        'as' => 'sanpham.'
    ], function () {
        Route::get('/', [SanphamController::class, 'index'])->name('index');

        Route::get('/create', [SanphamController::class, 'create'])->name('create');

        Route::post('/', [SanphamController::class, 'store'])->name('store');

        Route::get('/{sanpham}/edit', [SanphamController::class, 'edit'])->name('edit');

        Route::put('/{sanpham}', [SanphamController::class, 'update'])->name('update');

        Route::delete('/{sanpham}', [SanphamController::class, 'destroy'])->name('destroy');

        // thêm sale hàng loạt
        Route::get('/sale', [SaleController::class, 'index'])->name('sale');

        Route::post('/sale', [SaleController::class, 'sell'])->name('sell');

        // tùy chọn giảm giá sản phẩm
        Route::get('/giamgia', [GiamgiaController::class, 'index'])->name('giamgia.index');

        Route::get('/giamgia/create', [GiamgiaController::class, 'create'])->name('giamgia.create');

        Route::post('/giamgia', [GiamgiaController::class, 'store'])->name('giamgia.store');

        Route::get('/giamgia/{idgiamgia}/edit', [GiamgiaController::class, 'edit'])->name('giamgia.edit');

        Route::put('/giamgia/{idgiamgia}', [GiamgiaController::class, 'update'])->name('giamgia.update');

        Route::delete('/giamgia/{idgiamgia}', [GiamgiaController::class, 'destroy'])->name('giamgia.destroy');
    });

    // đơn hàng
    Route::group([
        'prefix' => 'donhang',
        'as' => 'donhang.',
    ], function () {
        Route::get('/', [DonhangController::class, 'index'])->name('index');

        Route::get('/{donhang}', [DonhangController::class, 'show'])->name('show');

        Route::get('/create', [DonhangController::class, 'create'])->name('create');

        Route::post('', [DonhangController::class, 'store'])->name('store');

        Route::get('/{donhang}/edit', [DonhangController::class, 'edit'])->name('edit');

        Route::put('/{donhang}', [DonhangController::class, 'update'])->name('update');

        Route::delete('/{donhang}', [DonhangController::class, 'destroy'])->name('destroy');
    });


    // chi tiết đơn hàng
    Route::group([
        'prefix' => 'chitietdonhang',
        'as' => 'chitietdonhang.',
    ], function () {
        Route::get('', [ChitietdonhangController::class, 'index'])->name('index');

        Route::get('/create', [ChitietdonhangController::class, 'create'])->name('create');

        Route::post('', [ChitietdonhangController::class, 'store'])->name('store');

        Route::get('/{chitietdonhang}/edit', [ChitietdonhangController::class, 'edit'])->name('edit');

        Route::put('/{chitietdonhang}', [ChitietdonhangController::class, 'update'])->name('update');

        Route::delete('/{chitietdonhang}', [ChitietdonhangController::class, 'destroy'])->name('destroy');
    });


    // người dùng
    Route::group([
        'prefix' => 'nguoidung',
        'as' => 'nguoidung.',

    ], function () {
        Route::get('/', [NguoidungController::class, 'index'])->name('index');

        Route::get('/create', [NguoidungController::class, 'create'])->name('create');

        Route::post('/', [NguoidungController::class, 'store'])->name('store');

        Route::get('/{nguoidung}/edit', [NguoidungController::class, 'edit']);

        Route::put('/{nguoidung}', [NguoidungController::class, 'update'])->name('update');

        Route::delete('/{nguoidung}', [NguoidungController::class, 'destroy'])->name('destroy');
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
