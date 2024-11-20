<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // outros campos que você tenha na tabela positions
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}