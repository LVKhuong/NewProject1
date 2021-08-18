<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\sanpham;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\thuonghieu;
use App\Models\chungloai;
use App\Models\danhgia;
use App\Models\FileImage;
use App\Models\mausac;
use App\Models\size_tongsoluong;
use App\Models\thongke;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrangChuController extends Controller
{
    public function index(Request $request)
    {
        $ThuongHieus = thuonghieu::all();
        foreach ($ThuongHieus as $ThuongHieu) {
            $SanPhams[$ThuongHieu->id] = thuonghieu::find($ThuongHieu->id)->sanpham;
        }
        $ChungLoais = chungloai::all();
        foreach ($ChungLoais as $ChungLoai) {
            $sanphams[$ChungLoai->id] = chungloai::find($ChungLoai->id)->sanpham;
        }

        if ($request->has('thuonghieu')) {
            $dataSanPham = sanpham::where('id_thuonghieu', $request->input('thuonghieu'))->paginate(18);
            $dataSanPham->appends($request->all());
        } else if ($request->has('sale')) {
            $dataSanPham = sanpham::where('sale', '>', 0)->paginate(18);
            $dataSanPham->appends($request->all());
        } else if ($request->has('chungloai')) {
            $dataSanPham = sanpham::where('id_chungloai', $request->input('chungloai'))->paginate(18);
            $dataSanPham->appends($request->all());
        } else if ($request->has('TimKiem')) {
            $dataSanPham = sanpham::where('ten', 'like', '%' . $request->input('TimKiem') . '%')->paginate(18);
            $dataSanPham->appends($request->all());
        } else {
            $dataSanPham = sanpham::paginate(18);
        }
        $dataSanPhamAll = sanpham::orderBy('created_at', 'desc')->get();

        $count = session()->get('count');

        return view('trangchu.trangchu', [
            'SanPhams'      => $SanPhams,
            'sanphams'      => $sanphams,
            'dataSanPham'   => $dataSanPham,
            'count' => $count,
            'dataSanPhamAll' => $dataSanPhamAll,
        ]);
    }

    public function addToCart(Request $request)
    {
        $SanPham = sanpham::find($request->idsanpham);
        $Cart = session()->has('cart') ? session()->get('cart') : [];

        // kiem tra == id_sanpham có rồi thì cộng thêm số lượng
        if (array_key_exists($SanPham->id, $Cart)) {
            $Cart[$SanPham->id]['soluong'] = $Cart[$SanPham->id]['soluong'] + 1;
            session()->put(['cart' => $Cart]);
        } else {
            $Cart[$SanPham->id] = [
                'ten' => $SanPham->ten,
                'gia' => $SanPham->gia,
                'soluong' => 1,
                'sale' => $SanPham->sale,
                'gia_sale' => $SanPham->gia * (100 - $SanPham->sale) / 100,
                'id_sanpham' => $SanPham->id,
                'id_mausac' => $request->mausac,
                'id_size' => $request->size,
            ];

            $count = count($Cart);
            session()->put([
                'cart' => $Cart
            ]);
        }

        $giamgia = $SanPham->giamgia;

        // kiểm tra số lượng -> được giảm giá theo đơn giá
        if (isset($giamgia->tong_soluong) && $Cart[$SanPham->id]['soluong'] >= $giamgia->tong_soluong) {
            $Cart[$SanPham->id]['gia'] = $giamgia->giagiam;

            session()->put([
                'cart' => $Cart,
            ]);
        }
        session()->put(['count' => count($Cart)]);

        return response()->json(['cart' => session()->get('cart'), 'count' => session()->get('count')]);
    }

    public function shoppingCart(Request $request)
    {
        $carts =  session()->get('cart');

        if (!empty($carts)) {
            $ThuongHieus = thuonghieu::all();
            foreach ($ThuongHieus as $ThuongHieu) {
                $SanPhams[$ThuongHieu->id] = thuonghieu::find($ThuongHieu->id)->sanpham;
            }

            $ChungLoais = chungloai::all();
            foreach ($ChungLoais as $ChungLoai) {
                $sanphams[$ChungLoai->id] = chungloai::find($ChungLoai->id)->sanpham;
            }
            $count = session()->get('count');


            $tongTien = 0;
            foreach ($carts as $cart) {
                $images = sanpham::find($cart['id_sanpham'])->images;
                $tongTien = $tongTien + (($cart['gia'] - ($cart['gia'] * $cart['sale'] / 100)) * $cart['soluong']);

                $mausacs[$cart['id_sanpham']] = mausac::find($cart['id_mausac']);
                $sizes[$cart['id_sanpham']] = size_tongsoluong::find($cart['id_size']);
            }

            $dataAllSanpham = sanpham::all();

            return view('trangchu.shoppingcart', [
                'count'         => $count,
                'SanPhams'      => $SanPhams,
                'sanphams'      => $sanphams,
                'carts'         => $carts,
                'images' => $images,
                'tongTien' => $tongTien,
                'mausacs' => $mausacs,
                'sizes' => $sizes,
                'dataAllSanpham' => $dataAllSanpham,
            ]);
        } else {
            return redirect()->route('trangchu');
        }
    }

    public function CongCart(Request $request)
    {
        $idSanPham = $request->id_sanpham;
        $carts = session()->get('cart');

        $carts[$idSanPham]['soluong'] = $carts[$idSanPham]['soluong'] + 1;
        session()->put(['cart' => $carts]);

        $tongTien = 0;
        if (session()->has('cart')) {
            foreach ($carts as $cart) {
                $tongTien = $tongTien + (($cart['gia'] - ($cart['gia'] * $cart['sale'] / 100)) * $cart['soluong']);
            }
        }

        return response()->json([
            'soLuong' => $carts[$idSanPham]['soluong'],
            'gia' => $carts[$idSanPham]['gia'] - ($carts[$idSanPham]['sale'] * $carts[$idSanPham]['gia'] / 100),
            'tongTien' => $tongTien,
        ]);
    }

    public function TruCart(Request $request)
    {
        $idSanPham = $request->id_sanpham;
        $carts = session()->get('cart');

        if ($carts[$idSanPham]['soluong'] == 1) {
            $carts[$idSanPham]['soluong'] = $carts[$idSanPham]['soluong'];
        } else {
            $carts[$idSanPham]['soluong'] = $carts[$idSanPham]['soluong'] - 1;
            session()->put(['cart' => $carts]);
        }

        $tongTien = 0;
        foreach ($carts as $cart) {
            $tongTien = $tongTien + (($cart['gia'] - ($cart['gia'] * $cart['sale'] / 100)) * $cart['soluong']);
        }

        return response()->json([
            'soLuong' => $carts[$idSanPham]['soluong'],
            'gia' => $carts[$idSanPham]['gia'] - ($carts[$idSanPham]['sale'] * $carts[$idSanPham]['gia'] / 100),
            'tongTien' => $tongTien
        ]);
    }

    public function xoaCart(Request $request)
    {
        $carts = session()->get('cart');
        if (!empty($carts)) {
            $idSanPham = $request->id;
            unset($carts[$idSanPham]);
            session()->put(['cart' => $carts]);
            $count = session()->get('count');
            $count = $count - 1;
            session()->put('count', $count);

            return redirect()->route('shoppingCart');
        } else {

            session()->forget('count');

            return redirect()->route('trangchu');
        }
    }

    public function ThanhToan(Request $request)
    {
        if (session()->has('cart')) {
            $carts = session()->get('cart');
            $donhang = donhang::create([
                'nguoimua' => $request->nguoiNhan,
                'email' => $request->email,
                'ngaymua' => date('y/m/d'),
                'tongtien' => $request->tongTien,
                'trangthai' => $request->trangThai,
                'diachi' => $request->diaChi,
                'sodienthoai' => $request->phone,
            ]);

            $idDonHang = $donhang->id;
            foreach ($carts as $cart) {
                $tongSoLuong = size_tongsoluong::find($cart['id_size'])->tongsoluong;
                size_tongsoluong::find($cart['id_size'])->update([
                    'tongsoluong' => $tongSoLuong - $cart['soluong'],
                ]);
            }

            $tmp_tongsoluong = 0;
            foreach (session()->get('cart') as $cart) {
                $id = 'id_sanpham' . $cart['id_sanpham'];
                $soLuong = 'soluong' . $cart['id_sanpham'];
                $gia = 'gia' . $cart['id_sanpham'];
                $thanhTien = 'thanhtien' . $cart['id_sanpham'];

                $chitietdonhang = chitietdonhang::create([
                    'id_sanpham' => $request->$id,
                    'id_donhang' => $idDonHang,
                    'soluong' => $request->$soLuong,
                    'gia' => $request->$gia,
                    'thanhtien' => $request->$thanhTien,
                ]);
                $tmp_tongsoluong += $chitietdonhang->soluong;
            }

            session()->forget('cart');
            session()->forget('count');

            // thêm vào table thongkes
            $tmp = thongke::where('ngaymua', $donhang->ngaymua)->first();

            if (empty($tmp)) {
                thongke::create([
                    'ngaymua' => $donhang->ngaymua,
                    'tong_tien' => $donhang->tongtien,
                    'tong_soluong' => $tmp_tongsoluong,
                    'tong_donhang' => 1,
                ]);
            } else {
                $tmp->update([
                    'tong_tien' => $tmp->tong_tien + $donhang->tongtien,
                    'tong_soluong' => $tmp->tong_soluong + $tmp_tongsoluong,
                    'tong_donhang' => $tmp->tong_donhang + 1,
                ]);
            }

            $ThuongHieus = thuonghieu::all();
            foreach ($ThuongHieus as $ThuongHieu) {
                $SanPhams[$ThuongHieu->id] = thuonghieu::find($ThuongHieu->id)->sanpham;
            }

            $ChungLoais = chungloai::all();
            foreach ($ChungLoais as $ChungLoai) {
                $sanphams[$ChungLoai->id] = chungloai::find($ChungLoai->id)->sanpham;
            }
        }

        return view('trangchu.thanhtoan', [
            'donhang' => $donhang,
            'SanPhams' => $SanPhams,
            'sanphams' => $sanphams,
        ]);
    }

    public function show($sanpham)
    {
        $ThuongHieus = thuonghieu::all();
        foreach ($ThuongHieus as $ThuongHieu) {
            $SanPhams[$ThuongHieu->id] = thuonghieu::find($ThuongHieu->id)->sanpham;
        }

        $ChungLoais = chungloai::all();
        foreach ($ChungLoais as $ChungLoai) {
            $sanphams[$ChungLoai->id] = chungloai::find($ChungLoai->id)->sanpham;
        }

        $sp = sanpham::find($sanpham);
        $dataSanPhamAll = sanpham::all();

        $tags = explode(',', $sp->tag);

        return view('trangchu.show', [
            'ThuongHieus' => $ThuongHieus,
            'SanPhams' => $SanPhams,
            'ChungLoais' => $ChungLoais,
            'sanphams' => $sanphams,
            'sanpham' => $sp,
            'dataSanPhamAll' => $dataSanPhamAll,
            'tags' => $tags,
        ]);
    }

    public function autocomplete(Request $request)
    {
        if ($request->has('key')) {
            $sanphams = DB::table('sanphams')
                ->select('sanphams.*')
                ->whereRaw("MATCH (sanphams.ten,sanphams.tag) AGAINST ('$request->key')") 
                ->get();

            $output = '
                <ul class="dropdown-menu" style="display:block; position:relative; width:100%;">
            ';

            foreach ($sanphams as $sanpham) {
                $output .= '
                    <li class="row">
                        <a href="' . route('trangchu', ['TimKiem' => $sanpham->ten]) . '" class="show_sanpham">' . $sanpham->ten . '</a>
                    </li>
                ';
            }

            $output .= '
                </ul>
            ';

            echo $output;
        }
    }

    public function danhgia(Request $request)
    {
        if (Auth::check()) {
            $danhgia = danhgia::create([
                'id_sanpham' => $request->id_sanpham,
                'id_user' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'noidung' => $request->noidung,
                'sao' => $request->sao,
            ]);
        } else {
            $danhgia = danhgia::create([
                'id_sanpham' => $request->id_sanpham,
                'name' => $request->name,
                'email' => $request->email,
                'noidung' => $request->noidung,
                'sao' => $request->sao,
            ]);
        }
        if ($request->hasFile('images_danhgia')) {
            foreach ($request->file('images_danhgia') as $file) {
                $tenFile = $danhgia->id . Str::random(6) . "_" . $file->getClientOriginalName();

                Storage::putFileAs('public/admin/images/danhgia/', $file, $tenFile);
                FileImage::create([
                    'ten_file' => $tenFile,
                    'duongdan' => '/storage/admin/images/danhgia/' . $tenFile,
                    'imageable_id' => $danhgia->id,
                    'imageable_type' => danhgia::class,
                ]);
            }
        }
        $output = '';
        $output .= '
            <div class="col-sm-12 mt-5">
            ';
        if (empty($danhgia->user->image)) {
            $output .= '
                <img style="width: 50px; height: 50px;" src="/images/user/download (3).jpg" alt="">
            ';
        } else {
            $output .= '
                <img style="width: 50px; height: 50px;" src="' . $danhgia->user->image->duongdan . '" alt="">
        ';
        }

        $output .= '
        <b>' . $danhgia->name . '</b>  <i class="fa fa-clock-o"></i>' . $danhgia->created_at . ' 
                <span><b> - ' . $danhgia->sao . '</b> Sao</span>
            </div>
            <div class="tab-pane fade active in row">
                <div class="col-sm-12">
                    <p>' . $danhgia->noidung . '</p>
                </div>
        ';
        if (!empty($danhgia->user->image)) {
            foreach ($danhgia->images as $image) {
                $output .= '
                <div class="col-sm-3">
                    <img  src="' . $image->duongdan . '" style="width: 200px; height:200px;" alt="Chưa có ảnh">
                </div>
                ';
            }
        }

        $output .= '  
            </div>
        ';

        echo $output;
    }

    //ajax sắp xếp trang chủ
    public function sapxep(Request $request)
    {
        $output = '';
        if ($request->sapxep == 'desc') {
            $dataSanPham = sanpham::orderBy('gia', 'desc')->paginate(18)->appends($request->query());
        } else if ($request->sapxep == 'asc') {
            $dataSanPham = sanpham::orderBy('gia', 'asc')->paginate(18)->appends($request->query());
        } else if ($request->sapxep == 'hot') {
            $dataSanPham = sanpham::where('isHot', 1)->orderBy('ten', 'asc')->paginate(18)->appends($request->query());
        } else if ($request->sapxep == 'new') {
            $dataSanPham = sanpham::where('isNew', 1)->orderBy('ten', 'asc')->paginate(18)->appends($request->query());
        }

        $output .= '
            <h2 class="title text-center">Tất cả sản phẩm</h2>
        ';
        foreach ($dataSanPham as $data) {
            $output .= '
            <div class="product-image-wrapper col-sm-4" style="height:400px;">
                <div class="single-products">
                    <div class="productinfo text-justify">
                        <a href="' . route('sanphamshow', $data->id) . '">
                            <img src="' . $data->images->first()->duongdan . '" alt="Chưa có ảnh"
                                style="height:300px; position: relative;" />
                        </a>
        ';

            if (isset($data->giamgia)) {
                $output .= '
                <span style="position: absolute; right:60px; background: black" class="badge badge-warning">
                Mua ' . $data->giamgia->tong_soluong . ' Giảm ' . $data->giamgia->giagiam . ' đ</span>
            ';
            }

            if ($data->isHot == 1) {
                $output .= '
                <span style="position: absolute;right:0; background: red" class="badge badge-warning">HOT</span>
            ';
            }

            if ($data->isNew == 1) {
                $output .= '
                <span style="position: absolute;right:0; background: green" class="badge badge-warning">NEW</span>
            ';
            }

            if ($data->sale > 0) {
                $output .= '
                <span style="position: absolute;left:0; background: black" class="badge badge-warning">' . $data->sale . ' %</span> 
            ';
            }

            $output .= '
            <a href="' . route('sanphamshow', $data->id) . '">
                <p style="font-size: 14px;">
                    <b>' . $data->ten . '</b>
                </p>
            </a>
            <div>
        ';

            if ($data->sale > 0) {
                $output .= '
                <h6 class="col-sm-14" style="font-size: 16px">
                    <b class="col-sm-6">
                        $ ' . $data->gia * (100 - $data->sale) / 100 . '
                    </b>
                    <del class="col-sm-6"> $ ' . $data->gia . '</del>
                </h6>
            ';
            } else {
                $output .= '
                <h6 class="col-sm-6" style="font-size: 16px">
                    <b> $ ' . $data->gia . ' </b>
                </h6>
            ';
            }

            $output .= '
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        $output .= '
            <div>
                ' . $dataSanPham->links() . '
            </div>
        </div>
        ';

        echo $output;
    }
}
