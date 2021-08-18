<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanphams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ten',
        'gia',
        'id_chungloai',
        'id_thuonghieu',
        'isHot',
        'isNew',
        'sale', 
        'tag',
        'gioithieu',
    ];

    public function chungloai()
    {
        return $this->belongsTo(chungloai::class, 'id_chungloai', 'id');
    }

    public function thuonghieu()
    {
        return $this->belongsTo(thuonghieu::class, 'id_thuonghieu', 'id');
    }

    public function thuoctinh(){
        return $this->hasMany(thuoctinh::class, 'id_sanpham', 'id');
    }

    public function giamgia()
    {
        return $this->hasOne(giamgia::class, 'id_sanpham', 'id');
    }

    public function images()
    {
        return $this->morphMany(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

    public function danhgias(){
        return $this->hasMany(danhgia::class, 'id_sanpham', 'id');
    }

    public function mausacs(){
        return $this->hasMany(mausac::class, 'id_sanpham', 'id');
    }

    public function size_tongsoluongs(){
        return $this->hasManyThrough(size_tongsoluong::class, mausac::class, 'id_sanpham', 'id_mausac', 'id');
    }

    public function chitietdonhang(){
        return $this->hasOne(chitietdonhang::class, 'id_sanpham', 'id');
    }
}
