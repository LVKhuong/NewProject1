<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giamgia extends Model
{
    use HasFactory;

    protected $table = 'giamgias';

    protected $fillable = [
        'id_sanpham',
        'tong_soluong',
        'giagiam',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    
}
