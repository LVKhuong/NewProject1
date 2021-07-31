<?php

namespace App\Exports;

use App\Models\sanpham;
use Maatwebsite\Excel\Concerns\FromCollection;

class sanphamExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return sanpham::all();
    }
}
