   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

           <div class="sidebar-brand-text mx-0">Hello
               <sup>
                   @auth
                       {{ Auth::user()->name }}
                   @endauth
               </sup>
           </div>
       </a>
       <!-- Divider -->
       <hr class="sidebar-divider my-0">
       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 4)
               <li>
                   <div class="list-group mb-3 mt-3">
                       <a href="{{ route('thuonghieu.index') }}"
                           class="list-group-item list-group-item-action active">
                           Quản lí thương hiệu
                       </a>
                       <a href="{{ route('thuonghieu.create') }}" class="list-group-item list-group-item-action">Thêm
                           mới</a>
                   </div>
               </li>
           @endif
       @endif

       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 5)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('chungloai.index') }}" class="list-group-item list-group-item-action active">
                           Quản lí danh mục
                       </a>
                       <a href="{{ route('chungloai.create') }}" class="list-group-item list-group-item-action">Thêm
                           mới</a>
                   </div>
               </li>
           @endif
       @endif

       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 1)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('sanpham.index') }}" class="list-group-item list-group-item-action active">
                           Quản lí sản phẩm
                       </a>
                       <a href="quanli/sanpham/create" class="list-group-item list-group-item-action">Thêm mới</a>
                       <a class="list-group-item list-group-item-action" href="quanli/sanpham/sale">Thêm sale (%) hàng
                           loạt</a>
                       <a class="list-group-item list-group-item-action" href="quanli/sanpham/giamgia">Danh sách giảm
                           giá</a>
                       <a class="list-group-item list-group-item-action" href="quanli/sanpham/giamgia/create">Thêm giảm
                           giá</a>
                   </div>
               </li>
           @endif
       @endif
       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 2)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('nguoidung.index') }}" class="list-group-item list-group-item-action active">
                           Quản Lí Người Dùng
                       </a>
                       <a class="list-group-item list-group-item-action" href="{{ route('nguoidung.create') }}">Thêm
                           mới</a>
                   </div>
               </li>
           @endif
       @endif
       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 3)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('nguoidung.index') }}" class="list-group-item list-group-item-action active">
                           Quản Lí Đơn Hàng
                       </a>
                       <a class="list-group-item list-group-item-action" href="{{ route('donhang.index') }}">Danh
                           Sách
                           tất
                           cả đơn hàng</a>
                       <a class="list-group-item list-group-item-action"
                           href="{{ route('chitietdonhang.index') }}">Danh
                           Sách tất cả chi tiết đơn
                           hàng</a>
                   </div>
               </li>
           @endif
       @endif

       @if (Auth::user()->email == 'admin@gmail.com')
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('chucnang.index') }}" class="list-group-item list-group-item-action active">
                       Quản Lí Chức năng
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('chucnang.create') }}">
                       Thêm chức năng mỗi người dùng
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('chucnang.menu_create') }}">
                       Thêm mới quyền mỗi người dùng
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('chucnang.menu_index') }}">
                       Danh sách quyền người dùng
                   </a>

               </div>
           </li>
       @endif

   </ul>
