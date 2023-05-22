<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clearAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('route:cache');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        $this->info('config cache cleared!');
        $this->info('view cache cleared!');
        $this->info('route cache cleared!');
        $this->info('All cache cleared successfully!');

        return Command::SUCCESS;
    }
}
