@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI MÀU SẮC</h6>

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

            <form action="{{ route('mausac.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Nhập tên màu sắc</span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" name="ten" value="{{ old('ten') }}"
                            aria-describedby="basic-addon3">
                        <input type="hidden" name="id_sanpham" value="{{ $sanpham->id }}">
                    </div>
                    <div class="input-group mb-3 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Tải ảnh màu sắc</span>
                        </div>
                        <input type="file" class="form-control" id="basic-url" name="file_mausac"
                            value="{{ old('file_mausac') }}" aria-describedby="basic-addon3">
                    </div>
                </div>
                <a href="{{ route('mausac.index') }}" class="btn btn-primary">Về lại danh sách </a>
                <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
            </form>
        </div>
    </div>
@endsection
