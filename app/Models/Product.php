<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'image',
        'category_id',
        'brand_id',
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con marca
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
