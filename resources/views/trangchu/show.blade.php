@extends('layouts.welcome')

@section('noidung')
    <div class="product-details">
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
                <div class="col-sm-12">
                    <ul>
                        @auth
                            <li> <img style="width: 50px; height: 50px;" src="{{ Auth::user()->image->duongdan ?? '' }}"
                                    alt="">
                                {{ Auth::user()->name }} </li>
                        @endauth

                        <li><i class="fa fa-clock-o"></i> {{ date('d-m-yy') }} </li>
                    </ul>

                    <form action="{{ route('binhluan.store', $sanpham->id) }}" method="POST">
                        @csrf
                        @if (!Auth::check())
                            <span>
                                <input type="text" name="name" placeholder="Your Name" />
                                <input type="email" name="email" placeholder="Email Address" />
                            </span>
                        @endif

                        <textarea name="noidung"></textarea>
                        <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />
                        <input type="submit" class="btn btn-default pull-right" value="Bình luận">
                    </form>
                </div>
            </div>
            <hr class="sidebar-divider my-0">
            <div class="tab-pane fade active in" id="reviews">
                @foreach ($sanpham->binhluans as $binhluan)
                    <div class="col-sm-12">
                        <div id="binhluan">
                            <ul>
                                <li> <img style="width: 50px; height: 50px;"
                                        src="{{ isset($binhluan->user->image->duongdan) ? $binhluan->user->image->duongdan : '/images/user/download (3).jpg' }}"
                                        alt="">
                                    {{ $binhluan->name }} </li>
                                <li><i class="fa fa-clock-o"></i> {{ $binhluan->created_at }} </li>
                            </ul>
                            <ul>
                                <li>{{ $binhluan->noidung }}</li>
                            </ul>
                        </div>
                        @if (isset($binhluan->tralois))
                        <div class="pull-right">
                            @foreach ($binhluan->tralois as $traloi)
                            
                                <ul>
                                    <li> <img style="width: 50px; height: 50px;"
                                            src="{{ isset($traloi->user->image->duongdan) ? $traloi->user->image->duongdan : '/images/user/download (3).jpg' }}"
                                            alt="">
                                        {{ $traloi->name }} </li>
                                    <li><i class="fa fa-clock-o"></i> {{ $traloi->created_at }} </li>
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
                            <li><a class="collapse" data-toggle="collapse"
                                    data-target="#collapse{{ $binhluan->id }}">Trả
                                    lời</a></li>
                        </ul>

                        <div id="collapse{{ $binhluan->id }}" class="collapse">
                            <div class="pull-right">
                                <ul>
                                    @auth
                                        <li> <img style="width: 50px; height: 50px;"
                                                src="{{ Auth::user()->image->duongdan ?? '' }}" alt="">
                                            {{ Auth::user()->name }} </li>
                                    @endauth

                                    <li><i class="fa fa-clock-o"></i> {{ date('d-m-yy') }} </li>
                                </ul>

                                <form action="{{ route('traloi.store', $binhluan->id) }}" method="POST">
                                    @csrf
                                    @if (!Auth::check())
                                        <span>
                                            <input type="text" name="nameTraloi" placeholder="Tên cún cơm" />
                                            <input type="email" name="emailTraloi" placeholder="Địa chỉ email" />
                                        </span>
                                    @endif
                            </div>
                            <textarea name="noidungTraloi"></textarea>
                            <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />

                            <input type="submit" class="btn btn-success pull-right" value="Trả lời">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--/category-tab-->

    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            $('#addCart').on('click', function() {
                $.ajax({
                    url: '{{ route('addToCart') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idsanpham: '{{ $sanpham->id }}',
                        _token: '{{ csrf_token() }}'
                    }
                }).done(function(data) {
                    $('#CountCart').html(data.count);
                });
            });



        });
    </script>


@endsection
