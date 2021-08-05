<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FileImage;

use Illuminate\Http\Request;
use App\Http\Requests\CreateNguoidungRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NguoidungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.nguoidung.xem', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nguoidung.nhap');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNguoidungRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $nguoidung = User::create($data);

        $image = $data['fileImage'];
        if (isset($image)) {
            $tenFile = $nguoidung->id . "_" . Str::random(6) . "_" . $image->getClientOriginalName();

            Storage::putFileAs('public/admin/images/nguoidung/', $image, $tenFile);

            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/nguoidung/' . $tenFile,
                'imageable_id' => $nguoidung->id,
                'imageable_type' => User::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã thêm tài khoản mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $nguoidung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $nguoidung)
    {

        return view('admin.nguoidung.nhapsua', [
            'data' => $nguoidung,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $nguoidung)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $nguoidung->update($data);

        if (isset($data['fileImage'])) {
            if ($nguoidung->image) {
                Storage::delete('public/admin/images/nguoidung/' . $nguoidung->image->ten_file);
                $nguoidung->image->delete();
            }

            $tenFile = $nguoidung->id . "_" . Str::random(6) . "_" . $data['fileImage']->getClientOriginalName();
            Storage::putFileAs('public/admin/images/nguoidung/', $data['fileImage'], $tenFile);

            FileImage::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/nguoidung/' . $tenFile,
                'imageable_id' => $nguoidung->id,
                'imageable_type' => User::class,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập tài khoản thành công');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $nguoidung)
    {
        $nguoidung->delete();

        return redirect()->back()->with('thongbao', 'Bạn đã xoá thành công');
    }
}
