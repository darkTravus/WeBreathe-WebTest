<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Entity;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entities = Entity::all();

        for ($i = 0; $i < 10; $i++) {
            $randomEntity = $entities->random(); // Choose a random entity

            Module::create([
                'name' => 'Module ' . ($i + 1),
                'entity_id' => $randomEntity->id, // Use de ID of the randomed entity 
                'actual_status' => 'Operationally',
                'description' => 'Description for Module ' . ($i + 1),
            ]);
        }
    }
}
