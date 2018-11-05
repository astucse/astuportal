<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

// Artisan::command('build {project}', function ($project) {
//     $this->info("Building {$project}!");
// });
Artisan::command('seed:module {module} {file?}', function ($module, $file="haha") {
    Artisan::call('db:seed', [
        '--class' => '\\Modules\\'.$module.'\\Database\\Seeders\\'.$file.'TableSeeder'
    ]);
});