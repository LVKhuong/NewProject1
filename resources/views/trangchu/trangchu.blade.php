@extends('layouts.welcome')

@section('noidung')

    <div class="row">
        <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Tất cả sản phẩm</h2>

            @foreach ($dataSanPham as $data)
                <div class="product-image-wrapper col-sm-4">

                    <div class="single-products">
                        <div class="productinfo text-center">

                            <img src="{{ $data->images->first()->duongdan ?? "" }}" alt="Chưa có ảnh"
                                style="width: 100%; height:300px; position: relative" />
                            @if (isset($data->giamgia))
                                <span style="position: absolute; right:0; background: black" class="badge badge-warning">Mua
                                    {{ $data->giamgia->tong_soluong }} Giảm
                                    {{ number_format($data->giamgia->giagiam) }} đ</span>
                            @endif
                            <div class="row">
                                @if ($data->sale > 0)
                                    <h2 class="col-sm-6">
                                        {{ number_format($data->gia - ($data->gia * $data->sale) / 100) }}<span>đ</span>
                                    </h2>
                                    <h3 class="col-sm-6"><del>{{ number_format($data->gia) }}<span>đ</span></del></h3>
                                @else
                                    <h2 class="col-sm-12 text-center">{{ number_format($data->gia) }}<span>đ</span></h2>
                                @endif
                            </div>
                            <p><b>{{ $data->ten }}</b></p>
                            <input type="button" id="addCart{{ $data->id }}" class="btn btn-default add-to-cart"
                                value="Thêm giỏ hàng">
                            <a href="{{ route('shoppingCart') }}" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Giỏ hàng</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $dataSanPham->links() }}
        </div>
    </div>
@endsection


@section('script')
    @foreach ($dataSanPham as $data)
        <script>
            $(function() {
                $('#addCart{{ $data->id }}').on('click', function() {
                    $.ajax({
                        url: '{{ route('addToCart') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            idsanpham: '{{ $data->id }}',
                            _token: '{{ csrf_token() }}'
                        }
                    }).done(function(data) {
                        $('#CountCart').html(data.count);
                    });
                });
            });
        </script>
    @endforeach
@endsection
