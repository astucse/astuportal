<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OptionTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $items = [
            ['code' =>'Academic_year', 'value'=> '2011'],
            ['code' =>'Academic_semester', 'value'=> '1'],
            ['code' =>'Academic_curriculum', 'value'=> '1'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
    }
}
