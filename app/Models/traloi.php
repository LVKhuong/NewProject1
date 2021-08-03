<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class traloi extends Model
{
    use HasFactory;

    protected $table = 'tralois';

    protected $fillable = [
        'name',
        'email',
        'noidung',
        'id_user',
        'id_binhluan',
    ];

    public function binhluan(){
        return $this->belongsTo(binhluan::class, 'id_binhluan', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
