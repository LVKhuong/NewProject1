<?php

namespace App\Http\Controllers;

use App\Models\giamgia;
use App\Models\sanpham;

use Illuminate\Http\Request;

class GiamgiaController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $giamGias = giamgia::paginate(10);

      return view('admin.giamgia.xem', [
         'giamGias' => $giamGias,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $sanphams = sanpham::all();

      return view('admin.giamgia.nhap', [
         'sanphams' => $sanphams,
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $data = $request->except('_token');
      giamgia::create($data);

      return redirect()->back()->with('thongbao', 'Bạn đã thêm giảm giá thành công');
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\giamgia  $giamgia
    * @return \Illuminate\Http\Response
    */
   public function show(giamgia $giamgia)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\giamgia  $giamgia
    * @return \Illuminate\Http\Response
    */
   public function edit(giamgia $idgiamgia)
   {
      $sanPham = $idgiamgia->sanpham;

      return view('admin.giamgia.nhapsua', [
         'giamGia' => $idgiamgia,
         'sanPham' => $sanPham,
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\giamgia  $giamgia
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, giamgia $idgiamgia)
   {
      $data = $request->except('_token');

      $idgiamgia->update($data);

      return redirect()->back()->with('thongbao', 'Bạn đã cập nhập thành công');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\giamgia  $giamgia
    * @return \Illuminate\Http\Response
    */
   public function destroy(giamgia $idgiamgia)
   {
      $idgiamgia->delete();

      return redirect()->back()->with('thongbao', 'Bạn đã xóa thành công ');
   }
}
