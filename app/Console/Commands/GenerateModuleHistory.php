<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HistoryModule;
use App\Models\Module;
use App\Models\Entity;

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
        // Récupérer tous les modules
        $modules = Module::all();

        // Pour chaque module, générer des données d'historique aléatoires et les enregistrer
        foreach ($modules as $module) {
            $temperature_value = mt_rand(0, 50); // Générer une température aléatoire entre 0 et 50 C
            $total_passenger_count = mt_rand(0, 100); // Générer un nombre de passagers aléatoire entre 0 et 100
            $distance_traveled = mt_rand(0, 5); // Générer une distance parcourue aléatoire entre 0 et 5 Km
            $boarding_passenger_count = mt_rand(0, 30); // Générer un nombre de passagers montants aléatoire entre 0 et 200
            $alighting_passenger_count = mt_rand(0, 30); // Générer un nombre de passagers descendants aléatoire entre 0 et 200

            // Enregistrer les données d'historique dans la base de données
            HistoryModule::create([
                'module_id' => $module->id,
                'temperature_value' => $temperature_value,
                'total_passenger_count' => $total_passenger_count,
                'distance_traveled' => $distance_traveled,
                'boarding_passenger_count' => $boarding_passenger_count,
                'alighting_passenger_count' => $alighting_passenger_count,
            ]);
        }

        $this->info('Module history generated successfully.');

        return 0;
    }
}
