<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'role',
        'ten_role',
        'id_user',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'id_user', 'id');
    }

    public function menu(){
        return $this->hasOne(quanlimenu::class, 'id_role', 'role');
    }
}
