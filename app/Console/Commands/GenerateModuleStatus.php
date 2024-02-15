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
        // Retrieve all modules
        $modules = Module::all();

        // through each module and update its state randomly
        foreach ($modules as $module) {
            // Générez aléatoirement un nouvel état
            $randomStatus = collect(['Operationally', 'Faulty', 'Repair'])->random();

            // Update the module state
            $module->actual_status = $randomStatus;
            $module->save();
        }

        $this->info('Module status generated successfully.');
    }
}
