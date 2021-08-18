<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    use HasFactory;

    protected $table = 'danhgias';

    protected $fillable = [
        'id_sanpham',
        'id_user',
        'name',
        'email',
        'noidung',
        'sao',
    ];

    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function images(){
        return $this->morphMany(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

    public function tralois(){
        return $this->hasMany(traloi_danhgia::class, 'id_danhgia', 'id');
    }

}
