<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\sanpham;
use Excel;
use App\Imports\sanphamImportExcel;

class ImportExcelController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('excel')->store('import_excel');

        Excel::import(new sanphamImportExcel, $file);

        return redirect()->back()->with('thongbao', 'Bạn đã import thành công ');
    }
}
