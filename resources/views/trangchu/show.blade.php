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
            <form action="{{ route('addToCart') }}" id="form_thuoctinh" method="POST">
                @csrf
                <input type="hidden" name="idsanpham" value="{{ $sanpham->id }}">
                <div class="product-information">
                    <!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $sanpham->ten }}</h2>
                    <p>ID sản phẩm : 000_{{ $sanpham->id }}</p>
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
                        @if ($sanpham->sale > 0)
                            <span><del>{{ $sanpham->gia }} đ</del></span>
                            <span>{{ ($sanpham->gia * (100 - $sanpham->sale)) / 100 }} đ</span>
                        @else
                            <span>{{ $sanpham->gia }} đ</span>
                        @endif


                        <button type="submit" id="addCart" class="btn btn-fefault cart">
                            Thêm vào giỏ hàng
                        </button>
                        <a href="{{ route('shoppingCart') }}" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Đi tới giỏ hàng
                        </a>
                    </span>

                    <p>
                    <div class="form-check form-check-inline">
                        <b>Mùa sắc : </b>
                        @foreach ($sanpham->mausacs as $mausac)
                            <input class="form-check-input" checked type="radio" name="mausac" value="{{ $mausac->id }}">
                            <label class="form-check-label" for="inlineRadio{{ $mausac->id }}">
                                <img src="{{ $mausac->image->duongdan ?? '' }}" alt="" style="width: 20px; height:20px;">
                                {{ $mausac->mausac }}
                            </label>
                        @endforeach
                    </div>
                    </p>

                    <p>
                    <div class="form-check form-check-inline">
                        <b>Size : </b>
                        @foreach ($sanpham->size_tongsoluongs as $size)
                            <input class="form-check-input" checked type="radio" name="size" value="{{ $size->id }}">
                            <label class="form-check-label" for="inlineRadio{{ $size->id }}">
                                {{ $size->size }}
                            </label>
                        @endforeach
                    </div>
                    </p>

            </form>
            <p>
                <b>Chủng loại:</b>
                {{ $sanpham->chungloai->ten }}
            </p>
            <p>
                <b>Sản phảm loại:</b>
                {{ $sanpham->isHot == 1 ? 'HOT' : '_' }}
                {{ $sanpham->isNew == 1 ? 'NEW' : '_' }}
            </p>
            <p>
                <b>Thương hiệu:</b>
                {{ $sanpham->thuonghieu->ten }}
            </p>
            <a href="">
                <img src="images/product-details/share.png" class="share img-responsive" alt="" />
            </a>

            <br>

            <p>Tag :

                @if (isset($tags))
                    @foreach ($tags as $tag)
                        <a href="{{ route('trangchu', ['TimKiem' => $tag]) }}">{{ $tag }}</a>,
                    @endforeach
                @endif

            </p>
        </div>

    </div>

    <div class="col-sm-12 product-details">
        <p>
            {!! $sanpham->gioithieu !!}
        </p>

    </div>

    <div class="category-tab shop-details-tab">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a>Đánh giá</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="reviews">
                {{-- form đánh giá --}}
                <div class="col-sm-12">
                    <ul>
                        @auth
                            <li> <img style="width: 50px; height: 50px;" src="{{ Auth::user()->image->duongdan ?? '' }}"
                                    alt="">
                                {{ Auth::user()->name }}
                            </li>
                        @endauth

                        <li><i class="fa fa-clock-o"></i> <b>{{ date('d-m-yy') }}</b> </li>
                    </ul>
                    <form method="POST" enctype="multipart/form-data" id="form_danhgia">
                        @csrf

                        @if (!Auth::check())
                            <span>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                                <input type="email" name="email" id="email" placeholder="Email Address" />
                            </span>
                        @endif
                        <input type="hidden" name="id_sanpham" id="id_sanpham" value="{{ $sanpham->id }}">
                        <textarea name="noidung" id="noidung"></textarea>

                        <ul class="list-inline">
                            <li class="rating">
                                <b>Đánh giá : </b>
                            </li>
                            <li>
                                <div class="stars">
                                    <input class="star star-1" id="star-1" type="radio" name="sao" value="1" />
                                    <label class="star star-1" for="star-1">1*</label>

                                    <input class="star star-2" id="star-2" type="radio" name="sao" value="2" />
                                    <label class="star star-2" for="star-2">2*</label>

                                    <input class="star star-3" id="star-3" type="radio" name="sao" value="3" />
                                    <label class="star star-3" for="star-3">3*</label>

                                    <input class="star star-4" id="star-4" type="radio" name="sao" value="4" />
                                    <label class="star star-4" for="star-4">4*</label>

                                    <input class="star star-5" id="star-5" type="radio" name="sao" value="5" />
                                    <label class="star star-5" for="star-5">5*</label>
                                </div>
                            </li>
                            <li class="pull-right">
                                <input type="file" name="images_danhgia[]" id="images_danhgia" multiple>
                            </li>
                        </ul>
                        <input type="hidden" value="{{ $sanpham->id }}" name="id_sanpham">
                        <input type="submit" id="btn_danhgia" class="btn btn-default pull-right" value="Đánh giá">
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- // view danh gia --}}
    <div id="ajax_danhgia">

    </div>
    @foreach ($sanpham->danhgias as $danhgia)
        <div class="category-tab shop-details-tab" style="border-bottom: 1px solid #171717">
            <div>
                <div class="col-sm-12 mt-5">
                    <img style="width: 50px; height: 50px;"
                        src="{{ !empty($danhgia->user->image) ? $danhgia->user->image->duongdan : '/images/user/download (3).jpg' }}"
                        alt="">
                    <b>{{ $danhgia->name ?? '' }}</b>
                    <i class="fa fa-clock-o"></i> <b>{{ date('d-m-yy') }}</b>
                    <b><span>{{ $danhgia->sao }} Sao</span></b>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in row">
                        <div class="col-sm-12">
                            <p>{{ $danhgia->noidung }}</p>
                        </div>
                        @foreach ($danhgia->images as $image)
                            <div class="col-sm-3">
                                <img src="{{ $image->duongdan }}" style="width: 200px; height:200px;"
                                    alt="Chưa có ảnh">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <ul class="nav nav-tabs ">
                    <li class="active pull-right" style="margin-right: 15px;">
                        <button class="btn btn-default" data-toggle="collapse"
                            data-target="#traloi{{ $danhgia->id }}">Trả lời</button>
                    </li>
                </ul>
            </div>

            <div class="pull-right collapse" id="traloi{{ $danhgia->id }}">
                @if (!empty($danhgia->tralois))
                    @foreach ($danhgia->tralois as $traloi)
                        <div class="col-sm-12 mt-5">
                            <img style="width: 50px; height: 50px;" src="{{ $traloi->user->image->duongdan ?? '' }}"
                                alt="">
                            {{ $traloi->user->name ?? '' }}
                            <i class="fa fa-clock-o"></i> <b>{{ $traloi->created_at }}</b>s
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in row">
                                <div class="col-sm-12">
                                    <p>{{ $traloi->noidung }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    @endforeach


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
                                        <h2>{{ $sp->gia }}</h2>
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
                                        <h2>{{ $sp1->gia }}</h2>
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
            $('#form_thuoctinh').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('addToCart') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: new FormData(this),
                    contentType: false, // dữ liệu gửi đến máy chủ phải chọn false
                    cache: false, // dừng 2 bộ nhớ cache trong trình duyệt
                    processData: false, // gửi tệp tài liệu file chưa xử lí
                }).done(function(data) {
                    $('#CountCart').text(data.count);
                });
            });

            // gui data = form -> ajax
            $('#form_danhgia').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('danhgia') }}',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false, // dữ liệu gửi đến máy chủ phải chọn false
                    cache: false, // dừng 2 bộ nhớ cache trong trình duyệt
                    processData: false, // gửi tệp tài liệu file chưa xử lí
                }).done(function(data) {
                    $('#ajax_danhgia').after(data);
                });
            });


        });
    </script>


@endsection
