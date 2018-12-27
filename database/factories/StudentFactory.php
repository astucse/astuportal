<?php

use Faker\Generator as Faker;
use App\Helpers\EthionameHelper;



$factory->define(App\Models\Student::class, function (Faker $faker) {
    $ethiopians = EthionameHelper::names();
    $i1 = rand ( 1000 , 9999 );
    // $i2 = rand ( 0 , 1000 );
    $sex = $faker->randomElement(array ('M','F','M','F','M'));
    // $batch_pre = $faker->randomElement(array ('07','08','09','10','11'));
    $batch_pre = '11';
    $batch_year = "20".$batch_pre;
    $name = "";
    if($sex=="M"){
        $name = $faker->randomElement($ethiopians['males'])." ".$faker->randomElement($ethiopians['males']);
    }else{
        $name = $faker->randomElement($ethiopians['females'])." ".$faker->randomElement($ethiopians['males']);
    }
    $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit;
    return [
        'name' => $name,
        'email' => $faker->unique()->userName."@astuportal.net",
        'id_number' => "R/".$i1."/".$batch_pre,
        'password' => Hash::make($pass), 
        'initial_password' => $pass,
        'remember_token' => str_random(10),
        'sex' => $sex,
        'batch_year' => $batch_year,
        'disability' => $faker->randomElement(array (0,0,0,0,0,0,0,0,0,1)),
    ];
});
