<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\chungloai;
use App\Models\thuonghieu;

use App\Http\Requests\CreateChungLoaiRequest;
use App\Http\Requests\UpdateChungloaiRequest;

use Illuminate\Http\Request;


class ChungloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!isset($request->keySearch)) {
            $data = chungloai::orderBy('created_at', 'desc')->paginate(5);
        }
        if (isset($request->keySearch)) {
            $data = chungloai::where('ten', 'like', '%' . $request->keySearch . '%')->paginate(5);
            $data->appends($request->all());
        }

        return view('admin.chungloai.xem', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chungloai.nhap');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateChungLoaiRequest $request)
    {
        $data = new chungloai;
        $data->ten = $request->ten;
        $data->save();

        return redirect()->route('chungloai.create')->with('thongbao', 'Bạn đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chungloai  $chungloai
     * @return \Illuminate\Http\Response
     */
    public function show(chungloai $chungloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chungloai  $chungloai
     * @return \Illuminate\Http\Response
     */
    public function edit(chungloai $chungloai)
    {
        $ThuongHieu = thuonghieu::all();
        $ChungLoai = chungloai::all();

        return view('admin.chungloai.nhapsua', [
            'data' => $chungloai,
            'thuonghieu' => $ThuongHieu,
            'chungloai' => $ChungLoai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chungloai  $chungloai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChungloaiRequest $request, chungloai $chungloai)
    {
        $chungloai->update($request->only('ten'));

        return redirect()->route('chungloai.edit', $chungloai->id)->with('thongbao', 'Bạn đã cập nhập thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chungloai  $chungloai
     * @return \Illuminate\Http\Response
     */
    public function destroy(chungloai $chungloai)
    {
        $chungloai->delete();

        return redirect()->route('chungloai.index')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
