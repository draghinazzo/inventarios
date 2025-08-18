<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Plantas', 'image' => 'plants.jpg'],
            ['name' => 'Abarrotes', 'image' => 'abarrotes.jpg'],
            ['name' => 'Electrónica', 'image' => 'electronics.jpg'],
            ['name' => 'Iluminación', 'image' => 'lights.jpg'],
            ['name' => 'Bebidas', 'image' => 'drinks.jpg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
