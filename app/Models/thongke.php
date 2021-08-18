<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongke extends Model
{
    use HasFactory;

    protected $table = 'thongkes';

    protected $fillable = [
        'ngaymua',
        'tong_tien',
        'tong_soluong',
        'tong_donhang',
    ];
}
