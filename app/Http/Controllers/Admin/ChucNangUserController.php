<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChucNangUser;
use App\Models\User;
use App\Http\Requests\CreateRoleRequest;
use App\Models\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        $users = User::paginate(10);

        return view('admin.chucnang.nhap', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        foreach ($request->ten_route as $tenRoute) {
            ChucNangUser::create([
                'tenroute' => $tenRoute,
                'id_user' => $request->user,
            ]);
        }

        $data = $request->role;
        $role = explode(',', $data);
            role::create([
                'role' => $role[0],
                'ten_role' => $role[1],
                'id_user' => $request->user,
            ]);


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

        return view('admin.chucnang.nhapsua', [
            'user' => $idnguoidung,
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
        $idnguoidung->role->delete();

        foreach ($request->ten_route as $route) {
            ChucNangUser::create([
                'id_user' => $request->user,
                'tenroute' => $route,
            ]);
        }
        
        $data = $request->role;
        $role = explode(',', $data);
        role::create([
            'role' => $role[0],
            'ten_role' => $role[1],
            'id_user' => $request->user,
        ]);

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
