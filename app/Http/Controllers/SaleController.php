<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\sanpham;

class SaleController extends Controller
{
    public function index()
    {
        $sanphams = sanpham::all();

        return view('admin.sanpham.sale', [
            'sanphams' => $sanphams,
        ]);
    }

    public function sell(Request $request)
    {
        if ($request->has('so_sale')) {
            foreach ($request->id_sanpham as $idsanpham) {
                sanpham::find($idsanpham)->update([
                    'sale' => $request->so_sale,
                ]);
            }
        }

        return redirect()->back()->with('thongbao', 'Bạn đã thêm ' . count($request->id_sanpham) . ' sản phẩm thành công');
    }
}
