<?php

namespace App\Http\Controllers;

use App\Models\ChucNangUser;
use App\Models\User;

use App\Http\Requests\CreateChucNangRequest;
use App\Models\quanlimenu;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class ChucNangUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->has('keySearch')) {
            $data = User::paginate(10);
        }

        if ($request->has('keySearch')) {
            $data = User::where('email', 'like', '%' . $request->keySearch . '%')->paginate(10);
            $data->appends($request->all());
        }

        return view('admin.chucnang.xem', [
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
        $users = User::all();

        return view('admin.chucnang.nhap', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->role as $route) {
            ChucNangUser::create([
                'tenemail' => $request->email,
                'tenroute' => $route,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChucNangUser  $chucNangUser
     * @return \Illuminate\Http\Response
     */
    public function show(User $idnguoidung)
    {
        $chucNangs = $idnguoidung->chucnang;

        return view('admin.chucnang.show', [
            'chucNangs' => $chucNangs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChucNangUser  $chucNangUser
     * @return \Illuminate\Http\Response
     */
    public function edit(User $idnguoidung)
    {
        $chucNang = $idnguoidung->chucnang;

        return view('admin.chucnang.nhapsua', [
            'chucNang' => $chucNang,
            'users' => $idnguoidung,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChucNangUser  $chucNangUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $idnguoidung)
    {
        $ChucNangs = $idnguoidung->chucnang;

        foreach ($ChucNangs as $ChucNang) {
            ChucNangUser::find($ChucNang->id)->delete();
        }

        foreach ($request->role as $route) {
            ChucNangUser::create([
                'tenemail' => $request->email,
                'tenroute' => $route,
            ]);
        }

        return redirect()->back()->with('thongbao', 'Bạn đã cập nhập thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChucNangUser  $chucNangUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChucNangUser $idnguoidung)
    {
        $idnguoidung->delete();

        return redirect()->back()->with('thongbao', 'Bạn xoá đã thành công');
    }
}
