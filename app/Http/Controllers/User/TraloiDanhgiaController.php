<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\danhgia;
use App\Models\traloi_danhgia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraloiDanhgiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhgias = danhgia::paginate(10);
        
        return view('admin.traloidanhgia.xem', [
            'danhgias' => $danhgias,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(danhgia $id_danhgia)
    {
        
        return view('admin.traloidanhgia.nhap', [
            'danhgia' => $id_danhgia,
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

        traloi_danhgia::create([
            'id_user' => Auth::user()->id,
            'id_danhgia' => $data['id_danhgia'],
            'noidung' => $data['noidung'],
        ]);


        return redirect()->back()->with('thongbao', 'Bạn đã thêm trả lời bình luận thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\traloi_danhgia  $traloi_danhgia
     * @return \Illuminate\Http\Response
     */
    public function show(danhgia $danhgia)
    {
        $tralois = $danhgia->tralois()->paginate(10);
        
        return view('admin.traloidanhgia.show', [
            'tralois' => $tralois,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\traloi_danhgia  $traloi_danhgia
     * @return \Illuminate\Http\Response
     */
    public function edit(traloi_danhgia $traloi_danhgia)
    {
        
        return view('admin.traloidanhgia.nhapsua', [
            'traloi' => $traloi_danhgia,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\traloi_danhgia  $traloi_danhgia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, traloi_danhgia $traloi_danhgia)
    {
        $data = $request->except('_token');

        $traloi_danhgia->update($data);

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập trả lời thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\traloi_danhgia  $traloi_danhgia
     * @return \Illuminate\Http\Response
     */
    public function destroy(traloi_danhgia $traloi_danhgia)
    {
        $traloi_danhgia->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xóa trả lời thành công');
    }
}
