<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeTableSeeder extends Seeder
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
        $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
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

            App\Models\Employee::create([
                'id_number' => $un, 
                'name' => $j->FullName, 
                'email' => $un."@astuportal.net", 
                'password' => Hash::make($pass), 
                'initial_password' => $pass, 
                'disability' => 0, 
                'sex' => $j->Gender
            ]);
        }
        // factory(App\Models\Employee::class, 170)->create();
        // $user = factory(App\Models\Student::class, 1250)->create();
        // [
		//     'name' => 'Abigail',
        // ]);
        
    }
}
