<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Planta de sol', 'description' => 'Planta ideal para exteriores', 'quantity' => 20, 'price' => 50, 'category_id' => 1, 'brand_id' => null, 'image' => 'planta_sol.jpg'],
            ['name' => 'Planta de sombra', 'description' => 'Perfecta para interiores', 'quantity' => 15, 'price' => 70, 'category_id' => 1, 'brand_id' => null, 'image' => 'planta_sombra.jpg'],
            ['name' => 'Leche Bimbo', 'description' => 'Leche entera 1L', 'quantity' => 50, 'price' => 25, 'category_id' => 2, 'brand_id' => 4, 'image' => 'leche_bimbo.jpg'],
            ['name' => 'Atún Nestlé', 'description' => 'Atún en agua 150g', 'quantity' => 40, 'price' => 18, 'category_id' => 2, 'brand_id' => 5, 'image' => 'atun_nestle.jpg'],
            ['name' => 'Coca-Cola 600ml', 'description' => 'Refresco clásico', 'quantity' => 100, 'price' => 15, 'category_id' => 5, 'brand_id' => 1, 'image' => 'coca_600.jpg'],
            ['name' => 'Pepsi 600ml', 'description' => 'Refresco de cola', 'quantity' => 90, 'price' => 14, 'category_id' => 5, 'brand_id' => 2, 'image' => 'pepsi_600.jpg'],
            ['name' => 'Foco LED Philips', 'description' => 'Foco LED 10W ahorrador', 'quantity' => 60, 'price' => 30, 'category_id' => 4, 'brand_id' => 3, 'image' => 'foco_philips.jpg'],
            ['name' => 'Televisor Philips 32"', 'description' => 'Smart TV HD', 'quantity' => 10, 'price' => 4000, 'category_id' => 3, 'brand_id' => 3, 'image' => 'tv_philips.jpg'],
            ['name' => 'Galletas Bimbo', 'description' => 'Paquete familiar', 'quantity' => 25, 'price' => 35, 'category_id' => 2, 'brand_id' => 4, 'image' => 'galletas_bimbo.jpg'],
            ['name' => 'Agua Nestlé 1L', 'description' => 'Agua purificada', 'quantity' => 80, 'price' => 12, 'category_id' => 5, 'brand_id' => 5, 'image' => 'agua_nestle.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
