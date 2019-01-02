<?php

use Illuminate\Database\Seeder;

class StudentsAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r = \App\Models\Role::where(['code' =>'P_STU'])->first();
        $d = Department::whereIn('duration',[4,5])->get();

        // 1250 
        // 15 * 50,      5 * 10
        foreach ([3,4,5] as $y) {
	        $s = Student::where('batch_year',$y)->get()->chunk(40);
	        for ($i=0; $i < 20; $i++) { 
	                $dep = $d[$i];
	            foreach ($s[$i] as $stu) {
	                // foreach ($d as $dep) {
	                    \App\Models\AssignedRole::create([
	                        'role_id' =>  $r->id,
	                        'roletaker_id' =>  $stu->id,
	                        'roletaker_type' =>  'student',
	                        'rolegiver_id' =>  $dep->id,
	                        'rolegiver_type' =>  'Org\\Department'
	                    ]);
	                // }
	            }
	        }
        }
    }
}
