<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Employee::class, 170)->create();
        // $user = factory(App\Models\Student::class, 1250)->create();
        // [
		//     'name' => 'Abigail',
        // ]);
        
    }
}
