<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'PENDIENTE'],
            ['name' => 'EN PROGRESO'],
            ['name' => 'COMPLETADA'],
        ];

        DB::table('task_statuses')->insert($statuses);
    }
}
