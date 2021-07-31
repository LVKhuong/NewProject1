<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nguoimua',
        'email',
        'ngaymua',
        'tongtien',
        'trangthai',
    ];

    public function chitietdonhang(){
        return $this->hasMany(chitietdonhang::class, 'id_donhang', 'id');
    }
    
}
