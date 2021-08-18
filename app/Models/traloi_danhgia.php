<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class traloi_danhgia extends Model
{
    use HasFactory;

    protected $table = 'traloi_danhgias';

    protected $fillable = [
        'id_danhgia',
        'id_user',
        'noidung',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function danhgia(){
        return $this->belongsTo(danhgia::class, 'id_danhgia', 'id');
    }

}
