<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mausac;
use App\Models\size_tongsoluong;
use Illuminate\Http\Request;

class SizeTongsoluongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size_tongsoluongs = size_tongsoluong::paginate(10);

        return view('admin.size_tongsoluong.xem', [
            'size_tongsoluongs' => $size_tongsoluongs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(mausac $mausac)
    {
        
        return view('admin.size_tongsoluong.nhap', [
            'mausac' => $mausac,
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

        size_tongsoluong::create($data);

        return redirect()->back()->with('thongbao', 'Bạn đã thêm mới size theo số lượng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\size_tongsoluong  $size_tongsoluong
     * @return \Illuminate\Http\Response
     */
    public function show(size_tongsoluong $size_tongsoluong)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\size_tongsoluong  $size_tongsoluong
     * @return \Illuminate\Http\Response
     */
    public function edit(size_tongsoluong $size_tongsoluong)
    {
        
        return view('admin.size_tongsoluong.nhapsua', [
            'size_tongsoluong' => $size_tongsoluong,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\size_tongsoluong  $size_tongsoluong
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, size_tongsoluong $size_tongsoluong)
    {
        $data = $request->except('_token');

        $size_tongsoluong->update($data);

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập size và tổng số lượng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\size_tongsoluong  $size_tongsoluong
     * @return \Illuminate\Http\Response
     */
    public function destroy(size_tongsoluong $size_tongsoluong)
    {
        $size_tongsoluong->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xóa size và tổng số lượng thành công');
    }
}
