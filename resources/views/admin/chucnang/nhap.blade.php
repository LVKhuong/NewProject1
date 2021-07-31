@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="quanli/sanpham" class="m-0 font-weight-bold text-primary">Phân quyền người dùng</a>
        </div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="table-responsive ml-3 mt-3 mb-3">

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $value)
                                {{ $value }}<br>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('chucnang.store') }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Chọn EMAIL</span>
                            </div>
                            <select class="form-control form-control-lg" name="email">
                                @foreach ($users as $user)
                                    <option>{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DASHBOARD --}}
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Dashboard</span>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
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
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="thuonghieu.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="thuonghieu.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="thuonghieu.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="thuonghieu.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="thuonghieu.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
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
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="chungloai.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="chungloai.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="chungloai.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="chungloai.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="chungloai.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
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
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="sanpham.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="sanpham.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="sanpham.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="sanpham.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="sanpham.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
                                    value="sanpham.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox7"
                                    value="sanpham.sale">
                                <label class="form-check-label" for="inlineCheckbox7">View Sale All</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox8"
                                    value="sanpham.sell">
                                <label class="form-check-label" for="inlineCheckbox8">Sale All</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox9"
                                    value="import.sanpham.show">
                                <label class="form-check-label" for="inlineCheckbox9">View Import Excel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox9"
                                    value="import.sanpham.store">
                                <label class="form-check-label" for="inlineCheckbox9">Import Excel</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox10"
                                    value="expory.sanpham.xuat">
                                <label class="form-check-label" for="inlineCheckbox10">Export Excel</label>
                            </div>

                        </div>

                        {{-- GIAM GIA --}}

                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Thiết lập giảm giá</span>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="sanpham.giamgia.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="sanpham.giamgia.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="sanpham.giamgia.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="sanpham.giamgia.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="sanpham.giamgia.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
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
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="donhang.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="donhang.show">
                                <label class="form-check-label" for="inlineCheckbox1">Show</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="donhang.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="donhang.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="donhang.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="donhang.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
                                    value="donhang.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox7"
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
                                <input class="form-check-input ml-3" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="chitietdonhang.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="chitietdonhang.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="chitietdonhang.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="chitietdonhang.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="chitietdonhang.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
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
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox1"
                                    value="nguoidung.index">
                                <label class="form-check-label" for="inlineCheckbox1">Xem</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox2"
                                    value="nguoidung.create">
                                <label class="form-check-label" for="inlineCheckbox2">Nhập</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox3"
                                    value="nguoidung.store">
                                <label class="form-check-label" for="inlineCheckbox3">Thêm</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox4"
                                    value="nguoidung.edit">
                                <label class="form-check-label" for="inlineCheckbox4">Nhập sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox5"
                                    value="nguoidung.update">
                                <label class="form-check-label" for="inlineCheckbox5">Sửa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" id="inlineCheckbox6"
                                    value="nguoidung.destroy">
                                <label class="form-check-label" for="inlineCheckbox6">Xóa</label>
                            </div>

                        </div>

                        <a href="{{ route('chucnang.index') }}" class="btn btn-primary">Về lại danh sách </a>
                        <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
