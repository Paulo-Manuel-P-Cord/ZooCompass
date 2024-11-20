<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
        'cost',
        'type',
        'animal_id',
        'employee_id',
        'completed',
    ];
}