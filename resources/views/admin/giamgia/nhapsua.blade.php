@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Thêm giảm giá sản phẩm</h6>

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

            <form action="{{ route('sanpham.giamgia.update', $giamGia->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Nhập số lượng mua được giảm</span>
                        <input type="number" class="form-control" id="basic-url" name="tong_soluong"
                            value="{{ $giamGia->tong_soluong }}" aria-describedby="basic-addon3">
                        <span class="input-group-text" id="basic-addon3">Nhập gía mua được giảm</span>
                        <input type="number" class="form-control" id="basic-url" name="giagiam" value="{{ $giamGia->giagiam }}"
                            aria-describedby="basic-addon3">
                    </div>
                </div>

                <div class="input-group-prepend row">
                    <span class="input-group-text">Chọn sản phẩm giảm giá</span>
                    <div class="form-check col-sm-9" id='defaultCheck'>
                        <select class="form-control" name='id_sanpham'>       
                                <option value="{{$sanPham->id}}">
                                    --- Tên sản phẩm : {{$sanPham->ten}} 
                                    --- Giá : {{number_format($sanPham->gia)}} đ
                                    --- Sale : {{$sanPham->sale}} %
                                    --- Giá sale : {{$sanPham->gia * (100-$sanPham->sale) / 100}} đ
                                </option>                    
                        </select>
                    </div>
                </div>

                <a href="{{ route('sanpham.giamgia.index') }}" class="btn btn-primary">Về lại danh sách </a>

                <input type="submit" class="btn btn-success ml-2" value="Cập nhập giảm giá">

            </form>
        </div>
    </div>
@endsection
