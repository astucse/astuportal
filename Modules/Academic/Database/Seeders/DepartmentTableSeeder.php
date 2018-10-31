<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $items = [
            ['name' => 'Computer Science and Engineering','code' =>'CSE', 'school_id'=> 1],
            ['name' => 'Power and Control Engineering','code' =>'PCE', 'school_id'=> 1],
            ['name' => 'Electronics and Communication Engineering','code' =>'ECE', 'school_id'=> 1],
            ['name' => 'Chemical Engineering','code' =>'CE', 'school_id'=> 2],
            ['name' => 'Architecture','code' =>'AE', 'school_id'=> 3],
            ['name' => 'Construction Technology Management','code' =>'CTM', 'school_id'=> 3],
            ['name' => 'Applied Biology','code' =>'AB', 'school_id'=> 4],
            ['name' => 'Applied Chemistry','code' =>'AC', 'school_id'=> 4],
            ['name' => 'Applied Physics','code' =>'AP', 'school_id'=> 4],
        ];
        foreach ($items as $item) {
            \Modules\Academic\Entities\Department::create($item);
        }
        // $this->call("OthersTableSeeder");
    }
}
