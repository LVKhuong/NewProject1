<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class binhluan extends Model
{
    use HasFactory;

    protected $table = 'binhluans';

    protected $fillable = [
        'name',
        'email',
        'noidung',
        'id_sanpham',
        'id_user',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'id_sanpham', 'id');
    }

    public function tralois(){
        return $this->hasMany(traloi::class, 'id_binhluan', 'id');
    }

}
