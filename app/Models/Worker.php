<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position_id',
        'email',
        'phone',
        'hire_date',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function category()
    {
        return $this->belongsTo(StockCategory::class, 'category');
    }

}