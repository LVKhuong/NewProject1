<?php

namespace App\Http\Controllers;

use App\Models\ChucNangUser;
use App\Models\User;

use App\Http\Requests\CreateChucNangRequest;
use Illuminate\Http\Request;

use Auth;

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
    public function store(CreateChucNangRequest $request)
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
    public function show($chucNangUser)
    {
        $chucNangs = User::find($chucNangUser)->chucnang;

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
    public function edit($chucNangUser)
    {
        $user = User::find($chucNangUser);
        $chucNang = $user->chucnang;
        $users = User::all();

        return view('admin.chucnang.nhapsua', [
            'user' => $user,
            'chucNang' => $chucNang,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChucNangUser  $chucNangUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chucNangUser)
    {
        $user = User::find($chucNangUser);
        $ChucNangs = $user->chucnang;

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
    public function destroy($chucNangUser)
    {
        ChucNangUser::find($chucNangUser)->delete();

        return redirect()->back()->with('thongbao', 'Bạn xoá đã thành công');
    }
}
