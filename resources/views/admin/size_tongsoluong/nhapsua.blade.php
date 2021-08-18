@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">CẬP NHẬP KÍCH THƯỚC VÀ TỔNG SỐ LƯỢNG</h6>
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
            <form action="{{ route('size_tongsoluong.update', $size_tongsoluong->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Chọn size</span>
                    <div class="input-group-prepend row">
                        @for ($i = 26; $i <= 45; $i++)
                            <div class="form-check form-check-inline col-sm-1 mr-3">
                                <input class="form-check-input" {{ $size_tongsoluong->size == $i ? 'checked' : '' }}
                                    type="radio" name="size" id="inlineRadio1" value="{{ $i }}">
                                <label class="form-check-label" for="inlineRadio1">{{ $i }}</label>
                            </div>
                        @endfor
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nhập tổng số lượng theo size</label>
                        <input type="number" class="form-control" name="tongsoluong"
                            value="{{ $size_tongsoluong->tongsoluong }}" id="exampleFormControlInput1">
                    </div>
                </div>
                <a href="{{ route('size_tongsoluong.index') }}" class="btn btn-primary">Về lại danh sách </a>
                <input type="submit" class="btn btn-success ml-2" value="Cập nhập">
            </form>
        </div>
    </div>
@endsection
