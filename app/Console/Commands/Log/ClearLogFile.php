<?php

namespace App\Console\Commands\Log;

use Illuminate\Console\Command;

class ClearLogFile extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Laravel Log';

    /**
     * Execute the console command.
     */
    public function handle() {
        //
        exec('echo "" > ' . storage_path('logs/laravel.log'));
        exec('echo "" > ' . storage_path('logs/query.log'));
        $this->info('Logs have been cleared');
    }
}
