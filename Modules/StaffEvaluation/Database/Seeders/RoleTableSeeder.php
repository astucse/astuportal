<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleTableSeeder extends Seeder
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
            ['name' => 'Assistant Professor','code' =>'AR_APS','category' => 'ACADEMIC_RANK'],
            ['name' => 'Professor','code' =>'AR_PSR','category' => 'ACADEMIC_RANK'],
            
            ['name' => 'School Dean','code' =>'A_SDN','category' => 'AUTHORITY'],
            ['name' => 'Department Head','code' =>'A_DHN','category' => 'AUTHORITY'],
            
            ['name' => 'Secretary','code' =>'P_SEC','category' => 'POSITION'],
            ['name' => 'Instructor','code' =>'P_INS','category' => 'POSITION'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Role::create($item);
        }


        // $this->call("OthersTableSeeder");
    }
}
