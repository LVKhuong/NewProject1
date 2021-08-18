<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mausac;
use App\Models\sanpham;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\FileImage;
use Illuminate\Http\Request;

class MausacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mausacs = mausac::paginate(10);

        return view('admin.mausac.xem', [
            'mausacs' => $mausacs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(sanpham $sanpham)
    {
        
        return view('admin.mausac.nhap', [
            'sanpham' => $sanpham,
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
        $data = $request->except('_tolen');

        $mausac = mausac::create([
            'id_sanpham' => $data['id_sanpham'],
            'ten' => $data['ten'],
        ]);

        if($request->has('file_mausac')){
            $tenFile = $mausac->id . "_" . Str::random(6) . "_" . $request->file('file_mausac')->getClientOriginalName();
            Storage::putFileAs('public/admin/images/mausac/', $request->file('file_mausac'), $tenFile);
            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/mausac/' . $tenFile,
                'imageable_id' => $mausac->id,
                'imageable_type' => mausac::class,
            ]);
        }

        return redirect()->route('mausac.index')->with('thongbao', 'Bạn đã thêm mới màu sắc thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mausac  $mausac
     * @return \Illuminate\Http\Response
     */
    public function show(mausac $mausac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mausac  $mausac
     * @return \Illuminate\Http\Response
     */
    public function edit(mausac $mausac)
    {
        
        return view('admin.mausac.nhapsua', [
            'mausac' => $mausac,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mausac  $mausac
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mausac $mausac)
    {
        $data = $request->except('_token');

        $mausac->update($data);

        if($request->has('file_mausac')){
            Storage::delete('public/admin/images/mausac/' . $mausac->image->ten_file);
            $mausac->image->delete();

            $tenFile = $mausac->id . "_" . Str::random(6) . "_" . $request->file('file_mausac')->getClientOriginalName();
            Storage::putFileAs('public/admin/images/mausac/', $request->file('file_mausac'), $tenFile);
            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/mausac/' . $tenFile,
                'imageable_id' => $mausac->id,
                'imageable_type' => mausac::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập màu sắc thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mausac  $mausac
     * @return \Illuminate\Http\Response
     */
    public function destroy(mausac $mausac)
    {
        $mausac->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xóa màu sắc thành công');
    }
}
