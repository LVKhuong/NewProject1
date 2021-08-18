<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size_tongsoluong extends Model
{
    use HasFactory;

    protected $table = 'size_tongsoluongs';

    protected $fillable = [
        'id_mausac',
        'size',
        'tongsoluong',
    ];

    public function mausac(){
        return $this->belongsTo(mausac::class, 'id_mausac', 'id');
    }
}
