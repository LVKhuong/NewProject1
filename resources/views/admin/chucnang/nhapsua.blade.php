@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="quanli/sanpham" class="m-0 font-weight-bold text-primary">Phân quyền người dùng</a>
        </div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="table-responsive">

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif


                    <form action="{{ route('chucnang.update', $user->id) }}" method="POST">
                        @csrf @method('put')

                        <div class="input-group mb-3">
                            <div class="input-group-prepend mr-3">
                                <span class="input-group-text" id="basic-addon3">Chọn quyền user</span>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 1 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio1" value="1,Quản lí sản phẩm">
                                <label class="form-check-label" for="inlineRadio1">Quản lí sản phẩm (1) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 2 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio2" value="2,Quản lí người dùng">
                                <label class="form-check-label" for="inlineRadio2">Quản lí người dùng (2) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 3 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="3,Quản lí đơn hàng">
                                <label class="form-check-label" for="inlineRadio3">Quản lí đơn hàng (3) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 4 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="4,Quản lí thương hiệu">
                                <label class="form-check-label" for="inlineRadio3">Quản lí thương hiệu (4) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 5 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="5,Quản lí danh mục">
                                <label class="form-check-label" for="inlineRadio3">Quản lí danh mục (5) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 6 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="6,Admin">
                                <label class="form-check-label" for="inlineRadio3">Admin(6) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 7 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="7,Quản lí đánh giá">
                                <label class="form-check-label" for="inlineRadio3">Quản lí đánh giá (7) </label>
                            </div>
                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" {{ $user->role->role == 8 ? 'checked' : '' }}
                                    type="radio" name="role" id="inlineRadio3" value="8,Quản lí thuộc tính sản phẩm">
                                <label class="form-check-label" for="inlineRadio3">Quản lí thuộc tính sản phẩm (8) </label>
                            </div>
                        </div>


                        {{-- DASHBOARD --}}
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Dashboard</span>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" @foreach ($user->chucnang as $cn) {{ ($cn->tenroute == 'dashboard') ? 'checked' : '' }} @endforeach
                                    type="checkbox" name="ten_route[]" id="inlineCheckbox" value="dashboard">
                                <label class="form-check-label" for="inlineCheckbox">Dashboard</label>
                            </div>
                        </div>

                        {{-- THUONG HIEU --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Thương hiệu</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.index' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="thuonghieu.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.create' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="thuonghieu.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.store' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="thuonghieu.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.edit' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox3" value="thuonghieu.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.update' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="thuonghieu.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'thuonghieu.destroy' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                    value="thuonghieu.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                        </div>

                        {{-- CHUNG LOAI --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Chủng loại</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="chungloai.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="chungloai.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="chungloai.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                    value="chungloai.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="chungloai.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chungloai.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox4" value="chungloai.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>

                        </div>

                        {{-- SAN PHAM --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Sản phẩm</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="sanpham.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="sanpham.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="sanpham.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                    value="sanpham.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="sanpham.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                    value="sanpham.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.sale' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox7"
                                    value="sanpham.sale">
                                <label class="form-check-label" for="inlineCheckbox7">View Sale All</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.sell' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox8"
                                    value="sanpham.sell">
                                <label class="form-check-label" for="inlineCheckbox8">Sale All</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'import.sanpham.show' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox9" value="import.sanpham.show">
                                <label class="form-check-label" for="inlineCheckbox9">View Import Excel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'import.sanpham.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox9" value="import.sanpham.store">
                                <label class="form-check-label" for="inlineCheckbox9">Import Excel</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'expory.sanpham.xuat' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox10" value="expory.sanpham.xuat">
                                <label class="form-check-label" for="inlineCheckbox10">Export Excel</label>
                            </div>
                        </div>

                        {{-- Màu sắc sản phẩm --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Màu sắc sản phẩm</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.index' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="mausac.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.create' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="mausac.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.store' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="mausac.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.edit' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox3" value="mausac.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.update' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="mausac.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'mausac.destroy' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                    value="mausac.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                        </div>

                        {{-- Size và Tổng số lượng --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Size và Tổng số lượng</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.index' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="size_tongsoluong.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.create' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="size_tongsoluong.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.store' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="size_tongsoluong.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.edit' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox3" value="size_tongsoluong.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.update' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="size_tongsoluong.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'size_tongsoluong.destroy' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                    value="size_tongsoluong.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                        </div>

                        {{-- GIAM GIA --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Thiết lập giảm giá</span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox1" value="sanpham.giamgia.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox2" value="sanpham.giamgia.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox2" value="sanpham.giamgia.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox3" value="sanpham.giamgia.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox2" value="sanpham.giamgia.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'sanpham.giamgia.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                    id="inlineCheckbox4" value="sanpham.giamgia.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                        </div>


                        {{-- DON HANG --}}
                        <div class="input-group mt-3 mb-3 ml-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Đơn hàng </span>
                            </div>

                            <div class="form-check form-check-inline ml-3">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                    value="donhang.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.show' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1" value="donhang.show">
                                <label class="form-check-label" for="inlineCheckbox1">Show</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="donhang.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                    value="donhang.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                    value="donhang.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                    value="donhang.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'donhang.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                    value="donhang.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'send.Mail' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox7"
                                    value="send.Mail">
                                <label class="form-check-label" for="inlineCheckbox7">Gửi email đơn hàng</label>
                            </div>

                            {{-- CHI TIET DON HANG --}}
                            <div class="input-group mt-3 mb-3 ml-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">Chi tiết đơn hàng</span>
                                </div>

                                <div class="form-check form-check-inline ml-3">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox1" value="chitietdonhang.index">
                                    <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="chitietdonhang.create">
                                    <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="chitietdonhang.store">
                                    <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox3" value="chitietdonhang.edit">
                                    <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="chitietdonhang.update">
                                    <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'chitietdonhang.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox4" value="chitietdonhang.destroy">
                                    <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                                </div>
                            </div>

                            {{-- NGUOI DUNG --}}
                            <div class="input-group mt-3 mb-3 ml-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">Nguười dùng</span>
                                </div>

                                <div class="form-check form-check-inline ml-3">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.index' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox1" value="nguoidung.index">
                                    <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.create' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="nguoidung.create">
                                    <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.store' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="nguoidung.store">
                                    <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.edit' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox3" value="nguoidung.edit">
                                    <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.update' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox2" value="nguoidung.update">
                                    <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'nguoidung.destroy' ? 'checked' : '' }} @endforeach class="form-check-input" type="checkbox" name="ten_route[]"
                                        id="inlineCheckbox4" value="nguoidung.destroy">
                                    <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                                </div>
                            </div>

                            {{-- Tra loi danh gia --}}
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">Trả lời đánh giá</span>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input ml-3" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.index' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                        value="traloi.index">
                                    <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input ml-3" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.show' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox1" value="traloi.show">
                                    <label class="form-check-label" for="inlineCheckbox1">Show</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.create' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                        value="traloi.create">
                                    <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.store' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                        value="traloi.store">
                                    <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.edit' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox4" value="traloi.edit">
                                    <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.update' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                        value="traloi.update">
                                    <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @foreach ($user->chucnang as $cn) {{ $cn->tenroute == 'traloi.destroy' ? 'checked' : '' }} @endforeach type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                        value="traloi.destroy">
                                    <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                                </div>
                            </div>


                        </div>


                        <div class="form-check form-check-inline">
                            <input hidden class="form-check-input" type="text" name="user" value="{{ $user->id }}">
                        </div>

                        <a href="{{ route('chucnang.index') }}" class="btn btn-primary">Về lại danh sách </a>
                        <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
