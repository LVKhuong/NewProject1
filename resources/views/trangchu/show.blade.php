@extends('layouts.welcome')

@section('noidung')
    <div class="product-details">

        {{-- // breadcrumb --}}
        <div class="col-sm-12" style="font-size: 18px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('trangchu') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('trangchu', ['thuonghieu' => $sanpham->thuonghieu->id]) }}">{{ $sanpham->thuonghieu->ten }}</a>
                    </li>
                    <li class="breadcrumb-item "><a
                            href="{{ route('trangchu', ['chungloai' => $sanpham->chungloai->id]) }}">{{ $sanpham->chungloai->ten }}</a>
                    </li>
                </ol>
            </nav>
        </div>
        <!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{ $sanpham->images->first()->duongdan }}" alt="" />
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach ($sanpham->images as $image)
                            <img style="width: 100px; height:100px" src="{{ $image->duongdan }}" alt="">
                        @endforeach
                    </div>
                </div>

                {{-- <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a> --}}
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information">
                <!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{ $sanpham->ten }}</h2>
                <p>ID sản phẩm : 000{{ $sanpham->id }}</p>
                <img src="images/product-details/rating.png" alt="" />
                <span>
                    <span>{{ number_format($sanpham->gia) }} đ</span>
                    <label>Số lượng:</label>
                    <input type="text" value="1" />
                    <button type="button" id="addCart" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                <p><b>Chủng loại:</b> {{ $sanpham->chungloai->ten }}</p>
                <p><b>Sản phảm loại:</b> {{ $sanpham->isHot == 1 ? 'HOT' : '_' }}
                    {{ $sanpham->isNew == 1 ? 'NEW' : '_' }}</p>
                <p><b>Thương hiệu:</b> {{ $sanpham->thuonghieu->ten }}</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                <br>
                <p>Tag :
                    @if (isset($tags))
                        @foreach ($tags as $tag)
                            <a href="{{ route('trangchu', ['TimKiem' => $tag]) }}">{{ $tag }}</a>,
                        @endforeach
                    @endif
                </p>
            </div>
            <!--/product-information-->
        </div>
    </div>
    <!--/product-details-->

    <div class="category-tab shop-details-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a>Đánh giá ({{ count($sanpham->binhluans) }})</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="reviews">

                {{-- form binh luan --}}
                <div class="col-sm-12">
                    <ul>
                        @auth
                            <li> <img style="width: 50px; height: 50px;" src="{{ Auth::user()->image->duongdan ?? '' }}"
                                    alt="">
                                {{ Auth::user()->name }} </li>
                        @endauth

                        <li><i class="fa fa-clock-o"></i> <b>{{ date('d-m-yy') }}</b> </li>
                    </ul>


                    @if (!Auth::check())
                        <span>
                            <input type="text" name="name" id="name" placeholder="Your Name" />
                            <input type="email" name="email" id="email" placeholder="Email Address" />
                        </span>
                    @endif

                    <textarea name="noidung" id="noidung"></textarea>
                    <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />

                    <input type="button" id="btn-binhluan" class="btn btn-default pull-right" value="Bình luận">

                </div>
            </div>

            {{-- hien thi binh luan --}}
            <div class="tab-pane fade active in m-0" id="reviews">
                @foreach ($sanpham->binhluans as $binhluan)
                    <div class="col-sm-12">
                        <div id="binhluan">
                            <ul>
                                <li> <img style="width: 50px; height: 50px;"
                                        src="{{ isset($binhluan->user->image->duongdan) ? $binhluan->user->image->duongdan : '/images/user/download (3).jpg' }}"
                                        alt="">
                                    <b>{{ $binhluan->name }}</b>
                                </li>
                            </ul>
                            <ul>
                                <li><i class="fa fa-clock-o"></i> <b>{{ $binhluan->created_at }}</b> </li>
                            </ul>
                            <ul>
                                <li>{{ $binhluan->noidung }}</li>
                            </ul>
                        </div>

                        @if (isset($binhluan->tralois))

                            {{-- hien thi tra loi binh luan --}}
                            <div class="pull-right">
                                @foreach ($binhluan->tralois as $traloi)

                                    <ul>
                                        <li> <img style="width: 50px; height: 50px;"
                                                src="{{ isset($traloi->user->image->duongdan) ? $traloi->user->image->duongdan : '/images/user/download (3).jpg' }}"
                                                alt="">
                                            <b>{{ $traloi->name }}</b>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> <b>{{ $traloi->created_at }}</b> </li>
                                    </ul>
                                    <ul>
                                        <li>{{ $traloi->noidung }}</li>
                                    </ul>

                                @endforeach
                            </div>
                        @endif
                    </div>

                    <hr class="sidebar-divider my-0">
                    <div class="col-sm-12">
                        <ul>
                            <li><a class="collapse btn btn-success" data-toggle="collapse"
                                    data-target="#collapse{{ $binhluan->id }}">Trả
                                    lời</a></li>
                        </ul>

                        <div id="collapse{{ $binhluan->id }}" class="collapse">

                            {{-- form tra loi binh luan --}}
                            <div class="pull-right">
                                <ul>
                                    @auth
                                        <li> <img style="width: 50px; height: 50px;"
                                                src="{{ Auth::user()->image->duongdan ?? '' }}" alt="">
                                            <b>{{ Auth::user()->name }}</b>
                                        </li>
                                    @endauth

                                    <li><i class="fa fa-clock-o"></i> <b>{{ date('d-m-yy') }}</b> </li>
                                </ul>

                                <form action="{{ route('traloi.store', $binhluan->id) }}" method="POST">
                                    @csrf
                                    @if (!Auth::check())
                                        <span>
                                            <input type="text" id="nameTraloi" name="nameTraloi"
                                                placeholder="Tên cún cơm" />
                                            <input type="email" id="emailTraloi" name="emailTraloi"
                                                placeholder="Địa chỉ email" />
                                        </span>
                                    @endif
                            </div>
                            <textarea name="noidungTraloi"></textarea>
                            <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />

                            <input type="submit" class="btn btn-success pull-right" value="Trả lời">

                            </form>
                        </div>
                        <hr width="100%" color="#171717">
                    </div>

                @endforeach
            </div>

        </div>
        <div id="binhluan_ajax">

        </div>
    </div>
    <!--/category-tab-->

    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <h2 class="title text-center">{{ $sanpham->thuonghieu->ten }}</h2>
                    @foreach ($sanpham->thuonghieu->sanpham->take(4) as $sp)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ $sp->images->first()->duongdan }}" alt="" />
                                        <h2>{{ number_format($sp->gia) }}</h2>
                                        <p>{{ $sp->ten }}</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="item">
                    <h2 class="title text-center">{{ $sanpham->chungloai->ten }}</h2>
                    @foreach ($sanpham->chungloai->sanpham->take(4) as $sp1)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ $sp1->images->first()->duongdan }}" alt="" />
                                        <h2>{{ number_format($sp1->gia) }}</h2>
                                        <p>{{ $sp1->ten }}</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!--/recommended_items-->


@endsection

@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //them vao gio hang 
            $('#addCart').on('click', function() {
                $.ajax({
                    url: '{{ route('addToCart') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idsanpham: '{{ $sanpham->id }}',
                    }
                }).done(function(data) {
                    $('#CountCart').html(data.count);
                });
            });

            // ajax binh luan
            $('#btn-binhluan').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var noidung = $('#noidung').val();

                $.ajax({
                    url: '{{ route('binhluan.store', $sanpham->id) }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        name: name,
                        email: email,
                        noidung: noidung,
                        idsanpham: '{{ $sanpham->id }}',
                    }
                }).done(function(data) {
                    $('#binhluan_ajax').html(data.binhluan);
                });
            });

            //  ajax tra loi binh luan
            $('#traloi')

        });
    </script>


@endsection
