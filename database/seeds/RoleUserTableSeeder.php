<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $json_path = base_path('docs/realData/instructors.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        // $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
        $c = Collect([]);
        $i=2;
        foreach($zjson->instructors as $j){
            $a = explode(" ", $j->FullName);
            $un =  $a[0].$a[1][0];
            if ($c->contains($un)) {
                $un =  $un.$i;
                $c->push($un);
                $i++;
            }else{
                $c->push($un);
            }
            $e = App\Models\Employee::where(['id_number'=>$un])->first();
            $r = App\Models\Role::where(['name'=>$j->Rank])->first();
            $r2 = App\Models\Role::where(['code'=>'P_INS'])->first();
            $d = Modules\Org\Entities\Department::where(['name'=>$j->DepartmentName])->first();
            App\Models\AssignedRole::create([
            	'role_id' =>  $r->id,
            	'roletaker_id' =>  $e->id,
            	'roletaker_type' =>  'employee',
            	'rolegiver_id' =>  $d->id,
            	'rolegiver_type' =>  'Org\\Department'
            ]);
            App\Models\AssignedRole::create([
            	'role_id' =>  $r2->id,
            	'roletaker_id' =>  $e->id,
            	'roletaker_type' =>  'employee',
            	'rolegiver_id' =>  $d->id,
            	'rolegiver_type' =>  'Org\\Department'
            ]);
        }
    }
}
