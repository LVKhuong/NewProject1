<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i>+84 76854 303</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>ShopABCD@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 position-relative">
                    <div class="contactinfo pull-right">
                        <ul class=" nav nav-pills">
                            @if (Route::has('login'))
                                @auth
                                    @if (isset(Auth::user()->image->duongdan))
                                        <img class="img-profile rounded-circle"
                                            src="{{ Auth::user()->image->duongdan ?? '' }}"
                                            style="width: 30px; height:30px;" alt="Chưa có ảnh">
                                    @endif

                                    <li><a href="{{ url('/home') }}"><b>{{ Auth::user()->name }}</b></a></li>
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif

                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('trangchu') }}"><img src="images/home/logo.png" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Việt Nam
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                VNĐ
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('shoppingCart') }}">
                                    <i class="fa fa-shopping-cart">
                                        <span id="CountCart" class="badge badge-warning"
                                            style="background: #171717">{{ session()->has('count') ? session()->get('count') : '0' }}
                                        </span>
                                    </i>Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('trangchu') }}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($data_chungloai as $chungloai)
                                        <li><a
                                                href="{{ route('trangchu', ['chungloai' => $chungloai->id]) }}">{{ $chungloai->ten }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($data_thuonghieu as $thuonghieu)
                                        <li><a
                                                href="{{ route('trangchu', ['thuonghieu' => $thuonghieu->id]) }}">{{ $thuonghieu->ten }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>

                </div>
                <form action="{{ route('trangchu') }}" method="get" autocomplete="off">
                    <div class="col-sm-5 ">
                        <input type="text" style="width: 100%;" placeholder="Tìm kiếm sản phẩm, thương hiệu"
                            name="TimKiem" id="key" />
                        <div id="search_ajax">

                        </div>
                    </div>

                    <div class="col-sm-1">
                        <input type="submit" class="btn" value="Tìm kiếm" style="background: #FE980F;">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<!--/header-->
