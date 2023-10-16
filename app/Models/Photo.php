<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_profile_picture' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userByProfiePicture()
    {
        return $this->hasOne(User::class, 'profile_photo_id');
    }

}
