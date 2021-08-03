<?php

namespace App\Http\Controllers;

use App\Models\chitietdonhang;
use App\Models\donhang;
use Illuminate\Http\Request;


class ChitietdonhangController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
      $data = chitietdonhang::paginate(10);

      return view('admin.chitietdonhang.xem', [
         'data' => $data,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\chitietdonhang  $chitietdonhang
    * @return \Illuminate\Http\Response
    */
   public function show(chitietdonhang $chitietdonhang)
   {
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\chitietdonhang  $chitietdonhang
    * @return \Illuminate\Http\Response
    */
   public function edit(chitietdonhang $chitietdonhang)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\chitietdonhang  $chitietdonhang
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, chitietdonhang $chitietdonhang)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\chitietdonhang  $chitietdonhang
    * @return \Illuminate\Http\Response
    */
   public function destroy(chitietdonhang $chitietdonhang)
   {
      $chitietdonhang->delete();

      return redirect()->back();
   }
}
