<div class="left-sidebar">
    <h2>Danh mục</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        @foreach ($ChungLoais as $ChungLoai)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{ route('trangchu', ['chungloai' => $ChungLoai->id]) }}"><span
                                class="pull-right">({{ count($sanphams[$ChungLoai->id]) }})</span>{{ $ChungLoai->ten }}</a>
                    </h4>
                </div>
            </div>
        @endforeach
    </div>
    <!--/category-products-->

    <div class="brands_products">
        <!--brands_products-->
        <h2>Thương hiệu</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($ThuongHieus as $ThuongHieu)
                    <li><a href="{{ route('trangchu', ['thuonghieu' => $ThuongHieu->id]) }}">
                            <span class="pull-right">
                                ({{ count($SanPhams[$ThuongHieu->id]) }})
                            </span>{{ $ThuongHieu->ten }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/brands_products-->

    {{-- <div class="price-range">
        <!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div> --}}

    <div class="brands_products">
        <div class="row">
            <h2>Sắp xếp theo</h2>
            <form action="{{ route('trangchu') }}" method="get">
                <div class="col-sm-8">
                    <select class="form-control" name="SapXep">
                        <option>Mời bạn chọn</option>
                        <option value="desc">Giá dần</option>
                        <option value="asc">Giá tăng dần</option>
                        <option value="new">Sản phẩm New</option>
                        <option value="hot">Sản phẩm Hot</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="submit" value="Sắp xếp" style="background: #FE980F;" class="btn btn-default">
                </div>
            </form>
        </div>

        <div class="brands-name row" style="padding-top: 50px;">
            <h2>Khuyến mãi</h2>
            @foreach ($dataSanPhamAll->where('sale', '>', 0)->take(6) as $sanpham)
                <ul class="nav nav-pills nav-stacked">
                    <li style="text-align: right">
                        <div class="col-sm-5">
                            <a href="{{ route('sanphamshow', $sanpham->id) }}"><img style="width: 155%;
                                        height: 170px;margin-left: -40px;"
                                    src="{{ $sanpham->images->first()->duongdan }}" alt=""></a>
                        </div>
                        <div class="col-sm-7">
                            <a href="{{ route('sanphamshow', $sanpham->id) }}"><b>
                                    <h6 style="color: #171717">{{ $sanpham->ten }}</h6>
                                </b></a>
                            <h6 style="color: red">SALE : {{ $sanpham->sale }} %</h6>
                            <del>
                                <h6>Gốc: {{ number_format($sanpham->gia) }} đồng</h6>
                            </del>
                            <b>
                                <h6>Giá: {{ number_format(($sanpham->gia * (100 - $sanpham->sale)) / 100) }} đồng
                                </h6>
                            </b>
                        </div>
                    </li>
                </ul>
            @endforeach

            <div class="col-sm-12 text-center" style="margin-top: 20px;">
                <a class="btn btn-default" style="color: #171717; font-size: 16px"
                    href="{{ route('trangchu', ['sale' => 1]) }}">Xem thêm</a>
            </div>

        </div>
    </div>
</div>
