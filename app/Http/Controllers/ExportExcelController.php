<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\sanphamExport;

use Excel;

class ExportExcelController extends Controller
{
   public function xuatsanpham()
   {

      return Excel::download(new sanphamExport, 'allsanpham.xlsx');
   }
}
