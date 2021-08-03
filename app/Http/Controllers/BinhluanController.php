<?php

namespace App\Http\Controllers;

use App\Models\binhluan;
use App\Models\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sanpham)
    {
        if(Auth::check()){
            binhluan::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'noidung' => $request->noidung,
                'id_sanpham' => $sanpham,
                'id_user' => Auth::id(),
            ]);
        }else{
            binhluan::create([
                'name' => $request->name,
                'email' => $request->email,
                'noidung' => $request->noidung,
                'id_sanpham' => $sanpham,
            ]);
        }

        return redirect()->route('sanphamshow', $sanpham);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\binhluan  $binhluan
     * @return \Illuminate\Http\Response
     */
    public function show(binhluan $binhluan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\binhluan  $binhluan
     * @return \Illuminate\Http\Response
     */
    public function edit(binhluan $binhluan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\binhluan  $binhluan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, binhluan $binhluan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\binhluan  $binhluan
     * @return \Illuminate\Http\Response
     */
    public function destroy(binhluan $binhluan)
    {
        //
    }
}
