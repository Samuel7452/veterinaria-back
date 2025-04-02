<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
