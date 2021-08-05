<?php

namespace App\Http\Controllers;

use App\Models\traloi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TraloiController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $binhluan)
    {
        if (Auth::check()) {
            traloi::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'noidung' => $request->noidungTraloi,
                'id_binhluan' => $binhluan,
                'id_user' => Auth::id(),
            ]);
        } else {
            traloi::create([
                'name' => $request->nameTraloi,
                'email' => $request->emailTraloi,
                'noidung' => $request->noidungTraloi,
                'id_binhluan' => $binhluan,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\traloi  $traloi
     * @return \Illuminate\Http\Response
     */
    public function show(traloi $traloi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\traloi  $traloi
     * @return \Illuminate\Http\Response
     */
    public function edit(traloi $traloi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\traloi  $traloi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, traloi $traloi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\traloi  $traloi
     * @return \Illuminate\Http\Response
     */
    public function destroy(traloi $traloi)
    {
        //
    }
}
