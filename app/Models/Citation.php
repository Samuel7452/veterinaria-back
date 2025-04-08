<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Pet;
use Illuminate\Foundation\Auth\User;
class Citation extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'vet_id', 'date', 'is_active', 'owner_id'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
