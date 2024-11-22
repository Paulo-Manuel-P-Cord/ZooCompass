<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'category',
    ];
    

    public function category()
{
    return $this->belongsTo(StockCategory::class, 'category');
}

}