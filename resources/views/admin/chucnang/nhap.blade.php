@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        @foreach ($errors->all() as $value)
                            {{ $value }}<br>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('chucnang.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                            <span class="input-group-text" id="basic-addon3">Chọn quyền user</span>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1"
                                value="1,Quản lí sản phẩm">
                            <label class="form-check-label" for="inlineRadio1">Quản lí sản phẩm (1) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio2"
                                value="2,Quản lí người dùng">
                            <label class="form-check-label" for="inlineRadio2">Quản lí người dùng (2) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="3,Quản lí đơn hàng">
                            <label class="form-check-label" for="inlineRadio3">Quản lí đơn hàng (3) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="4,Quản lí thương hiệu">
                            <label class="form-check-label" for="inlineRadio3">Quản lí thương hiệu (4) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="5,Quản lí danh mục">
                            <label class="form-check-label" for="inlineRadio3">Quản lí danh mục (5) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3" value="6,Admin">
                            <label class="form-check-label" for="inlineRadio3">Admin(6) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="7,Quản lí đánh giá">
                            <label class="form-check-label" for="inlineRadio3">Quản lí đánh giá (7) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="8,Quản lí thuộc tính sản phẩm">
                            <label class="form-check-label" for="inlineRadio3">Quản lí thuộc tính sản phẩm (8) </label>
                        </div>
                    </div>

                    {{-- DASHBOARD --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Dashboard</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="dashboard">
                            <label class="form-check-label" for="inlineCheckbox1">Dashboard</label>
                        </div>
                    </div>

                    {{-- THUONG HIEU --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Thương hiệu</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="thuonghieu.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="thuonghieu.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="thuonghieu.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="thuonghieu.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="thuonghieu.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="thuonghieu.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>
                    </div>


                    {{-- CHUNG LOAI --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Chủng loại</span>
                        </div>

                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="chungloai.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="chungloai.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="chungloai.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="chungloai.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="chungloai.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="chungloai.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>

                    </div>

                    {{-- SAN PHAM --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Sản phẩm</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="sanpham.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="sanpham.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="sanpham.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="sanpham.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="sanpham.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="sanpham.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox7"
                                value="sanpham.sale">
                            <label class="form-check-label" for="inlineCheckbox7">View Sale All</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox8"
                                value="sanpham.sell">
                            <label class="form-check-label" for="inlineCheckbox8">Sale All</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox9"
                                value="import.sanpham.show">
                            <label class="form-check-label" for="inlineCheckbox9">View Import Excel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox9"
                                value="import.sanpham.store">
                            <label class="form-check-label" for="inlineCheckbox9">Import Excel</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox10"
                                value="expory.sanpham.xuat">
                            <label class="form-check-label" for="inlineCheckbox10">Export Excel</label>
                        </div>

                    </div>

                   {{-- màu sắc sản phẩm --}}
                   <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon4">Màu sắc sản phẩm</span>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                            value="mausac.index">
                        <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                            value="mausac.create">
                        <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                            value="mausac.store">
                        <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                            value="mausac.edit">
                        <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                            value="mausac.update">
                        <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                            value="mausac.destroy">
                        <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                    </div>
                </div>

                {{-- size và tổng số lượng --}}
                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon4">Size và Tổng số lượng</span>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                            value="size_tongsoluong.index">
                        <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                            value="size_tongsoluong.create">
                        <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                            value="size_tongsoluong.store">
                        <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                            value="size_tongsoluong.edit">
                        <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                            value="size_tongsoluong.update">
                        <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                            value="size_tongsoluong.destroy">
                        <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                    </div>
                </div>

                    {{-- GIAM GIA --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Thiết lập giảm giá</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="sanpham.giamgia.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="sanpham.giamgia.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="sanpham.giamgia.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="sanpham.giamgia.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="sanpham.giamgia.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="sanpham.giamgia.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>

                    </div>


                    {{-- DON HANG --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Đơn hàng</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="donhang.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="donhang.show">
                            <label class="form-check-label" for="inlineCheckbox1">Show</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="donhang.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="donhang.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="donhang.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="donhang.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="donhang.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox7"
                                value="send.Mail">
                            <label class="form-check-label" for="inlineCheckbox7">Gửi email đơn hàng</label>
                        </div>

                    </div>

                    {{-- CHI TIET DON HANG --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Chi tiết đơn hàng</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="chitietdonhang.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="chitietdonhang.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="chitietdonhang.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="chitietdonhang.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="chitietdonhang.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="chitietdonhang.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>

                    </div>

                    {{-- NGUOI DUNG --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Người dùng</span>
                        </div>

                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="nguoidung.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="nguoidung.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="nguoidung.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="nguoidung.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="nguoidung.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="nguoidung.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>

                    </div>

                    {{-- Tra loi danh gia --}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Trả lời đánh giá</span>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="traloi.index">
                            <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input ml-3" type="checkbox" name="ten_route[]" id="inlineCheckbox1"
                                value="traloi.show">
                            <label class="form-check-label" for="inlineCheckbox1">Show</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox2"
                                value="traloi.create">
                            <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox3"
                                value="traloi.store">
                            <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox4"
                                value="traloi.edit">
                            <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox5"
                                value="traloi.update">
                            <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ten_route[]" id="inlineCheckbox6"
                                value="traloi.destroy">
                            <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                        </div>
                    </div>

                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID </th>
                                <th>Tên</th>
                                <th>Email login</th>
                                <th>Ảnh đại diện</th>
                                <th>Quyền</th>
                                <th>Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 0; ?>
                            @foreach ($users as $value)
                                <tr>
                                    <td>{{ ++$stt }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        @if (isset($value->image->duongdan))
                                            <img src="{{ $value->image->duongdan }}" alt=""
                                                style="width: 50px; height: 50px;">
                                        @endif
                                    </td>
                                    <td>{{ $value->role->ten_role ?? 'Chưa Cấp quyền' }}</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="user" id="inlineRadio1"
                                                value="{{ $value->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div class="mt-3">
                            {!! $users->links() !!}
                        </div>
                    </table>

                    <a href="{{ route('chucnang.index') }}" class="btn btn-primary">Về lại danh sách </a>
                    <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                </form>

            </div>
        </div>

    </div>
@endsection
