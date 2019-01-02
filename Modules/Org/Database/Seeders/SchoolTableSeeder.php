<?php

namespace Modules\Org\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SchoolTableSeeder extends Seeder
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
            ['name' => 'School of Electrical Engineering and Computing','code' =>'SoEEC'],
            ['name' => 'School of Material Chemical and Mechanical Engineering','code' =>'SoMCME'],
            ['name' => 'School of Civil Engineering and Architechture','code' =>'SoCEA'],
            ['name' => 'School of Applied Natural Science','code' =>'SoANS'],
            ['name' => 'School of Humanity Sciences','code' =>'SoHS'],
        ];
        foreach ($items as $item) {
            \Modules\Org\Entities\School::create($item);
        }
        // $this->call("OthersTableSeeder");
    }
}
