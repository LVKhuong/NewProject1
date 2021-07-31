<?php

namespace App\Imports;

use App\Models\sanpham;
use Maatwebsite\Excel\Concerns\ToModel;

class sanphamImportExcel implements ToModel
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    return new sanpham([
      'ten' => $row[0],
      'gia' => $row[1],
      'gioithieu' => $row[2],
      'id_chungloai' => $row[3],
      'id_thuonghieu' => $row[4],
      'isHot' => $row[5],
      'isNew' => $row[6],
      'sale' => $row[7],
    ]);
  }
}
