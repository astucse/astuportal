<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Helpers\EthionameHelper;
class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ethiopians = EthionameHelper::names();
        $batch_pre = '07';
        $batch_year = "20".$batch_pre;
        $faker = Faker::create();
        for ($i=0; $i < 921; $i++) { 
            $i1 = 1000+$i;
            $name = "";
            $sex = $faker->randomElement(array ('M','F','M','F','M'));
            if($sex=="M"){
                $name = $faker->randomElement($ethiopians['males'])." ".$faker->randomElement($ethiopians['males']);
            }else{
                $name = $faker->randomElement($ethiopians['females'])." ".$faker->randomElement($ethiopians['males']);
            }
            $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
            $student  = \App\Models\Student::create([
                'name' => $name,
                'email' => $faker->unique()->userName.$faker->randomLetter.$faker->randomLetter."@astuportal.net",
                'id_number' => "R/".$i1."/".$batch_pre,
                'password' => Hash::make($pass), 
                'initial_password' => $pass,
                'remember_token' => str_random(10),
                'sex' => $sex,
                'disability' =>  $faker->randomElement(array (0,0,0,0,0,0,0,0,0,1)),
                'batch_year' => $batch_year
            ]);
        }
    }
}
