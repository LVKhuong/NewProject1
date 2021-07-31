@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI CHỦNG LOẠI</h6>
        </div>

        @if (session('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <!-- Card Body -->

        <div class="card-body">
            <form action="{{ route('chungloai.update', $data->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="input-group mb-3 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Nhập tên chủng loại</span>
                    </div>
                    <input type="text" class="form-control" id="basic-url" value="{{ $data->ten }}" name="ten"
                        aria-describedby="basic-addon3">
                </div>
                <a href="{{ route('chungloai.index') }}" class="btn btn-primary">
                    < Về lại danh sách</a>
                        <input type="submit" class="btn btn-success ml-2" value="Cập nhập">
            </form>
        </div>
    @endsection
