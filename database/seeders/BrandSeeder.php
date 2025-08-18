<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Coca-Cola', 'image' => 'coca-cola.png'],
            ['name' => 'Pepsi', 'image' => 'pepsi.png'],
            ['name' => 'Philips', 'image' => 'philips.png'],
            ['name' => 'Bimbo', 'image' => 'bimbo.png'],
            ['name' => 'Nestlé', 'image' => 'nestle.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
