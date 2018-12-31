<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use Nwidart\Modules\Module;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'employee' => 'App\Models\Employee',
            'student' => 'App\Models\Student',
            'admin' => 'App\Models\Admin',
            'Org\Department' => 'Modules\Org\Entities\Department',
            'Org\School' => 'Modules\Org\Entities\School',
            'Org\Office' => 'Modules\Org\Entities\Office',
        ]);   
        // Relation::morphMap([
        // ]);
        Schema::defaultStringLength(191);
        // Blade::directive('p', function($expression) {
        //     $output = $expression ? $expression : "1";
        //     // list($expression1, $expression2) = explode(', ', $expression);
        //     // $output = $expression1 ? $expression1 : $expression2;
        //     return "<?php echo {$output}; ";
        // });
        // Nwidart\Modules->app['modules']->boot()
        // Module::boot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
