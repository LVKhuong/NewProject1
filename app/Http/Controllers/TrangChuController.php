<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\sanpham;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\thuonghieu;
use App\Models\chungloai;
use App\Models\FileImage;
use App\Models\User;

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
         $dataSanPham = sanpham::where('id_thuonghieu', $request->input('thuonghieu'))->paginate(6);
         $dataSanPham->appends($request->all());
      } elseif ($request->has('chungloai')) {
         $dataSanPham = sanpham::where('id_chungloai', $request->input('chungloai'))->paginate(6);
         $dataSanPham->appends($request->all());
      } else if ($request->has('SapXep')) {
         if ($request->input('SapXep') == 'new') {
            $dataSanPham = sanpham::where('isNew', 1)->paginate(6);
            $dataSanPham->appends($request->all());
         } else if ($request->input('SapXep') == 'hot') {
            $dataSanPham = sanpham::where('isHot', 1)->paginate(6);
            $dataSanPham->appends($request->all());
         } else {
            $dataSanPham = sanpham::orderBy('gia', $request->input('SapXep'))->paginate(6);
            $dataSanPham->appends($request->all());
         }
      } else if ($request->has('TimKiem')) {
         $dataSanPham = sanpham::where('ten', 'like', '%' . $request->input('TimKiem') . '%')->paginate(6);
         $dataSanPham->appends($request->all());
      } else {
         $dataSanPham = sanpham::paginate(6);
      }

      $count = session()->get('count');

      return view('trangchu.trangchu', [
         'ThuongHieus'   => $ThuongHieus,
         'SanPhams'      => $SanPhams,
         'ChungLoais'    => $ChungLoais,
         'sanphams'      => $sanphams,
         'dataSanPham'   => $dataSanPham,
         'count'         => $count,
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
            'ten'           => $SanPham->ten,
            'gia'           => $SanPham->gia,
            'soluong'       => 1,
            'sale'          => $SanPham->sale,
            'id_sanpham'    => $SanPham->id,
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
            'count'         => $count,
            'ThuongHieus'   => $ThuongHieus,
            'SanPhams'      => $SanPhams,
            'ChungLoais'    => $ChungLoais,
            'sanphams'      => $sanphams,
            'carts'         => $carts,
            'images'        => $images,
            'tongTien'      => $tongTien,
            'dataSanPham'   => $dataSanPham,
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


      return view('trangchu.show', [
         'ThuongHieus' => $ThuongHieus,
         'SanPhams' => $SanPhams,
         'ChungLoais' => $ChungLoais,
         'sanphams' => $sanphams,
         'sanpham' => $sp,
      ]);
   }
}
