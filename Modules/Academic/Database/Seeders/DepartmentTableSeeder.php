<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Academic\Entities\School;
use Modules\Academic\Entities\Department;
class DepartmentTableSeeder extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $json_path = base_path('docs/fixtures/department.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        foreach($zjson as $j){
            $s_id = School::where(['code'=>$json->school])->first()->id;
            Department::create([
                "name" => $j->name,
                "code" => $j->code,
                "school_id" => $s_id,
                "description" => $j->description,
                "duration" => $j->duration,
            ]);
        }
        // foreach ($items as $item) {
        // }
        // $this->call("OthersTableSeeder");
    }
}
