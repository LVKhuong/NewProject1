<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chungloai extends Model
{
    use HasFactory;
    protected $table = 'chungloais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ten'
    ];

    public function sanpham(){
        return $this->hasMany(sanpham::class, 'id_chungloai', 'id');
    }
}
