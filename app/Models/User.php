<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
