   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion col-sm-2 pl-3" id="accordionSidebar">
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

       {{-- Thương hiệu --}}
       @if (!empty(Auth::user()->role->role))
           @if (Auth::user()->role->role == 4)
               <li>
                   <div class="list-group mb-3 mt-3">
                       <a href="{{ route('thuonghieu.index') }}"
                           class="list-group-item list-group-item-action active">
                           Danh sách thương hiệu
                       </a>
                       <a href="{{ route('thuonghieu.create') }}" class="list-group-item list-group-item-action">Thêm
                           mới</a>
                   </div>
               </li>
           @endif


           {{-- Chủnng loại --}}
           @if (Auth::user()->role->role == 5)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('chungloai.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách danh mục
                       </a>
                       <a href="{{ route('chungloai.create') }}" class="list-group-item list-group-item-action">Thêm
                           mới</a>
                   </div>
               </li>
           @endif



           {{-- sản phẩm --}}
           @if (Auth::user()->role->role == 1)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('sanpham.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách sản phẩm
                       </a>
                       <a href="quanli/sanpham/create" class="list-group-item list-group-item-action">Thêm mới</a>
                       <a class="list-group-item list-group-item-action" href="quanli/sanpham/sale">Thêm sale (%) hàng
                           loạt</a>
                       <a class="list-group-item list-group-item-action" href="quanli/sanpham/giamgia">Danh sách giảm
                           giá</a>

                   </div>
               </li>
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('thuoctinh.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách thuộc tính
                       </a>
                       <a href="{{ route('thuoctinh.create') }}" class="list-group-item list-group-item-action">Thêm
                           mới</a>
                   </div>
               </li>
           @endif


           {{-- //nguoi dung --}}
           @if (Auth::user()->role->role == 2)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('nguoidung.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách Người Dùng
                       </a>
                       <a class="list-group-item list-group-item-action" href="{{ route('nguoidung.create') }}">Thêm
                           mới</a>
                   </div>
               </li>
           @endif


           {{-- //don hang, chi tiet don hang --}}
           @if (Auth::user()->role->role == 3)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('donhang.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách Đơn Hàng
                       </a>
                       <a class="list-group-item list-group-item-action"
                           href="{{ route('chitietdonhang.index') }}">Danh
                           Sách tất cả chi tiết đơn
                           hàng</a>
                   </div>
               </li>

           @endif

           {{-- quyen danh gia san pham --}}

           @if (Auth::user()->role->role == 7)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('traloi.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách đánh giá
                       </a>
                   </div>
               </li>
           @endif

           @if (Auth::user()->role->role == 8)
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('mausac.index') }}" class="list-group-item list-group-item-action active">
                           Danh sách màu sắc
                       </a>
                   </div>
               </li>
               <li>
                   <div class="list-group mb-3">
                       <a href="{{ route('size_tongsoluong.index') }}"
                           class="list-group-item list-group-item-action active">
                           Danh sách size và tổng số lượng
                       </a>
                   </div>
               </li>
           @endif
       @endif

       @if (Auth::user()->email == 'admin@gmail.com')
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('chungloai.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách danh mục
                   </a>
                   <a href="{{ route('chungloai.create') }}" class="list-group-item list-group-item-action">Thêm
                       mới</a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3 mt-3">
                   <a href="{{ route('thuonghieu.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách thương hiệu
                   </a>
                   <a href="{{ route('thuonghieu.create') }}" class="list-group-item list-group-item-action">Thêm
                       mới</a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('sanpham.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách sản phẩm
                   </a>
                   <a href="quanli/sanpham/create" class="list-group-item list-group-item-action">Thêm mới</a>
                   <a class="list-group-item list-group-item-action" href="quanli/sanpham/sale">Thêm sale (%)
                       hàng
                       loạt</a>
                   <a class="list-group-item list-group-item-action" href="quanli/sanpham/giamgia">Danh sách
                       giảm
                       giá</a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('mausac.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách màu sắc
                   </a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('size_tongsoluong.index') }}"
                       class="list-group-item list-group-item-action active">
                       Danh sách size và tổng số lượng
                   </a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('nguoidung.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách Người Dùng
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('nguoidung.create') }}">Thêm
                       mới</a>
               </div>
           </li>
           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('traloi.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách đánh giá
                   </a>
               </div>
           </li>

           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('donhang.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách Đơn Hàng
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('chitietdonhang.index') }}">Danh
                       Sách tất cả chi tiết đơn
                       hàng</a>
               </div>
           </li>

           <li>
               <div class="list-group mb-3">
                   <a href="{{ route('chucnang.index') }}" class="list-group-item list-group-item-action active">
                       Danh sách Chức năng (ADMIN)
                   </a>
                   <a class="list-group-item list-group-item-action" href="{{ route('chucnang.create') }}">
                       Thêm chức năng mỗi người dùng
                   </a>
               </div>
           </li>




       @endif


   </ul>
