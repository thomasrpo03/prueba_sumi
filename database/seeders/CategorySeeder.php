<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'TECNOLOGIA',
            ],
            [
                'name' => 'DEPORTES',
            ],
            [
                'name' => 'MODA',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
