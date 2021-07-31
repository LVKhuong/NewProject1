<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileImage extends Model
{
  use HasFactory;

  protected $table = "file_images";

  protected $fillable = [
    'ten_file',
    'duongdan',
    'imageable_id',
    'imageable_type',
  ];

  public function imageable(){
    return $this->morphTo(__FUNCTION__ ,'imageable_type', 'imageable_id');
  }
}
