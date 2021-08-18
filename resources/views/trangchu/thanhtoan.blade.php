@extends('layouts.welcome')

@section('noidung')
    <div class="row">
        <div class="col-sm-12">
            <h2>SHOP ABCD</h2>
            <p>Bạn đã đặt hàng thành công</p>
        </div>

        <div class="col-sm-6">
            <div class="card" style="width: 100%;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Thông tin khách hàng</li>
                    <li class="list-group-item">Họ và tên : {{ $donhang->nguoimua }}</li>
                    <li class="list-group-item">Địa chỉ gmail : {{ $donhang->email }}</li>
                    <li class="list-group-item">Địa chỉ : {{ $donhang->diachi }}</li>
                    <li class="list-group-item">Số điện thoại : {{ $donhang->sodienthoai }}</li>
                </ul>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    Thông tin đơn hàng
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Thông tin đơn hàng</li>
                    @foreach ($donhang->chitietdonhang as $item)
                        <li class="list-group-item"> <img src="{{ $item->sanpham->images->first()->duongdan }}" alt=""
                                style="width: 30px; height:30px;"> Tên sản phẩm : {{ $item->sanpham->ten }}
                        </li>
                        <li class="list-group-item">Giá đã tính (bao gồm sale) : {{ $item->gia }}</li>
                        <li class="list-group-item">Số lượng : {{ $item->soluong }}</li>
                        <li class="list-group-item">Thành tiền : {{ $item->thanhtien }} $</li>
                    @endforeach
                    <li class="list-group-item">Tổng tiền : {{ $donhang->tongtien }} $</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
