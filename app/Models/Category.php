<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención pluralizada)
    protected $table = 'categories';

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'parent_id',
    ];

    // Relación con subcategorías
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relación inversa con categoría padre
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relación con productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
