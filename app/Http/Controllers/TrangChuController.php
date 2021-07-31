<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;

use App\Models\sanpham;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\thuonghieu;
use App\Models\chungloai;
use App\Models\FileImage;
use App\Models\giamgia;

class TrangChuController extends Controller
{
    public function index()
    {
        $ThuongHieus = thuonghieu::all();

        foreach ($ThuongHieus as $ThuongHieu) {
            $SanPhams[$ThuongHieu->id] = thuonghieu::find($ThuongHieu->id)->sanpham;
        }

        $ChungLoais = chungloai::all();

        foreach ($ChungLoais as $ChungLoai) {
            $sanphams[$ChungLoai->id] = chungloai::find($ChungLoai->id)->sanpham;
        }

        $dataSanPham = sanpham::paginate(6);

        foreach ($dataSanPham as $data) {
            $FileImages = sanpham::find($data->id)->images;
        }

        $count = session()->get('count');

        return view('trangchu.trangchu', [
            'ThuongHieus' => $ThuongHieus,
            'SanPhams' => $SanPhams,
            'ChungLoais' => $ChungLoais,
            'sanphams' => $sanphams,
            'dataSanPham' => $dataSanPham,
            'FileImages' => $FileImages,
            'count' => $count,
        ]);
    }

    public function addToCart(Request $request)
    {
        $SanPham = sanpham::find($request->idsanpham);
        $Cart = session()->has('cart') ? session()->get('cart') : [];

        if (array_key_exists($SanPham->id, $Cart)) {
            $Cart[$SanPham->id]['soluong'] = $Cart[$SanPham->id]['soluong'] + 1;
            $count = count($Cart);

            session()->put(['cart' => $Cart, 'count' => $count]);
        } else {
            $Cart[$SanPham->id] = [
                'ten' => $SanPham->ten,
                'gia' => $SanPham->gia,
                'soluong' => 1,
                'sale' => $SanPham->sale,
                'id_sanpham' => $SanPham->id,
            ];
            $count = count($Cart);
            session()->put([
                'cart' => $Cart,
                'count' => $count
            ]);
        }

        $giamgia = $SanPham->giamgia;

        if (isset($giamgia->tong_soluong) && $Cart[$SanPham->id]['soluong'] >= $giamgia->tong_soluong) {
            $Cart[$SanPham->id]['gia'] = $giamgia->giagiam;

            session()->put([
                'cart' => $Cart,
            ]);
        }

        return response()->json(['cart' => session()->get('cart'), 'count' => count($Cart)]);
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
            }

            $dataSanPham = sanpham::all();


            return view('trangchu.shoppingcart', [
                'count' => $count,
                'ThuongHieus' => $ThuongHieus,
                'SanPhams' => $SanPhams,
                'ChungLoais' => $ChungLoais,
                'sanphams' => $sanphams,
                'carts' => $carts,
                'images' => $images,
                'tongTien' => $tongTien,
                'dataSanPham' => $dataSanPham,
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
        if (isset($carts)) {
            $idSanPham = $request->id;
            unset($carts[$idSanPham]);
            session()->put(['cart' => $carts]);

            return redirect()->route('shoppingCart');
        } else {
            return redirect()->route('trangchu');
        }
    }

    public function ThanhToan(Request $request)
    {
        if (session()->has('cart')) {
            $donhang = donhang::create([
                'nguoimua' => $request->nguoiNhan,
                'email' => $request->email,
                'ngaymua' => date('y/m/d'),
                'tongtien' => $request->tongTien,
                'trangthai' => $request->trangThai,
            ]);

            $idDonHang = $donhang->id;

            foreach (session()->get('cart') as $cart) {
                $id = 'id_sanpham' . $cart['id_sanpham'];
                $soLuong = 'soluong' . $cart['id_sanpham'];
                $gia = 'gia' . $cart['id_sanpham'];
                $thanhTien = 'thanhtien' . $cart['id_sanpham'];

                chitietdonhang::create([
                    'id_sanpham' => $request->$id,
                    'id_donhang' => $idDonHang,
                    'soluong' => $request->$soLuong,
                    'gia' => $request->$gia,
                    'thanhtien' => $request->$thanhTien,
                ]);
            }

            session()->forget('cart');
            session()->forget('count');
        }

        return redirect()->route('trangchu');
    }
}
