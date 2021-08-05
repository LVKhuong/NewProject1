<?php

namespace App\Http\Controllers;

use App\Models\thuonghieu;
use App\Models\FileImage;

use App\Http\Requests\CreateThuongHieuRequest;
use App\Http\Requests\UpdateThuonghieuRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use Illuminate\Http\Request;

class ThuonghieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!isset($request->keySearch)) {
            $data = thuonghieu::orderBy('created_at', 'DESC')->paginate(5);
        }

        if (isset($request->keySearch)) {
            $data = thuonghieu::where('ten', 'like', '%' . $request->keySearch . '%')->paginate(5);
            $data->appends($request->all());
        }

        return view('admin.thuonghieu.xem', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.thuonghieu.nhap');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThuongHieuRequest $request)
    {
        $thuonghieu = thuonghieu::create([
            'ten' => $request->ten,
            'gioithieu' => $request->gioithieu,
        ]);

        if ($request->hasFile('fileImage')) {
            $tenFile = $thuonghieu->id . "_" . Str::random(6) . "_" . $request->file('fileImage')->getClientOriginalName();

            Storage::putFileAs('public/admin/images/thuonghieu/', $request->file('fileImage'), $tenFile);

            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/thuonghieu/' . $tenFile,
                'imageable_id' => $thuonghieu->id,
                'imageable_type' => thuonghieu::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã thêm mới thành công !');
    }

    /**
     * Display the specified resource. 
     *
     * @param  \App\Models\thuonghieu  $thuonghieu
     * @return \Illuminate\Http\Response
     */
    public function show(thuonghieu $thuonghieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\thuonghieu  $thuonghieu
     * @return \Illuminate\Http\Response
     */
    public function edit(thuonghieu $thuonghieu)
    {
        return view('admin.thuonghieu.nhapsua', ['dataTH' => $thuonghieu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\thuonghieu  $thuonghieu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThuonghieuRequest $request, thuonghieu $thuonghieu)
    {
        $thuonghieu->update([
            'ten' => $request->ten,
            'gioithieu' => $request->gioithieu,
        ]);

        if ($request->hasFile('fileImage')) {
            Storage::delete('public/admin/images/thuonghieu/' . $thuonghieu->image->ten_file);
            $thuonghieu->image->delete();

            $tenFile = $thuonghieu->id . "_" . Str::random(6) . "_" . $request->file('fileImage')->getClientOriginalName();
            Storage::putFileAs('public/admin/images/thuonghieu/', $request->file('fileImage'), $tenFile);

            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/thuonghieu/' . $tenFile,
                'imageable_id' => $thuonghieu->id,
                'imageable_type' => thuonghieu::class,
            ]);
        }

        return redirect()->back()->with('thongbao', "Bạn đã cập nhập thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\thuonghieu  $thuonghieu
     * @return \Illuminate\Http\Response
     */
    public function destroy(thuonghieu $thuonghieu)
    {
        $thuonghieu->delete();

        return redirect()->route('thuonghieu.index')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
