<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-0">Admin <sup>{{ Auth::check() ? Auth::user()->name : '' }}</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#toggle1">
            <i class="fa fa-list-ul"></i>
            <span>Quản Lí Sản Phẩm</span></a>
    </li>


    <!-- Divider -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item collapse" id="toggle1">
        <hr class="sidebar-divider my-0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true"
            aria-controls="collapse">
            <span>Thương hiệu</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="quanli/thuonghieu/create">Thêm Mới</a>
                <a class="collapse-item" href="quanli/thuonghieu">Danh Sách</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item collapse" id="toggle1">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
            aria-controls="collapse">
            <span>Danh mục</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="quanli/chungloai/create">Thêm Mới</a>
                <a class="collapse-item" href="quanli/chungloai">Danh Sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item collapse" id="toggle1">
        <hr class="sidebar-divider my-0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
            aria-controls="collapse">
            <span>Sản phẩm</span>
        </a>
        <hr class="sidebar-divider my-0">
        <div id="collapse3" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="quanli/sanpham/create">Thêm Mới</a>
                <a class="collapse-item" href="quanli/sanpham">Danh Sách</a>

                <hr class="sidebar-divide">

                <a class="collapse-item" href="quanli/sanpham/sale">Thêm sale (%) hàng loạt</a>

                <hr class="sidebar-divide">

                <a class="collapse-item" href="quanli/sanpham/giamgia">Danh sách giảm giá</a>
                <a class="collapse-item" href="quanli/sanpham/giamgia/create">Thêm giảm giá</a>

                <hr class="sidebar-divide">

                <a class="collapse-item" href="quanli/import/sanpham">Import Excel</a>
                <a class="collapse-item" href="quanli/export/sanpham">Export Excel</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#toggle4">
            <i class="fa fa-list-ul"></i>
            <span>Quản Lí Người Dùng</span></a>
    </li>


    <!-- Divider -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item collapse" id="toggle4">
        <hr class="sidebar-divider my-0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true"
            aria-controls="collapse">
            <span>Account</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="{{ route('nguoidung.create') }}">Thêm mới</a>
                <a class="collapse-item" href="{{ route('nguoidung.index') }}">Danh sách</a>

                <hr class="sidebar-divide">
                
                @if (Auth::check() && Auth::user()->email == 'admin@gmail.com')
                    <a class="collapse-item" href="{{ route('chucnang.index') }}">Danh sách chức năng</a>
                    <a class="collapse-item" href="{{ route('chucnang.create') }}">Thêm chức năng</a>
                @endif

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#toggle5">
            <i class="fa fa-list-ul"></i>
            <span>Quản Lí Đơn Hàng</span></a>
    </li>


    <!-- Divider -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item collapse" id="toggle5">
        <hr class="sidebar-divider my-0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true"
            aria-controls="collapse">
            <span>Đơn hàng</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="{{ route('donhang.index') }}">Danh Sách</a>
            </div>
        </div>

        <hr class="sidebar-divider my-0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true"
            aria-controls="collapse">
            <span>Chi tiết đơn hàng</span>
        </a>
        <div id="collapse6" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức Năng :</h6>
                <a class="collapse-item" href="{{ route('chitietdonhang.index') }}">Danh Sách</a>
            </div>
        </div>

    </li>
    <hr class="sidebar-divider my-0">
</ul>
