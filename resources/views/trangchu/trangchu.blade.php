@extends('layouts.welcome')

@section('noidung')
    <div class="row" id="view_allsanpham">
            <!--Danh sách all sản phẩm-->
            <h2 class="title text-center">Tất cả sản phẩm</h2>
            @foreach ($dataSanPham as $data)
                <div class="product-image-wrapper col-sm-4" style="height:400px;">

                    <div class="single-products">
                        <div class="productinfo text-justify">

                            <a href="{{ route('sanphamshow', $data->id) }}">
                                <img src="{{ $data->images->first()->duongdan ?? '' }}" alt="Chưa có ảnh"
                                    style="width: 100%; height:300px; position: relative" />
                            </a>

                            @if (isset($data->giamgia))
                                <span style="position: absolute; right:60px; background: black"
                                    class="badge badge-warning">Mua {{ $data->giamgia->tong_soluong }} Giảm
                                    {{ $data->giamgia->giagiam }} đ</span>
                            @endif

                            @if ($data->isHot == 1)
                                <span style="position: absolute;right:0; background: red"
                                    class="badge badge-warning">HOT</span>
                            @endif

                            @if ($data->isNew == 1)
                                <span style="position: absolute;right:0; background: green"
                                    class="badge badge-warning">NEW</span>
                            @endif

                            @if ($data->sale > 0)
                                <span style="position: absolute;left:0; background: black"
                                    class="badge badge-warning">{{ $data->sale }} %</span>
                            @endif

                            <a href="{{ route('sanphamshow', $data->id) }}">
                                <p style="font-size: 14px;"><b>{{ $data->ten }}</b></p>
                            </a>

                            <div>
                                @if ($data->sale > 0)
                                    <h6 class="col-sm-14" style="font-size: 16px">
                                        <b class="col-sm-6">$
                                            {{ $data->gia - ($data->gia * $data->sale) / 100 }}
                                        </b>
                                        <del class="col-sm-6"> $ {{ $data->gia }}</del>
                                    </h6>
                                @else
                                    <h6 class="col-sm-6" style="font-size: 16px"><b> $ {{ $data->gia }}
                                        </b>
                                    </h6>
                                @endif
                            </div>

                            {{-- <input type="button" id="addCart{{ $data->id }}" class="btn btn-default add-to-cart"
                                value="Thêm giỏ hàng">
                            <a href="{{ route('shoppingCart') }}" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Giỏ hàng</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        <div>
            {!! $dataSanPham->links() !!}
        </div>
    </div>
@endsection


@section('script')

    <script>
        $(function(){
            $('#SapXep').change(function(){
                var sapxep = $('#SapXep').val();
                $.ajax({
                    url: '{{route('sapxep')}}',
                    method: 'GET',
                    data: {
                        sapxep: sapxep,
                    }
                }).done(function(data){
                    $('#view_allsanpham').html(data);
                });
            })
        });
    </script>

@endsection
