<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietdonhang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sanpham',
        'id_donhang',
        'soluong',
        'gia',
        'thanhtien',
    ];

    public function donhang()
    {
        return $this->belongsTo(donhang::class, 'id_donhang', 'id');
    }

    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    public function chungloai()
    {
        return $this->belongsToThrough(chungloai::class, sanpham::class, 'id_chungloai', 'id_sanpham', 'id');
    }

    public function thuonghieu()
    {
        return $this->belongsToThrough(thuonghieu::class, sanpham::class, 'id_thuonghieu', 'id_sanpham', 'id');
    }
}
