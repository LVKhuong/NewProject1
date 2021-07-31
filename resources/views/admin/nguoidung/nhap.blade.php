@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">SỬA THÔNG TIN TÀI KHOẢN</h6>

        </div>
        @if (session('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif
        <!-- Card Body -->
        <div class="card-body">
            @if ($errors->any())

                <div class="alert alert-danger small">

                    @foreach ($errors->all() as $value)
                        {{ $value }}<br>
                    @endforeach

                </div>

            @endif
            <form action="{{ route('nguoidung.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Tên người dùng </span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" name="name" aria-describedby="basic-addon3"
                            value="{{ old('name') }}">
                    </div>

                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">Tài khoản EMAIL </span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" name="email" aria-describedby="basic-addon4"
                            value="{{ old('email') }}">
                    </div>

                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon6">Mật khẩu </span>
                        </div>
                        <input type="password" class="form-control" id="basic-url" name="password"
                            aria-describedby="basic-addon6">
                    </div>

                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon8">Nhập lại mật khẩu </span>
                        </div>
                        <input type="password" class="form-control" id="basic-url" name="repassword"
                            aria-describedby="basic-addon8">
                    </div>

                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon5">Tải ảnh người dùng</span>
                            <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="fileImage"
                                aria-describedby="basic-addon5" />
                        </div>
                    </div>

                    <div class="input-group mb-3 col-sm-6">
                        <a href="{{ route('nguoidung.index') }}" class="btn btn-primary">Về lại danh sách </a>
                        <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
