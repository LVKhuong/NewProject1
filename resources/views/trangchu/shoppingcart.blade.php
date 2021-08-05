@extends('layouts.welcome1')

@section('noidung')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Ảnh</td>
                            <td class="description">Sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Thành tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($carts))
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="cart_product">
                                        @foreach ($dataSanPham->find($cart['id_sanpham'])->images as $image)
                                            <a href=""><img style="width: 20%" src="{{ $image->duongdan }}"
                                                    alt="null"></a>
                                        @break
                            @endforeach
                            </td>


                            <td class="cart_description">
                                <h4><a href="">{{ $cart['ten'] ?? '' }}</a></h4>
                            </td>

                            <td class="cart_price">
                                @if ($cart['sale'] > 0)
                                    <p>{{ number_format($cart['gia'] - ($cart['gia'] * $cart['sale']) / 100) }}</p>
                                    <p><del>{{ number_format($cart['gia']) }}</del></p>
                                @else
                                    <p>{{ number_format($cart['gia']) }} đ</p>
                                @endif
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input type="button" value="+" id="CongCart{{ $cart['id_sanpham'] }}">
                                    <h4><span id="soLuong{{ $cart['id_sanpham'] }}">{{ $cart['soluong'] }}</span>
                                    </h4>
                                    <input type="button" value="-" id="TruCart{{ $cart['id_sanpham'] }}">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <span id="thanhTien{{ $cart['id_sanpham'] }}">
                                        {{ number_format(($cart['gia'] - ($cart['gia'] * $cart['sale']) / 100) * $cart['soluong']) }}
                                    </span>
                                    đ
                                </p>
                            </td>
                            <td class="cart_delete">
                                <form action="{{ route('xoaCart', $cart['id_sanpham']) }}" method="get">

                                    <input type="submit" class="cart_quantity_delete" value="X">
                                </form>
                            </td>
                            </tr>
                        @endforeach

                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>Nhập thông tin thanh toán : </h3>
                <p>Nhập đầy đủ thông tin !</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="bill-to">
                        <p>Đơn hàng</p>
                        <div class="form-one">
                            @if (!empty($carts))
                                <form action="{{ route('ThanhToan') }}" method="POST">
                                    @csrf

                                    @foreach ($carts as $cart)
                                        <input type="hidden" name="id_sanpham{{ $cart['id_sanpham'] }}"
                                            value="{{ $cart['id_sanpham'] }}">

                                        <input type="hidden" id="paySoLuong{{ $cart['id_sanpham'] }}"
                                            name="soluong{{ $cart['id_sanpham'] }}" value="{{ $cart['soluong'] }}">

                                        <input type="hidden" id="payGia{{ $cart['id_sanpham'] }}"
                                            name="gia{{ $cart['id_sanpham'] }}" value="
                                                                                @if ($cart['sale']>
                                        0) {{ $cart['gia'] - ($cart['gia'] * $cart['sale']) / 100 }}
                                    @else
                                        {{ $cart['gia'] }} @endif
                                        ">

                                        <input type="hidden" id="payThanhTien{{ $cart['id_sanpham'] }}"
                                            name="thanhtien{{ $cart['id_sanpham'] }}"
                                            value="{{ ($cart['gia'] - ($cart['gia'] * $cart['sale']) / 100) * $cart['soluong'] }}">
                                    @endforeach

                                    <input type="hidden" name="trangThai" value="Đã đặt">
                                    <input type="hidden" name="tongTien" value="{{ $tongTien }}">
                                    <input type="text" placeholder="Tên người nhận" name="nguoiNhan" value="@if (Auth::check()) {{ Auth::user()->name }} @endif">
                                    <input type="text" placeholder="Email" name="email" value="@if (Auth::check()) {{ Auth::user()->email }} @endif">
                                    <input type="text" placeholder="Địa chỉ" name="diaChi">
                                    <input type="text" placeholder="Số điện thoại" name="phone">
                                    <input type="submit" class="btn btn-primary" value="Thanh Toán">
                            @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng tiền : <span id="tongTien">{{ number_format($tongTien) }} đ</span></li>
                            <li>Phí Ship : <span>Free</span></li>
                        </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a>
                  <a class="btn btn-default check_out" href="">Check Out</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    @foreach ($carts as $cart)
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#CongCart{{ $cart['id_sanpham'] }}').click(function() {
                    $.ajax({
                        url: '{{ route('CongCart') }}',
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id_sanpham: '{{ $cart['id_sanpham'] }}',
                        }
                    }).done(function(data) {
                        $('#soLuong{{ $cart['id_sanpham'] }}').html(data.soLuong);
                        $('#paySoLuong{{ $cart['id_sanpham'] }}').val(data.soLuong);

                        $('#thanhTien{{ $cart['id_sanpham'] }}').html(data.gia * data.soLuong);
                        $('#payThanhTien{{ $cart['id_sanpham'] }}').val(data.gia * data.soLuong);

                        $('#tongTien').html(data.tongTien);
                    });
                });

                $('#TruCart{{ $cart['id_sanpham'] }}').click(function() {
                    $.ajax({
                        url: '{{ route('TruCart') }}',
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id_sanpham: '{{ $cart['id_sanpham'] }}',
                        }
                    }).done(function(data) {
                        $('#soLuong{{ $cart['id_sanpham'] }}').html(data.soLuong);
                        $('#paySoLuong{{ $cart['id_sanpham'] }}').val(data.soLuong);

                        $('#thanhTien{{ $cart['id_sanpham'] }}').html(data.gia * data.soLuong);
                        $('#payThanhTien{{ $cart['id_sanpham'] }}').val(data.gia * data.soLuong);

                        $('#tongTien').html(data.tongTien);
                    });
                });



            });
        </script>
    @endforeach
@endsection
