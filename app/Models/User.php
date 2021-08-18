<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chucnang(){
        return $this->hasMany(ChucNangUser::class, 'id_user', 'id');
    }
    
    
    public function checkauth($tenRoute){

        $chucnang = ChucNangUser::where('id_user',$this->id)->where('tenroute',$tenRoute)->get();
        
        if(count($chucnang) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function image(){
        return $this->morphOne(FileImage::class, 'imageable', 'imageable_type', 'imageable_id');
    }

    public function role(){
        return $this->hasOne(role::class, 'id_user', 'id');
    }

    public function danhgias(){
        return $this->hasMany(danhgia::class, 'id_user', 'id');
    }

    public function tralois(){
        return $this->hasMany(traloi_danhgia::class, 'id_user', 'id');
    }


}
