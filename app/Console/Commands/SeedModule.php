<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:module {module} {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alias of that long command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
