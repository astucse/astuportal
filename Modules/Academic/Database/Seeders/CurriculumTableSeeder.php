<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CurriculumTableSeeder extends Seeder{
    public function run(){
        Model::unguard();
        $json_path1 = base_path('docs/fixtures/course_breakdown.json');
        $json_path2 = base_path('docs/fixtures/electives.json');
        $cc = file_get_contents($json_path1, "r");
        $ee = file_get_contents($json_path2, "r");
        $c = json_decode($cc,true)["body"];
        $e = json_decode($ee,true)["body"];
        $ff = \Modules\Academic\Entities\Curriculum::all()->count();
        $items = [
            ['version' =>$ff+1, 'name'=> 'Initial Curriculum','courses'=>$c,'electives'=>$e],
        ];                          
        foreach ($items as $item) {
            // Curriculum::create($item);
            \Modules\Academic\Entities\Curriculum::create($item);
        }
    }
}
