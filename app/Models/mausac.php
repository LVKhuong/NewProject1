<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mausac extends Model
{
    use HasFactory;

    protected $table = 'mausacs';

    protected $fillable = [
        'ten',
        'id_sanpham',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    public function size_tongsoluongs(){
        return $this->hasMany(size_tongsoluong::class, 'id_mausac', 'id');
    }

    public function image(){
        return $this->morphOne(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

}
