@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">TRẢ LỜI BÌNH LUẬN</h6>

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
            <form action="{{ route('traloi.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Nhập nội dung trả lời</span>
                    </div>
                    <textarea name="noidung" id="noidung" cols="128" rows="10">{{ old('noidung') }}</textarea>

                    <input type="hidden" name="id_danhgia" value="{{ $danhgia->id }}">
                </div>
                <a href="{{ route('traloi.index') }}" class="btn btn-success">Danh sách bình luận</a>
                <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
            </form>
        </div>
    </div>
@endsection
