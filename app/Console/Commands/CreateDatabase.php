<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    protected $signature = 'create-database';

    protected $description = 'Create a new database';

    public function handle()
    {
        $databaseName = 'caption_me';
        $charset = 'utf8mb4';
        $collation = 'utf8mb4_unicode_ci';

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS $databaseName CHARACTER SET $charset COLLATE $collation");
            $this->info('Database created successfully!');
        } catch (\Exception $e) {
            $this->error('Database creation failed: ' . $e->getMessage());
        }
    }
}
