<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TrangChuController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\SanphamController;
use App\Http\Controllers\Admin\ThuonghieuController;
use App\Http\Controllers\Admin\ChungloaiController;
use App\Http\Controllers\Admin\DonhangController;
use App\Http\Controllers\Admin\ChitietdonhangController;
use App\Http\Controllers\Admin\NguoidungController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ChucNangUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ImportExcelController;
use App\Http\Controllers\Admin\ExportExcelController;
use App\Http\Controllers\Admin\GiamgiaController;
use App\Http\Controllers\Admin\MausacController;
use App\Http\Controllers\Admin\SizeTongsoluongController;
use App\Http\Controllers\Social\SocialController;
use App\Http\Controllers\User\TraloiDanhgiaController;
use Illuminate\Support\Facades\Auth;

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



// chức năng từng người dùng admin
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
});

Auth::routes();

// profile người dùng
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Chi tiet san pham
Route::get('/sanpham/{sanpham}', [TrangChuController::class, 'show'])->name('sanphamshow');

//Route danh gia
Route::post('/danhgia', [TrangChuController::class, 'danhgia'])->name('danhgia');

//Route thanh toán giỏ hàng
Route::get('/', [TrangChuController::class, 'index'])->name('trangchu');

Route::post('/addcart', [TrangChuController::class, 'addToCart'])->name('addToCart');
Route::post('/congcart', [TrangChuController::class, 'CongCart'])->name('CongCart');
Route::post('/trucart', [TrangChuController::class, 'TruCart'])->name('TruCart');
Route::get('/xoacart/{id}', [TrangChuController::class, 'xoaCart'])->name('xoaCart');
Route::get('/shopping', [TrangChuController::class, 'shoppingCart'])->name('shoppingCart');

// ajax sắp xếp sản phẩm trang chủ
Route::get('/sapxep', [TrangChuController::class, 'sapxep'])->name('sapxep');


// autocomplete tìm kiếm
Route::post('/autocomplete', [TrangChuController::class, 'autocomplete'])->name('autocomplete');

// thêm đơn hàng + chi tiết đơn hàng bằng giỏ hàng
Route::post('/thanhtoan', [TrangChuController::class, 'ThanhToan'])->name('ThanhToan');

// Login Facebook
Route::get('/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('/facebook/callback', [SocialController::class, 'loginWithFacebook']);

// Login Google
Route::get('/google', [SocialController::class, 'googleRedirect']);
Route::get('/google/callback', [SocialController::class, 'loginWithGoogle']);


// View sản phẩm hết hàng
Route::get('/hethang', [DashboardController::class, 'sanphamHethang'])->name('hethang');

// ajax Lọc theo ngày -> thống kê
Route::post('/loctheongay', [DashboardController::class, 'locTheoNgay'])->name('loc.ngay');
Route::post('/locselect', [DashboardController::class, 'locSelect'])->name('loc.select');

// upload ảnh trong CKEditor
Route::post('ckeditor/upload', [DashboardController::class, 'upload_ckeditor'])->name('ckeditor-upload');
Route::get('ckeditor/browser', [DashboardController::class, 'browser_ckeditor'])->name('ckeditor-browser');



// Route USER
Route::group([
    'prefix' => 'quanli',
    'middleware' => ['auth', 'check.user'],
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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


    // màu sắc sản phẩm
    Route::group([
        'prefix' => 'mausac',
        'as' => 'mausac.',
    ], function () {
        Route::get('/', [MausacController::class, 'index'])->name('index');

        Route::get('/create/{sanpham}', [MausacController::class, 'create'])->name('create');

        Route::post('/', [MausacController::class, 'store'])->name('store');

        Route::get('/{mausac}/edit', [MausacController::class, 'edit'])->name('edit');

        Route::put('/{mausac}', [MausacController::class, 'update'])->name('update');

        Route::delete('/{mausac}', [MausacController::class, 'destroy'])->name('destroy');
    });

    // size và tổng số lượng sản phẩm
    Route::group([
        'prefix' => 'sizetongsoluong',
        'as' => 'size_tongsoluong.',
    ], function () {
        Route::get('/', [SizeTongsoluongController::class, 'index'])->name('index');

        Route::get('/create/{mausac}', [SizeTongsoluongController::class, 'create'])->name('create');

        Route::post('/', [SizeTongsoluongController::class, 'store'])->name('store');

        Route::get('/{size_tongsoluong}/edit', [SizeTongsoluongController::class, 'edit'])->name('edit');

        Route::put('/{size_tongsoluong}', [SizeTongsoluongController::class, 'update'])->name('update');

        Route::delete('/{size_tongsoluong}', [SizeTongsoluongController::class, 'destroy'])->name('destroy');
    });

    // đơn hàng
    Route::group([
        'prefix' => 'donhang',
        'as' => 'donhang.',
    ], function () {
        Route::get('', [DonhangController::class, 'index'])->name('index');

        Route::get('/create', [DonhangController::class, 'create'])->name('create');

        Route::post('/', [DonhangController::class, 'store'])->name('store');

        Route::get('/{donhang}/edit', [DonhangController::class, 'edit'])->name('edit');

        Route::put('/{donhang}', [DonhangController::class, 'update'])->name('update');

        Route::get('/{donhang}', [DonhangController::class, 'show'])->name('show');

        Route::delete('/{donhang}', [DonhangController::class, 'destroy'])->name('destroy');
    });


    // chi tiết đơn hàng
    Route::group([
        'prefix' => 'chitietdonhang',
        'as' => 'chitietdonhang.',
    ], function () {
        Route::get('', [ChitietdonhangController::class, 'index'])->name('index');

        Route::get('/create', [ChitietdonhangController::class, 'create'])->name('create');

        Route::post('/', [ChitietdonhangController::class, 'store'])->name('store');

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

        Route::get('/{nguoidung}/edit', [NguoidungController::class, 'edit'])->name('edit');

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

    // Route trả lời đánh giá
    Route::group([
        'prefix' => 'traloi',
        'as' => 'traloi.',
    ], function () {
        Route::get('/', [TraloiDanhgiaController::class, 'index'])->name('index');

        Route::get('/create/{id_danhgia}', [TraloiDanhgiaController::class, 'create'])->name('create');

        Route::post('/', [TraloiDanhgiaController::class, 'store'])->name('store');

        Route::get('/{danhgia}/show', [TraloiDanhgiaController::class, 'show'])->name('show');

        Route::get('/{traloi_danhgia}/edit', [TraloiDanhgiaController::class, 'edit'])->name('edit');

        Route::put('/{traloi_danhgia}', [TraloiDanhgiaController::class, 'update'])->name('update');

        Route::delete('/{traloi_danhgia}', [TraloiDanhgiaController::class, 'destroy'])->name('destroy');
    });
});
