<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HistoryModule;
use App\Models\Module;

class GenerateModuleHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generate-history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random history data for modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve all modules
        $modules = Module::all();

        // For each operational module, generate random history data and save it
        foreach ($modules as $module) {
            if($module->actual_status == 'Operationally') {
                $temperature_value = mt_rand(0, 50); // Generate a random temperature between 0 and 50 C
                $total_passenger_count = mt_rand(0, 100); // Generate a random number of passengers between 0 and 100
                $distance_traveled = mt_rand(0, 5); // Generate a random distance traveled between 0 and 5 Km
                $boarding_passenger_count = mt_rand(0, 30); // Generate a random number of boarding passengers between 0 and 30
                $alighting_passenger_count = mt_rand(0, 30); // Generate a random number of alighting passengers between 0 and 30
    
                // Save history data to the database
                HistoryModule::create([
                    'module_id' => $module->id,
                    'temperature_value' => $temperature_value,
                    'total_passenger_count' => $total_passenger_count,
                    'distance_traveled' => $distance_traveled,
                    'boarding_passenger_count' => $boarding_passenger_count,
                    'alighting_passenger_count' => $alighting_passenger_count,
                ]);
            }
        }

        $this->info('Module history generated successfully.');

        return 0;
    }
}
