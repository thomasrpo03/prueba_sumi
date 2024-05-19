<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            [
                'name' => 'Smartphone X1',
                'description' => 'Un smartphone de última generación con pantalla OLED.',
                'category_id' => 1,
                'price' => 699.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'Una laptop potente para profesionales.',
                'category_id' => 1,
                'price' => 1299.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bicicleta de Montaña',
                'description' => 'Bicicleta robusta para terrenos difíciles.',
                'category_id' => 2,
                'price' => 499.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Raqueta de Tenis',
                'description' => 'Raqueta de tenis profesional.',
                'category_id' => 2,
                'price' => 199.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Vestido de Verano',
                'description' => 'Vestido ligero y cómodo para el verano.',
                'category_id' => 3,
                'price' => 59.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chaqueta de Invierno',
                'description' => 'Chaqueta cálida para el invierno.',
                'category_id' => 3,
                'price' => 149.99,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
