<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucNangUser extends Model
{
    use HasFactory;

    protected $table = 'chuc_nang_users';

    protected $fillable = [
        'id_user',
        'tenroute',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
