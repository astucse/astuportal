<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Employee::class, function (Faker $faker) {
    $i1 = rand ( 0 , 1000 );
    $i2 = rand ( 0 , 1000 );
    $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->userName."s@astuportal.net",
        'id_number' => "STAFF/".$faker->unique()->numberBetween(1000, 9999)."/0".random_int(6, 11),
        'password' => Hash::make($pass), // secret
        'initial_password' => $pass,
        'remember_token' => str_random(10),
        'sex' => $faker->randomElement(array ('M','F','M','F','M')),
        'disability' => $faker->randomElement(array (0,0,0,0,0,0,0,0,0,1)),
    ];
});
