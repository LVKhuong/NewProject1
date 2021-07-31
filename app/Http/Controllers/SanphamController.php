<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\chungloai;
use App\Models\thuonghieu;
use App\Models\FileImage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSanPhamRequest;
use App\Http\Requests\UpdateSanphamRequest;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!isset($_GET['keySearch'])) {
            $data = sanpham::orderBy('created_at', 'desc')->paginate(5);
        }

        if (isset($_GET['keySearch'])) {
            $data = sanpham::where('ten', 'like', '%' . $request->keySearch . '%')->paginate(5);
            $data->appends($request->all());
        }

        if (isset($_GET['isNew'])) {
            $data = sanpham::where('isNew', 1)->paginate(5);
            $data->appends($request->all());
        }

        if (isset($_GET['isHot'])) {
            $data = sanpham::where('isHot', 1)->paginate(5);
            $data->appends($request->all());
        }

        if (isset($_GET['sale'])) {
            $data = sanpham::where('sale', '>', 0)->paginate(5);
            $data->appends($request->all());
        }

        return view('admin.sanpham.xem', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ChungLoai = chungloai::all();
        $ThuongHieu = thuonghieu::all();

        return view('admin.sanpham.nhap', ['chungloai' => $ChungLoai, 'thuonghieu' => $ThuongHieu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSanPhamRequest $request)
    {
        $data = $request->except('_token');
        $sanpham = sanpham::create($data);

        foreach ($request->file('fileImage') as $file) {
            $tenFile = $sanpham->id . "_" . Str::random(6) . "_" . $file->getClientOriginalName();
            Storage::putFileAs('public/admin/images/sanpham/', $file, $tenFile);
            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/sanpham/' . $tenFile,
                'imageable_id' => $sanpham->id,
                'imageable_type' => sanpham::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(sanpham $sanpham)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(sanpham $sanpham)
    {
        $ChungLoai = chungloai::all();
        $ThuongHieu = thuonghieu::all();
        return view('admin.sanpham.nhapsua', [
            'data' => $sanpham,
            'thuonghieu' => $ThuongHieu,
            'chungloai' => $ChungLoai,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSanphamRequest $request, sanpham $sanpham)
    {
        $data = $request->except('_token');

        if (!$request->has('isHot')) {
            $data['isHot'] = 0;
        }
        if (!$request->has('isNew')) {
            $data['isNew'] = 0;
        }
        $sanpham->update($data);

        if ($request->has('fileImage')) {
            foreach ($sanpham->images as $image) {
                Storage::delete('public/admin/images/sanpham/' . $image->ten_file);
                $image->delete();
            }

            foreach ($request->file('fileImage') as $file) {
                $tenFile = $sanpham->id . "_" . Str::random(6) . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public/admin/images/sanpham/', $file, $tenFile);

                FileImage::create([
                    'ten_file' => $tenFile,
                    'duongdan' => '/storage/admin/images/sanpham/' . $tenFile,
                    'imageable_id' => $sanpham->id,
                    'imageable_type' => sanpham::class,
                ]);
            }
        }
        return redirect()->back()->with('thongbao', "Bạn đã cập nhập thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(sanpham $sanpham)
    {
        $sanpham->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xóa sản phẩm thành công');
    }
}
