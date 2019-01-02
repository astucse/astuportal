<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            // ['name' => 'Assistant Professor','code' =>'AR_APS','category' => 'ACADEMIC_RANK'],
            // ['name' => 'Professor','code' =>'AR_PSR','category' => 'ACADEMIC_RANK'],
            ['name' => 'Assistant Professor','code' =>'AR_ASSTTP','category' => 'ACADEMIC_RANK'],
            ['name' => 'Professor','code' =>'AR_P','category' => 'ACADEMIC_RANK'],
            ['name' => 'Lecturer','code' =>'AR_L','category' => 'ACADEMIC_RANK'],
            ['name' => 'Associate Professor','code' =>'AR_ASSCTP','category' => 'ACADEMIC_RANK'],
            ['name' => 'Senior Lecturer','code' =>'AR_SL','category' => 'ACADEMIC_RANK'],
            ['name' => 'Assistant Lecturer','code' =>'AR_AL','category' => 'ACADEMIC_RANK'],

            // , , , , , 
            ['name' => 'School Dean','code' =>'A_SDN','category' => 'AUTHORITY'],
            ['name' => 'Department Head','code' =>'A_DHN','category' => 'AUTHORITY'],
            ['name' => 'Secretary','code' =>'P_SEC','category' => 'POSITION'],
            ['name' => 'Instructor','code' =>'P_INS','category' => 'POSITION'],
            ['name' => 'Student','code' =>'P_STU','category' => 'POSITION'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Role::create($item);
        }
    }
}
