<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropDatabase extends Command
{
    protected $signature = 'database:drop';

    protected $description = 'Drop the database';

    public function handle()
    {
        DB::statement('DROP DATABASE postgres');
        $this->info('Database dropped successfully!');
    }
}
