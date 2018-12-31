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
Artisan::command('migrate:system', function () {
	// Artisan::call('seed:module',[
	// 	'module' => 'Org',
	// 	'file' => 'School'
	// ]);
	// Artisan::call('seed:module',[
	// 	'module' => 'Org',
	// 	'file' => 'Department'
	// ]);
	// foreach (['Course','Curriculum'] as $key => $value) {
	foreach (['Curriculum'] as $key => $value) {
		Artisan::call('seed:module',[
			'module' => 'Academic',
			'file' => $value
		]);	
	}
	
	// Artisan::call('module:');
	// Artisan::call('module:migrate Academic');
	// Artisan::call('module:migrate StaffEvaluation');
});
// Artisan::command('migrate:system', function () {
	// $d = dir(database_path('migrations'));
	// $this->info($d);
	// Artisan::call('migrate', [
	//     '--path' => 'database/migrations'
	// ]);
	// while (false !== ($entry = $d->read())) {
	// 	if($entry!="." && $entry!=".."){
	// 		// $folder = $entry;
	// 		$this->info("Seeded!!! ".$entry);
	// 		// $json_path = base_path('Themes/'.$folder.'/config/theme.json');
	// 		// $handle = file_get_contents($json_path, "r");
	// 		// $zjson = json_decode($handle);
	// 		// if($this->theme==$entry){
	// 			// $zjson->active = true;
	// 		// }else{
	// 			// $zjson->active = false;
	// 		// }
	// 		// $themeSettings[$entry] = $zjson;
	// 	}
	// }
	// $d->close();
    // $handle = file_get_contents($json_path, "r");
	// $zjson = json_decode($handle);
	// foreach ($zjson->options as $option) {
    //     $row_name = "themes_".$theme."_".$option->name;
    //     $exists = sizeof(DB::table('options')->where('name',$row_name)->get());
    //     if($exists==0){
    //         DB::table('options')->insert(
    //             ['name' => $row_name, 'value' => $option->value]
    //         );
    //         $this->info($row_name." inserted");
    //     }
    // }
// });
Artisan::command('lll', function () {
	for ($i=1; $i < 21; $i++) { 
		Modules\Academic\Entities\Group::create([
			'name' => $i.'',
			'batch_year' => '1',
			'semester' => '1',
			'year' => '2011',
			'freshman' => '',
			'school' => '',
			'institution_id' => '',
			'institution_type' => '',
			'curriculum_id' => ''
		]);
	}
});
Artisan::command('seed:modules {module} {file?}', function ($module, $file="all") {
	if($module=="main"){
		// $in  =  database_path('migrations');
		// $d = dir($in);
		// while (false !== ($entry = $d->read()) && $entry!="." && $entry!=".." && $entry!=".gitkeep"  ) {
		// 	$seedFile = substr($entry,18,strlen($entry)-4);
		// 	$this->info($seedFile);
			
			Artisan::call('db:seed', [
				// CreateStudentsTable
		        // '--class' => 'CreateStudentsTable'
			]);
		// 	break;
		// }
		// $d->close();
	}elseif($file=="all"){
		$in  =  base_path('Modules/'.$module.'/Database/Seeders');
		$d = dir($in);
		while (false !== ($entry = $d->read()) && $entry!="." && $entry!=".gitkeep"  ) {
			$this->info($entry);
			$seedFile = substr($entry,0,strlen($entry)-4);
			Artisan::call('db:seed', [
		        '--class' => '\\Modules\\'.$module.'\\Database\\Seeders\\'.$seedFile
		    ]);
		}
		$d->close();
	}else{
	    Artisan::call('db:seed', [
	        '--class' => '\\Modules\\'.$module.'\\Database\\Seeders\\'.$file.'TableSeeder'
	    ]);
	}
    $this->info("Seeded!!! ".$file);
});


Artisan::command('kdrop', function () {
    $list = $this->ask('list tables?');
    $todrop = explode(' ',$list);
    $migrations = DB::table('migrations')->get();
    foreach($todrop as $table){
        foreach($migrations as $migration){
            $m = substr($migration->migration,25);
            if ($m==$table."_table") {
                DB::table('migrations')->where('id', $migration->id)->delete();
                $this->info($migration->migration.' removed');
                break;
            }
        }
        Schema::dropIfExists($table);
        $this->info($table." dropped");
    }
})->describe('Dropping database and migration file');



// Artisan::command('kkk', function(){
// 	$users = App\Models\Student::all();
	
// 	$bar = $this->output->createProgressBar(count($users));
// 	$bar->start();
// 	foreach ($users as $user) {
// 	    $bar->advance();
// 	}
// 	$bar->finish();
// });



Artisan::command('seed:module {module} {file?}', function ($module, $file="all") {
	if($file=="all"){
		// $in  =  '\\Modules\\'.$module.'\\Database\\Seeders\\Seed.php';
		$in  =  'Modules/'.$module.'/Database/Seeders/Seed.php';
		$myArray = include "$in";
		foreach ($myArray as $seedFile) {
			Artisan::call('db:seed', [
		        '--class' => '\\Modules\\'.$module.'\\Database\\Seeders\\'.$seedFile
		    ]);
		}
	}else{
	    Artisan::call('db:seed', [
	        '--class' => '\\Modules\\'.$module.'\\Database\\Seeders\\'.$file.'TableSeeder'
	    ]);
	}
    $this->info("Seeded!!! ".$file);
});