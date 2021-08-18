<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ckeditor_image extends Model
{
    use HasFactory;

    protected $table = 'ckeditor_images';

    protected $fillable = [
        'ten_file',
        'duongdan',
    ];

}
