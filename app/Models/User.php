<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture_id'
    ];

    protected $hidden = [
        'password',
    ];


//    public function tasks()
//    {
//        return $this->hasMany(Task::class);
//    }
    public function profilePhoto()
    {
        return $this->belongsTo(Photo::class, 'profile_photo_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

}
