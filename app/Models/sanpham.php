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
        'ten',
        'gia',
        'id_chungloai',
        'id_thuonghieu',
        'isHot',
        'isNew',
        'sale',
        'gioithieu'
    ];

    public function chungloai()
    {
        return $this->belongsTo(chungloai::class, 'id_chungloai', 'id');
    }

    public function thuonghieu()
    {
        return $this->belongsTo(thuonghieu::class, 'id_thuonghieu', 'id');
    }

    public function giamgia()
    {
        return $this->hasOne(giamgia::class, 'id_sanpham', 'id');
    }

    public function images()
    {
        return $this->morphMany(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

    public function binhluans(){
        return $this->hasMany(binhluan::class, 'id_sanpham', 'id');
    }

}
