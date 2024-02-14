<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Module::create([
                'name' => 'Module ' . ($i + 1),
                'actual_status' => 'Operationaly',
                'description' => 'Description for Module ' . ($i + 1),
            ]);
        }
    }
}
