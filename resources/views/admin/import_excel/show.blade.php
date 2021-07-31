@extends('admin.layouts.index')

@section('noidung')
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <a href="quanli/sanpham" class="m-0 font-weight-bold text-primary">Tất cả sản phẩm</a>
    </div>
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="table-responsive">

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif

                <form action="{{route('import.sanpham.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="btn btn-primary" type="file" name="excel">
                    <input class="btn btn-primary" type="submit" value="Import">
                </form>

</div>
@endsection