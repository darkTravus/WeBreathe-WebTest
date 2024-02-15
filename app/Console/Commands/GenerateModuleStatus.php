<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Module;

class GenerateModuleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generate-module-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate status for modules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Récupérer tous les modules
        $modules = Module::all();

        // Parcourir chaque module et mettre à jour son état de manière aléatoire
        foreach ($modules as $module) {
            // Générez aléatoirement un nouvel état
            $randomStatus = collect(['Operationaly', 'Faulty', 'Repair'])->random();

            // Mettez à jour l'état du module
            $module->actual_status = $randomStatus;
            $module->save();
        }

        $this->info('Module status generated successfully.');
    }
}
