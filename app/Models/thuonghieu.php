<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuonghieu extends Model
{
  use HasFactory;

  protected $table = 'thuonghieus';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'ten',
    'duongdan',
    'gioithieu'
  ];

  public function sanpham(){
    return $this->hasMany(sanpham::class, 'id_thuonghieu', 'id');
  }
  
  public function image(){
    return $this->morphOne(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
  }

    
}
