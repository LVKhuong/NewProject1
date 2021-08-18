@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI THUỘC TÍNH</h6>

        </div>

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

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('thuoctinh.update', $thuoctinh->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" id="basic-addon3">Nhập màu sắc </span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" name="mausac"
                            value="{{ $thuoctinh->mausac }}" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Nhập size </span>
                        </div>
                        <select class="form-select form-select-sm" style="width: 70%;" aria-label=".form-select-sm example"
                            name="size">
                            <option>Vui lòng chọn size</option>
                            @for ($i = 28; $i <= 45; $i++)
                                <option {{ $thuoctinh->size == $i ? 'selected' : '' }} value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" id="basic-addon3">Nhập số lượng </span>
                        </div>
                        <input type="number" class="form-control" id="basic-url" name="soluong"
                            value="{{ $thuoctinh->soluong }}" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon5">Tải ảnh màu sắc</span>
                            <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="file_mausac"
                                aria-describedby="basic-addon5" />
                        </div>
                    </div>

                </div>
                <a href="{{ route('thuoctinh.index') }}" class="btn btn-primary">Về lại danh sách </a>
                <input type="submit" class="btn btn-success ml-2" value="Cập nhập">
            </form>
        </div>
    </div>
@endsection
