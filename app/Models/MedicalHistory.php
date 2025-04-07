<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Pet;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'pet_id'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
