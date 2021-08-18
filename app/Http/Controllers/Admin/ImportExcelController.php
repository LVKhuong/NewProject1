<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Excel;
use App\Imports\sanphamImportExcel;
use Illuminate\Support\Facades\Storage;

class ImportExcelController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('excel');
        $tenFile = $file->getClientOriginalName();

        Storage::putFileAs('/public/admin/excel', $file, date('d-m-y') .'_'. $tenFile);

        Excel::import(new sanphamImportExcel, $file);

        return redirect()->back()->with('thongbao', 'Bạn đã import thành công ');
    }
}
