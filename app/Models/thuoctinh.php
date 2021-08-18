<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuoctinh extends Model
{
    use HasFactory;

    protected $table = 'thuoctinhs';

    protected $fillable = [
        'id_sanpham',
        'mausac',
        'size',
        'soluong',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    public function image(){
        return $this->morphOne(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

}
