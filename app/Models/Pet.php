<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pet extends model
{
    use HasFactory;

    protected $fillable = ['name', 'species', 'breed', 'birth_date', 'user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
