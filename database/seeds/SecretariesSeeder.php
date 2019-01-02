<?php

use Illuminate\Database\Seeder;

class SecretariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
        $json_path = base_path('docs/fixtures/secretary.json');
        $handle = file_get_contents($json_path, "r");	
        $zjson = json_decode($handle);
        
        // $c = Collect([]);
        // $i=2;
        foreach($zjson as $j){
        	// App\Models\Employee::create([
        	// 	'id_number' => $j->id_number, 
        	// 	'name' => $j->name, 
        	// 	'email' => $j->email, 
        	// 	'password' => $j->password, 
        	// 	'initial_password' => $j->initial_password, 
        	// 	'disability' => $j->disability, 
        	// 	'sex' => $j->sex
        	// ]);

        	//// $d666 = App\Models\AssignedRole::where(['roletaker_type' =>  'employee','roletaker_id'=>$j->id_number])->get();
        	//// foreach ($d666 as $dddd) {
        	//// 	$dddd->delete();
        	//// }
        }

        $r = App\Models\Role::where(['code'=>'P_SEC'])->first();
        $d = Modules\Org\Entities\Department::whereNotIn('duration'	,[0])->get();
        for ($i=0; $i < sizeof($d); $i++) { 
        	$e = App\Models\Employee::where('id_number',$zjson[$i]->id_number)->first();
	            App\Models\AssignedRole::create([
	            	'role_id' =>  $r->id,
	            	'roletaker_id' =>  $e->id,
	            	'roletaker_type' =>  'employee',
	            	'rolegiver_id' =>  $d[$i]->id,
	            	'rolegiver_type' =>  'Org\\Department'
	            ]);
        }

        $r = App\Models\Role::where(['code'=>'P_SEC'])->first();
        $s = Modules\Org\Entities\School::all();
        for ($i=sizeof($d); $i < sizeof($d)+sizeof($s); $i++) { 
        	$e = App\Models\Employee::where('id_number',$zjson[$i]->id_number)->first();
	            App\Models\AssignedRole::create([
	            	'role_id' =>  $r->id,
	            	'roletaker_id' =>  $e->id,
	            	'roletaker_type' =>  'employee',
	            	'rolegiver_id' =>  $s[$i]->id,
	            	'rolegiver_type' =>  'Org\\School'
	            ]);
        }


        //     $a = explode(" ", $j->FullName);
        //     $un =  $a[0].$a[1][0];
        //     if ($c->contains($un)) {
        //         $un =  $un.$i;
        //         $c->push($un);
        //         $i++;
        //     }else{
        //         $c->push($un);
        //     }
        //     $e = App\Models\Employee::where(['id_number'=>$un])->first();
        //     $r2 = App\Models\Role::where(['code'=>'P_INS'])->first();
        //     App\Models\AssignedRole::create([
        //     	'role_id' =>  $r2->id,
        //     	'roletaker_id' =>  $e->id,
        //     	'roletaker_type' =>  'employee',
        //     	'rolegiver_id' =>  $d->id,
        //     	'rolegiver_type' =>  'Org\\Department'
        //     ]);
        // }
    }
}
