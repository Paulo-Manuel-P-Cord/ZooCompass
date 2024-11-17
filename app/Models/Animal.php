<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal',
        'diet',
        'habitat',
        'amount',
        'origin',
    ];

    public function dietType()
    {
        return $this->belongsTo(AnimalType::class, 'diet');
    }
}
