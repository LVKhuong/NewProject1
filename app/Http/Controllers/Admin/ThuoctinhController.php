<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateThuoctinhRequest;
use App\Models\FileImage;
use App\Models\sanpham;
use App\Models\thuoctinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ThuoctinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = thuoctinh::paginate(10);

        return view('admin.thuoctinh.xem', [
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
        $data = sanpham::paginate(10);

        return view('admin.thuoctinh.nhap', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThuoctinhRequest $request)
    {
        if ($request->has('id_sanpham')) {
            foreach ($request->id_sanpham as $item) {
                foreach ($request->size as $value) {
                    $thuoctinh = thuoctinh::create([
                        'mausac' => $request->mausac,
                        'size' => $value,
                        'soluong' => $request->soluong,
                        'id_sanpham' => $item,
                    ]);

                    if ($request->hasFile('file_mausac')) {
                        $tenFile = $thuoctinh->id . "_" . Str::random(6) . "_" . $request->file('file_mausac')->getClientOriginalName();

                        Storage::putFileAs('public/admin/images/mausac/', $request->file('file_mausac'), $tenFile);

                        FileImage::create([
                            'ten_file' => $tenFile,
                            'duongdan' => '/storage/admin/images/mausac/' . $tenFile,
                            'imageable_id' => $thuoctinh->id,
                            'imageable_type' => thuoctinh::class,
                        ]);
                    }
                }
            }
        }



        return redirect()->back()->with('thongbao', 'Bạn đã thêm thuộc tính thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\thuoctinh  $thuoctinh
     * @return \Illuminate\Http\Response
     */
    public function show(thuoctinh $thuoctinh)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\thuoctinh  $thuoctinh
     * @return \Illuminate\Http\Response
     */
    public function edit(thuoctinh $thuoctinh)
    {
        $data = sanpham::paginate(10);

        return view('admin.thuoctinh.nhapsua', [
            'data' => $data,
            'thuoctinh' => $thuoctinh,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\thuoctinh  $thuoctinh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, thuoctinh $thuoctinh)
    {

        $thuoctinh->update([
            'mausac' => $request->mausac,
            'size' => $request->size,
            'soluong' => $request->soluong,
        ]);


        if ($request->hasFile('file_mausac')) {
            Storage::delete('public/admin/images/mausac/' . $thuoctinh->image->ten_file);
            $thuoctinh->image->delete();


            $tenFile = $thuoctinh->id . "_" . Str::random(6) . "_" . $request->file('file_mausac')->getClientOriginalName();
            Storage::putFileAs('public/admin/images/mausac/', $request->file('file_mausac'), $tenFile);
            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/mausac/' . $tenFile,
                'imageable_id' => $thuoctinh->id,
                'imageable_type' => thuoctinh::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\thuoctinh  $thuoctinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(thuoctinh $thuoctinh)
    {
        $thuoctinh->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xóa thành công');
    }
}
